<?php

namespace Chihhaoli\Scan2Pay\Exceptions;

use RuntimeException;
use Throwable;

/**
 * Class Scan2PayException
 * @package Chihhaoli\Scan2Pay\Exceptions
 */
class Scan2PayException extends RuntimeException
{
    /**
     * @var array
     */
    protected static $responseTexts = [

        // 99 Class
        '9999' => 'Server unavailable temporarily',
        '9998' => 'Transaction Failed',
        '9997' => 'Transaction is ongoing',
        '9996' => 'SSL socket error',
        '9995' => 'System error',
        '9994' => 'Network or crypto error',

        // 80 Class
        '8001' => 'Data conversion failed',
        '8002' => 'Incorrect data format',
        '8003' => 'Decryption failed',
        '8004' => 'Incorrect verification code',
        '8005' => 'Version not supported',
        '8006' => 'Login failed',
        '8007' => 'User not exists',
        '8008' => 'The account is already logged in to another device',
        '8009' => 'Invalid session',
        '8010' => 'Incorrect transmission method',
        '8011' => 'There was an error in the database. Please contact the system administrator',
        '8012' => 'Exchange rate service error',
        '8013' => 'Repeated user or ID',
        '8014' => 'The transaction had reached the value of risk management',
        '8015' => 'Network connection failed',

        // 70 Class
        '7000' => 'Repeated order number',
        '7001' => 'Order already refunded or cancelled',
        '7002' => 'Order number not exists',
        '7003' => 'Repeated refund number ',
        '7004' => 'Refund not existed',

        // 71 Class
        '7100' => 'Security check failed',
        '7101' => 'Transaction tag not found',
        '7102' => 'Order number verification failed',
        '7103' => 'Order amount verification failed',
        '7104' => 'Refund number verification failed',
        '7105' => 'Incorrect TradeKey or RefundKey',
        '7106' => 'Merchant device error',
        '7107' => 'Refund amount verification failed',
        '7108' => 'Too close to the last refund transaction time',
        '7110' => 'Inconsistent refund amount',
        '7111' => 'Total refund amount exceeds the order amount',
        '7112' => 'Order has already been refunded',
        '7113' => 'Original order transaction failed',
        '7114' => 'Order processing',
        '7115' => 'Information inconsistent to original order',
        '7116' => 'Information inconsistent to original refund',
        '7117' => 'Transaction type not found',
        '7118' => 'Invalid transaction type',
        '7119' => 'Refund processing',
        '7120' => 'Barcode or instruction format error',
        '7121' => 'Barcode not found',
        '7122' => 'Incorrect payment password',
        '7123' => 'Barcode expired',
        '7124' => 'Incorrect time format',
        '7125' => 'Incorrect amount format',
        '7126' => 'Incorrect amount or amount exceeds the limit',
        '7127' => 'Incorrect Store Order number',
        '7128' => 'Incorrect format of store transaction number',
        '7129' => 'Incorrect store number',
        '7130' => 'Incorrect device number',
        '7131' => 'Incorrect item format',
        '7132' => 'Incorrect Merchant ID',
        '7133' => 'Repeated cancellation of order',
        '7134' => 'Order cancellation failed',
        '7135' => 'Incorrect system transaction number',
        '7136' => 'Incorrect refund object',
        '7137' => 'Repeated refund',
        '7138' => 'Refund failed',
        '7139' => 'Incorrect format of refund amount',
        '7140' => 'Incorrect query object',
        '7141' => 'Query failed',
        '7142' => 'Order creation failed',
        '7143' => 'Incorrect merchant verification token',
        '7144' => 'Merchant verification token not found',
        '7145' => 'Exception found in merchant API request activities, access denied',
        '7146' => 'Repeated transaction number',
        '7147' => 'Transaction method not exists',
        '7148' => 'Billing message is too long',
        '7149' => 'Order notification is too long',
        '7150' => 'Incorrect format of product information',
        '7151' => 'The product name is too long',
        '7152' => 'Incorrect format of product quantity',
        '7153' => 'Incorrect format of product price',
        '7154' => 'Refund message is too long',
        '7155' => 'Refund period expired ',
        '7156' => 'Certificate not exists (Merchant)',
        '7157' => 'Certificate not exists (Platform)',
        '7158' => 'Merchant IP verification error',
        '7159' => 'Incorrect payment method code',
        '7160' => 'Incorrect order currency',
        '7161' => 'Payment platform exchange rate not exists',
        '7162' => 'Exchange rate not exists',
        '7163' => 'Merchant is currently unable to create a payment order',
        '7164' => 'Return to URL before the payment completed',
        '7165' => 'Incorrect format of Response URL ',
        '7166' => 'Illegal URL or not a whitelist',
        '7167' => 'Device ID deactivated',
        '7168' => 'Incorrect refund key',

        // 72 Class
        '7200' => 'Offline service not activated',
        '7201' => 'Merchant not activated',
        '7202' => 'Signature verification error',
        '7203' => 'Payment method cannot be used',

        // 73 Class
        '7300' => 'Please contact the card issuing bank',
        '7301' => 'Transaction declined',
        '7302' => 'Card left in the machine',
        '7303' => 'Card expired',
        '7304' => 'Incorrect transaction date',
        '7305' => 'Transaction timeout',
        '7306' => 'Risk card number or installment bonus data failed to read',
        '7307' => 'Incorrect installment data',
        '7308' => 'Incorrect bonus point data',
        '7309' => 'Installment payment not available',
        '7310' => 'Bonus point payment not available',
        '7311' => 'Installment transaction, please enter the number of installment',
        '7312' => 'Incorrect entering of transaction type',
        '7313' => 'Transaction timeout',
        '7314' => 'Incorrect card number',
        '7315' => '3D secure verification failed',
        '7316' => 'incorrect format of card valid date',
        '7317' => 'The function is not supported by the terminal',
        '7318' => 'Incorrect entering of transaction code',
        '7319' => 'Invalid order number, cannot cancel the authorization ',
        '7320' => 'Terminal has not been filed',
        '7321' => 'Invalid 3D secure signature of card issuer',
        '7322' => "Error replied by card issuer's 3D verification server",
        '7323' => 'Amount exceeds the merchant monthly limit',
        '7324' => 'Amount of single transaction exceeds ',
        '7325' => 'Repeated request of billing',
        '7326' => 'Incorrect cardholder IP',
        '7327' => 'Transaction cancellation expired',
        '7328' => 'Installment payment is not available for this card type',
        '7329' => 'Bonus point payment expired for this card type',
        '7330' => 'Deactivated card type',
        '7340' => 'Bonus point payment is not available',
        '7341' => 'Transfer to the card issuing bank for 3D secure verification',
        '7342' => 'Credit card authorization failed',
        '7343' => 'Installment transaction is not available for international credit cards',
        '7344' => 'International credit card is not acceptable in this store',
        '7345' => 'Reached the credit card authorization amount ',
        '7346' => 'Not full-settlement or full-refund for installment transaction',
        '7347' => 'Incorrect format of CVV',
        '7348' => 'Direct authorization of card number is not acceptable',
        '7349' => 'Credit card lump-sum payment is not acceptable by this merchant',

        // 60 Class
        '6001' => 'Invoice cancelled',
        '6002' => 'Invoice not exists',

        // Other Class
        '7404' => 'Unknown error',
        '2000' => 'No information found',
        '2005' => 'Data correspondence exception',
    ];

    /**
     * Scan2PayException constructor.
     *
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        if (empty($message)) {
            $message = self::getErrorMessage($code);
        }
        parent::__construct($message, $code, $previous);
    }

    /**
     * @param $code
     * @return string
     */
    public static function getErrorMessage($code): string
    {
        $message = __('scan2pay::messages.' . self::$responseTexts[$code] ?? '');
        return preg_replace("/^scan2pay::messages\./", '', $message);
    }

    /**
     * @param $code
     * @return bool
     */
    public static function hasError($code): bool
    {
        return isset(self::$responseTexts[$code]);
    }
}
