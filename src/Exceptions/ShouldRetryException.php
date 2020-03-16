<?php

namespace Chihhaoli\Scan2Pay\Exceptions;

use RuntimeException;

/**
 * Class ShouldRetryException
 *
 * @package Chihhaoli\Scan2Pay\Exceptions
 */
class ShouldRetryException extends RuntimeException
{
    /**
     * @var null
     */
    protected $response = null;

    /**
     * @param array $response
     */
    public function setResponse(array $response): void
    {
        $this->response = $response;
    }

    /**
     * @return array|null
     */
    public function getResponse(): ?array
    {
        return $this->response;
    }
}
