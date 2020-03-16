<?php

namespace Chihhaoli\Scan2Pay\Utils;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Contracts\Encryption\EncryptException;
use RuntimeException;

/**
 * Class Encrypter
 *
 * @package Chihhaoli\Scan2Pay\Utils
 */
class Encrypter extends \Illuminate\Encryption\Encrypter
{
    /**
     * The specified IV.
     *
     * @var string
     */
    protected $iv;

    /**
     * Create a new encrypter instance.
     *
     * @param  string  $key
     * @param  string  $iv
     * @param  string  $cipher
     * @return void
     *
     * @throws RuntimeException
     */
    public function __construct($key, $iv, $cipher = 'AES-128-CBC')
    {
        parent::__construct($key, $cipher);
        $this->iv = $iv;
    }

    /**
     * Encrypt the given value.
     *
     * @param mixed $value
     * @param bool $serialize
     * @return string
     *
     * @throws EncryptException
     */
    public function encrypt($value, $serialize = true)
    {
        $iv = $this->iv;

        // First we will encrypt the value using OpenSSL. After this is encrypted we
        // will proceed to calculating a MAC for the encrypted value so that this
        // value can be verified later as not having been changed by the users.
        $value = openssl_encrypt(
            $serialize ? serialize($value) : $value,
            $this->cipher, $this->key, 0, $iv
        );

        if ($value === false) {
            throw new EncryptException('Could not encrypt the data.');
        }

        return $value;
    }

    /**
     * Decrypt the given value.
     *
     * @param  string  $encryptedString
     * @param  bool  $unserialize
     * @return mixed
     *
     * @throws DecryptException
     */
    public function decrypt($encryptedString, $unserialize = true)
    {
        // Here we will decrypt the value. If we are able to successfully decrypt it
        // we will then unserialize it and return it out to the caller. If we are
        // unable to decrypt this value we will throw out an exception message.
        $decrypted = openssl_decrypt(
            $encryptedString, $this->cipher, $this->key, 0, $this->iv
        );

        if ($decrypted === false) {
            throw new DecryptException('Could not decrypt the data.');
        }

        return $unserialize ? unserialize($decrypted) : $decrypted;
    }
}
