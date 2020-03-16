<?php

namespace Chihhaoli\Scan2Pay;

use Chihhaoli\Scan2Pay\Constants\PaymentMethod;
use Chihhaoli\Scan2Pay\Constants\ServiceType;
use Chihhaoli\Scan2Pay\Exceptions\EasycardException;
use Chihhaoli\Scan2Pay\Exceptions\ShouldRetryException;

class Easycard extends Scan2Pay
{
    const ERROR_CODE_SUCCESS = '000000';

    /**
     * Make API request
     *
     * @param string $paymentMethod
     * @param string $serviceType
     * @param array $data
     * @return array
     * @throws \Chihhaoli\Scan2Pay\Exceptions\EasycardException
     * @throws \Chihhaoli\Scan2Pay\Exceptions\Scan2PayException
     * @throws \Chihhaoli\Scan2Pay\Exceptions\ShouldRetryException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Illuminate\Contracts\Encryption\DecryptException
     * @throws \Illuminate\Contracts\Encryption\EncryptException
     * @throws \JsonException
     * @throws \RuntimeException
     *
     */
    public function request(string $paymentMethod, string $serviceType, array $data): array
    {
        $response = parent::request($paymentMethod, $serviceType, $data);
        if ((int)($response['Data']['Retry'] ?? 0) === 1) {
             $exception = new ShouldRetryException();
             $exception->setResponse($response);
             throw new $exception;
        }
        if (($response['Data']['ErrorCode'] ?? self::ERROR_CODE_SUCCESS) !== self::ERROR_CODE_SUCCESS) {
            throw new EasycardException('', $response['Data']['ErrorCode']);
        }
        return $response;
    }

    /**
     * Set the DeviceId of the reader used in Easycard transaction
     *
     * @param string $deviceId
     * @return \Chihhaoli\Scan2Pay\Easycard
     */
    public function deviceId(string $deviceId): Easycard
    {
        $this->config['device_id'] = $deviceId;
        return $this;
    }

    /**
     * Obtain the device list
     * Obtain the information of the reader bound with the merchant ID
     *
     * @return array
     * @throws \Throwable
     */
    public function deviceQuery(): array
    {
        return $this->request(
            PaymentMethod::EASY_CARD,
            ServiceType::DEVICE_QUERY,
            [
                'DeviceId' => '00000000',
                'Retry' => '0',
            ]
        );
    }

    /**
     * Sign on
     * Before executing the functions on EasyCard reader, sign-on is required and it’s only valid for 30 hours. Please sign on again after 30 hours.
     *
     * @return array
     * @throws \Throwable
     */
    public function signOn(): array
    {
        return $this->request(
            PaymentMethod::EASY_CARD,
            ServiceType::SIGN_ON,
            [
                'DeviceId' => $this->config['device_id'],
                'Retry' => '0',
            ]
        );
    }

    /**
     * Query the card number
     *
     * @return array
     * @throws \Throwable
     */
    public function idQuery(): array
    {
        return $this->request(
            PaymentMethod::EASY_CARD,
            ServiceType::ID_QUERY,
            [
                'DeviceId' => $this->config['device_id'],
                'Retry' => '0',
            ]
        );
    }

    /**
     * Query the balance
     *
     * @return array
     * @throws \Throwable
     */
    public function balanceQuery(): array
    {
        return $this->request(
            PaymentMethod::EASY_CARD,
            ServiceType::BALANCE_QUERY,
            [
                'DeviceId' => $this->config['device_id'],
                'Retry' => '0',
            ]
        );
    }

    /**
     * Easycard Payment
     *
     * @param string $orderNo
     * @param string $amount
     * @param string $body
     * @return array
     * @throws \Throwable
     */
    public function easyCardPayment(string $orderNo, string $amount, string $body = ''): array
    {
        return $this->request(
            PaymentMethod::EASY_CARD,
            ServiceType::PAYMENT,
            [
                'DeviceId' => $this->config['device_id'],
                'Retry' => '0',
                'Amount' => $amount,
                'StoreOrderNo' => $orderNo,
                'Body' => $body,
            ]
        );
    }

    /**
     * Refund
     * Process the payment refund
     *
     * @param string $orderNo
     * @param string $amount
     * @return array
     * @throws \Throwable
     */
    public function easyCardRefund(string $orderNo, string $amount): array
    {
        return $this->request(
            PaymentMethod::EASY_CARD,
            ServiceType::REFUND,
            [
                'DeviceId' => $this->config['device_id'],
                'Retry' => '0',
                'Amount' => $amount,
                'StoreOrderNo' => $orderNo,
                'RefundKey' => hash('sha256', $this->config['refund_key']),
            ]
        );
    }

    /**
     * Settlement
     * Calling for daily settlement before closing the account
     *
     * @return array
     * @throws \Throwable
     */
    public function settlement(): array
    {
        return $this->request(
            PaymentMethod::EASY_CARD,
            ServiceType::SETTLEMENT,
            [
                'DeviceId' => $this->config['device_id'],
                'Retry' => '0',
            ]
        );
    }

    /**
     * Payment Retry
     *
     * @param array $response
     * @return array
     * @throws \Throwable
     */
    public function retry(array $response): array
    {
        $data = [
            'Retry' => $response['Data']['request']['Retry'],
            'DeviceId' => $response['Data']['request']['DeviceId'],
            'Amount' => $response['Data']['request']['Amount'],
            'StoreOrderNo' => $response['Data']['OrderId'],
            'TerminalTXNNumber' => $response['Data']['request']['TerminalTXNNumber'],
            'HostSerialNumber' => $response['Data']['request']['HostSerialNumber'],
        ];
        $serviceType = $response['Header']['ServiceType'];
        if (in_array($serviceType, [ServiceType::REFUND, ServiceType::CANCEL, ServiceType::EZC_REFUND])) {
            $data['RefundKey'] = hash('sha256', $this->config['refund_key']);
        }
        return $this->request(PaymentMethod::EASY_CARD, $serviceType, $data);
    }
}
