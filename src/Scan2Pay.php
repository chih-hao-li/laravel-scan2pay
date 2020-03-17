<?php

namespace Chihhaoli\Scan2Pay;

use Chihhaoli\Scan2Pay\Constants\PaymentMethod;
use Chihhaoli\Scan2Pay\Constants\ServiceType;
use Chihhaoli\Scan2Pay\Exceptions\Scan2PayException;
use Chihhaoli\Scan2Pay\Utils\Encrypter;
use GuzzleHttp\Client;
use JsonException;
use UnexpectedValueException;

/**
 * Class Scan2Pay
 *
 * @package Chihhaoli\Scan2Pay
 */
class Scan2Pay
{
    const API_PATH = '/allpaypass/api/general';
    const STATUS_CODE_SUCCESS = '0000';

    /**
     * @var
     */
    protected $config;

    /**
     * Scan2Pay constructor.
     *
     * @param $config
     */
    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * Replace MchId, TradeKey, RefundKey with new values.
     *
     * @param string $mchId
     * @param string $tradeKey
     * @param string $refundKey
     * @return \Chihhaoli\Scan2Pay\Scan2Pay
     */
    public function init(string $mchId, string $tradeKey, string $refundKey): Scan2Pay
    {
        $this->config['merchant_id'] = $mchId;
        $this->config['trade_key'] = $tradeKey;
        $this->config['refund_key'] = $refundKey;
        return $this;
    }

    /**
     * Set StoreInfo for request (optional).
     *
     * @param string $storeInfo
     * @return \Chihhaoli\Scan2Pay\Scan2Pay
     */
    public function storeInfo(string $storeInfo): Scan2Pay
    {
        $this->config['store_info'] = $storeInfo;
        return $this;
    }

    /**
     * Set Cashier for request (optional).
     *
     * @param string $cashier
     * @return \Chihhaoli\Scan2Pay\Scan2Pay
     */
    public function cashier(string $cashier): Scan2Pay
    {
        $this->config['cashier'] = $cashier;
        return $this;
    }

    /**
     * Set StoreName for request (optional).
     *
     * @param string $storeName
     * @return \Chihhaoli\Scan2Pay\Scan2Pay
     */
    public function storeName(string $storeName): Scan2Pay
    {
        $this->config['store_name'] = $storeName;
        return $this;
    }

    /**
     * Set StoreType for request (optional).
     *
     * @param string $storeType
     * @return \Chihhaoli\Scan2Pay\Scan2Pay
     */
    public function storeType(string $storeType): Scan2Pay
    {
        $this->config['store_type'] = $storeType;
        return $this;
    }

    /**
     * Set DeviceOS for request (optional).
     *
     * @param string $deviceOs
     * @return \Chihhaoli\Scan2Pay\Scan2Pay
     */
    public function deviceOs(string $deviceOs): Scan2Pay
    {
        $this->config['device_os'] = $deviceOs;
        return $this;
    }

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
     */
    protected function request(string $paymentMethod, string $serviceType, array $data): array
    {
        $data = array_filter($data, function ($value) {
            return !is_null($value);
        });
        $requestData = [
            'Header' => [
                'Method' => $paymentMethod,
                'ServiceType' => $serviceType,
                'MchId' => $this->config['merchant_id'],
                'TradeKey' => hash('sha256', $this->config['trade_key']),
                'CreateTime' => date('YmdHis'),
            ],
            'Data' => json_encode($data),
        ];

        // Encrypting the Request by AES-KEY
        $aesKey = Encrypter::generateKey('AES-128-CBC');
        $encrypter = new Encrypter($aesKey, $this->config['iv']);
        $request = $encrypter->encrypt(json_encode($requestData), false);

        // Encrypting the AES-KEY by RSA Public Key
        $pubKeyId = openssl_pkey_get_public(file_get_contents($this->config['public_key_path']));
        $publicKey = openssl_pkey_get_details($pubKeyId);
        openssl_public_encrypt(base64_encode($aesKey), $apiKey, $publicKey['key']);
        $apiKey = base64_encode($apiKey);

        // Send request
        $client = new Client(['base_uri' => $this->config['api_domain']]);
        $result = $client->request('POST', self::API_PATH, [
            'json' => [
                'Request' => $request,
                'ApiKey' => $apiKey,
            ],
        ]);

        // Parse response
        $resultData = json_decode($result->getBody()->getContents());
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new JsonException('Error parsing response: ' . json_last_error_msg(), json_last_error());
        }
        if (!isset($resultData->Response)) {
            $errorCode = (string)$result->getBody();
            if (Scan2PayException::hasError($errorCode)) {
                throw new Scan2PayException('', $errorCode);
            }
            throw new UnexpectedValueException('Error response format');
        }

        // Decrypt response data
        $encryptedResponse = str_replace(["\n", "\u003d"], ['', '='], $resultData->Response);
        $response = json_decode($encrypter->decrypt($encryptedResponse, false), true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new JsonException('Error parsing decrypted response: ' . json_last_error_msg(), json_last_error());
        }
        if (empty($response['Header']['StatusCode'] ?? '') || !isset($response['Data'])) {
            throw new UnexpectedValueException('Error response format');
        }
        if ($response['Header']['StatusCode'] !== self::STATUS_CODE_SUCCESS) {
            throw new Scan2PayException($response['Header']['StatusDesc'], $response['Header']['StatusCode']);
        }

