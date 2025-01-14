<?php

defined("ABSPATH") or die("");

use VendorDuplicator\phpseclib\Crypt\RSA;
use VendorDuplicator\phpseclib\Net\SFTP;
use Duplicator\Utils\IncrementalStatusMessage;
use DUP_PRO_Log;

class DUP_PRO_PHPSECLIB
{
    public $sourceLocalFiles = 1;
    public $sFtpResume = 1;

    function __construct()
    {
        /*include 'autoload.php';
        $loader = new \Composer\Autoload\ClassLoader();
        $loader->addPsr4('phpseclib\\', __DIR__ . '/phpseclib');
        $loader->register();*/
        $this->sFtpResume = SFTP::RESUME;
        $this->sourceLocalFiles = SFTP::SOURCE_LOCAL_FILE;
    }

    public function get_rsa_client()
    {
        $rsa = new RSA();
        return $rsa;
    }

    public function get_sftp_client($server = '', $port = '')
    {
        if (empty($server) || empty($port)) {
            return false;
        }
        $sftp = new SFTP($server, $port);
        return $sftp;
    }

    public function connect($server = '', $port = '', $username = '', $password = '', $private_key = '', $private_key_password = '', $statusMsgsObj = null)
    {
        if ($statusMsgsObj === null) {
            $statusMsgsObj = new IncrementalStatusMessage();
        }
        $error_msg = '';
        if (empty($server)) {
            $error_msg = __('Server name is required to make sftp connection', 'duplicator-pro');
            return $this->throw_error($error_msg);
        }
        if (empty($port)) {
            $error_msg = __('Server port is required to make sftp connection', 'duplicator-pro');
            return $this->throw_error($error_msg);
        }
        if (empty($username)) {
            $error_msg = __('Username is required to make sftp connection', 'duplicator-pro');
            return $this->throw_error($error_msg);
        }
        if (empty($password) && empty($private_key)) {
            $error_msg = __('You should provide either sftp user pasword or the private key to make sftp connection', 'duplicator-pro');
            return $this->throw_error($error_msg);
        }

        if (!empty($private_key)) {
            $key = $this->set_sftp_private_key($private_key, $private_key_password);
        }

        $statusMsgsObj->addMessage(sprintf(__('Connecting to SFTP server %1$s:%2$d', 'duplicator-pro'), $server, $port));
        DUP_PRO_Log::trace("Connect to SFTP server $server:$port");
        $sftp = $this->get_sftp_client($server, $port);
        $statusMsgsObj->addMessage(sprintf(__('Attempting to login to SFTP server %1$s', 'duplicator-pro'), $server));
        DUP_PRO_Log::trace("Attempting to login to SFTP server $server");
        if (isset($key) && $key) {
            $statusMsgsObj->addMessage(__('Login to SFTP using private key', 'duplicator-pro'));
            DUP_PRO_Log::trace("Login to SFTP using private key");
            if ($sftp->login($username, $key)) {
                $statusMsgsObj->addMessage(__('Successfully connected to server using private key', 'duplicator-pro'));
                DUP_PRO_Log::trace('Successfully connected to server using private key');
            } else {
                $error_msg = __('Error opening SFTP connection using private key', 'duplicator-pro');
                return $this->throw_error($error_msg);
            }
        } else {
            DUP_PRO_Log::trace("Login to SFTP");
            if ($sftp->login($username, $password)) {
                $statusMsgsObj->addMessage(__('Successfully connected to server using password', 'duplicator-pro'));
                DUP_PRO_Log::trace('Successfully connected to server using password');
            } else {
                $error_msg = __('Error opening SFTP connection using password', 'duplicator-pro');
                return $this->throw_error($error_msg);
            }
        }
        return $sftp;
    }

    public function set_sftp_private_key($private_key, $private_key_password)
    {
        if (empty($private_key)) {
            $error_msg = 'Private key is null';
            return $this->throw_error($error_msg);
        }

        DUP_PRO_Log::trace("Set Private Key");
        $key = $this->get_rsa_client();
        if (!empty($private_key_password)) {
            DUP_PRO_Log::trace("Set Private Key Password");
            $key->setPassword($private_key_password);
        }
        $key->loadKey($private_key);
        DUP_PRO_Log::trace("Private Key Loaded");
        return $key;
    }

    public function mkDirRecursive($storage_path = '', $sftp = null)
    {
        if (empty($storage_path)) {
            $error_msg = 'Storage Folder is null.';
            return $this->throw_error($error_msg);
        }
        if (empty($sftp)) {
            $error_msg = 'You must connect to SFTP before making directory.';
            return $this->throw_error($error_msg);
        }
        $storage_folders = explode("/", $storage_path);
        $path = '';
        foreach ($storage_folders as $dir) {
            $path = $path . '/' . $dir;
            if (!$sftp->file_exists($path)) {
                if (!$sftp->mkdir($path)) {
                    $error_msg = 'Directory not created ' . $path . '. Make sure you have write permissions on your SFTP server.';
                    return $this->throw_error($error_msg);
                }
            }
        }
        return $storage_path;
    }

    private function throw_error($error_msg = '')
    {
        if (!empty($error_msg)) {
            DUP_PRO_LOG::trace($error_msg);
            throw new \RuntimeException($error_msg);
        }
        return false;
    }
}