        return $response;
    }

    /**
     * Signature Verification
     *
     * @param array|string $data
     * @throws \JsonException
     * @throws \Chihhaoli\Scan2Pay\Exceptions\Scan2PayException
     */
    public function verifySignature($data): void
    {
        if (!is_array($data)) {
            $data = json_decode($data, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new JsonException('Error parsing request data: ' . json_last_error_msg(), json_last_error());
            }
        }
        $sign = base64_decode(str_replace('\u003d', '=', $data['Sign']));
        unset($data['Sign']);
        $data = json_encode($data, JSON_UNESCAPED_UNICODE);
        $pubKeyId = openssl_pkey_get_public(file_get_contents($this->config['public_key_path']));
        $result = openssl_verify($data, $sign, $pubKeyId,OPENSSL_ALGO_SHA256);
        openssl_free_key($pubKeyId);
        if ($result !== 1) {
            throw new Scan2PayException('', '7202');
        }
    }

    /**
     * Merchant-Presented QR Code
     * OLPay obtains a transaction URL and transforms it to a QR code that allows consumer to scan by their mobile device.
     *
     * @param string $orderNo
     * @param string $totalFee
     * @param string $body
     * @param string $feeType
     * @param string|null $timeExpire
     * @param string|null $detail
     * @return array
     * @throws \Throwable
     */
    public function olPay(
        string $orderNo,
        string $totalFee,
        string $body,
        string $feeType = 'TWD',
        string $timeExpire = null,
        string $detail = null
    ): array
    {
        return $this->request(
            PaymentMethod::INDEFINITE,
            ServiceType::OL_PAY,
            [
                'TimeExpire' => $timeExpire,
                'DeviceInfo' => 'skb0001',
                'StoreOrderNo' => $orderNo,
                'Body' => $body,
                'FeeType' => $feeType,
                'TotalFee' => $totalFee,
                'Detail' => $detail,
                'StoreInfo' => $this->config['store_info'] ?? null,
                'Cashier' => $this->config['cashier'] ?? null,
                'StoreName' => $this->config['store_name'] ?? null,
                'StoreType' => $this->config['store_type'] ?? null,
                'DeviceOS' => $this->config['device_os'] ?? null,
            ]
        );
    }

    /**
     * Customer-Presented QR Code
     * Consumer presents QR Code provided by each payment, the payee scans the QR Code to obtain the transaction authorization code to process the payment.
     */
    public function micropay()
    {
        // TODO: Not implemented
    }

    /**
     * Credit Card Payment
     * Obtains credit card authorization to process the transaction.
     *
     * @param string $orderNo
     * @param string $totalFee
     * @param string $body
     * @param string $cardId
     * @param string $extenNo
     * @param string $expireDate
     * @param string $feeType
     * @param string|null $timeExpire
     * @param string|null $detail
     * @return array
     * @throws \Throwable
     */
    public function creditCardPayment(
        string $orderNo,
        string $totalFee,
        string $body,
        string $cardId,
        string $extenNo,
        string $expireDate,
        string $feeType = 'TWD',
        string $timeExpire = null,
        string $detail = null
    ): array
    {
        return $this->request(
            PaymentMethod::CREDIT_CARD,
            ServiceType::PAYMENT,
            [
                'TimeExpire' => $timeExpire,
                'DeviceInfo' => 'skb0001',
                'StoreOrderNo' => $orderNo,
                'Body' => $body,
                'FeeType' => $feeType,
                'TotalFee' => $totalFee,
                'Detail' => $detail,
                'StoreInfo' => $this->config['store_info'] ?? null,
                'StoreName' => $this->config['store_name'] ?? null,
                'StoreType' => $this->config['store_type'] ?? null,
                'DeviceOS' => $this->config['device_os'] ?? null,
                'CardId' => $cardId,
                'ExtenNo' => $extenNo,
                'ExpireDate' => $expireDate,
            ]
        );
    }

    /**
     * Refund
     * Full refund of the transaction
     *
     * @param string $orderNo
     * @param string $refundFee
     * @param string $refundNo
     * @param string $refundedMsg
     * @return array
     * @throws \Throwable
     */
    public function refund(
        string $orderNo,
        string $refundFee,
        string $refundNo,
        string $refundedMsg = ''
    ): array
    {
        return $this->request(
            PaymentMethod::INDEFINITE,
            ServiceType::REFUND,
            [
                'StoreRefundNo' => $refundNo,
                'StoreOrderNo' => $orderNo,
                'DeviceInfo' => 'skb0001',
                'StoreInfo' => $this->config['store_info'] ?? null,
                'Cashier' => $this->config['cashier'] ?? null,
                'RefundKey' => hash('sha256', $this->config['refund_key']),
                'RefundFee' => (int)$refundFee,
                'RefundedMsg' => $refundedMsg,
            ]
        );
    }

    /**
     * Single Transaction Query
     * Query single transaction by order number
     *
     * @param string $orderNo
     * @return array
     * @throws \Throwable
     */
    public function singleOrderQuery(string $orderNo): array
    {
        return $this->request(
            PaymentMethod::INDEFINITE,
            ServiceType::SINGLE_ORDER_QUERY,
            [
                'DeviceId' => $this->config['device_id'],
                'Retry' => '0',
                'StoreOrderNo' => $orderNo,
            ]
        );
    }

    /**
     * Multiple Transactions Query
     * Query multiple transactions by date range
     *
     * @param string $startDate
     * @param string $endDate
     * @param int $orderStatus
     * @param string $orderNo
     * @return array
     * @throws \Throwable
     */
    public function orderQuery(
        string $startDate,
        string $endDate,
        int $orderStatus,
        string $orderNo = ''
    ): array
    {
        $query = [
            'StartDate' => $startDate,
            'EndDate' => $endDate,
            'OrderStatus' => (string)$orderStatus,
        ];
        if (!empty($orderNo)) {
            $query['StoreOrderNo'] = $orderNo;
        }
        return $this->request(
            PaymentMethod::INDEFINITE,
            ServiceType::ORDER_QUERY,
            $query
        );
    }

}
