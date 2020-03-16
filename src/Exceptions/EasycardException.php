<?php

namespace Chihhaoli\Scan2Pay\Exceptions;

use Throwable;

/**
 * Class EasycardException
 *
 * @package Chihhaoli\Scan2Pay\Exceptions
 */
class EasycardException extends Scan2PayException
{
    /**
     * @var array
     */
    protected static $responseTexts = [

        // 00 Class
        '000003' => 'Invalid Merchant',
        '000004' => 'Invalid Card, already blocked',
        '000005' => 'Invalid Verification Code',
        '000012' => 'Invalid Payment',
        '000013' => 'Invalid Payment Amount',
        '000014' => 'Invalid Card ID',
        '000015' => 'Unknown Card Issuer',
        '000019' => 'Repeated Transaction',
        '000025' => 'Unable to retrieve data',
        '000030' => 'Data format error',
        '000041' => 'Card has been reported as missing',
        '000051' => 'Exceed balance',
        '000054' => 'Card already expired',
        '000057' => 'Transaction is not authorized',
        '000058' => 'Invalid Device',
        '000059' => 'Invalid Device',
        '000061' => 'Exceed payment limit',
        '000063' => 'Security Checking Failed',
        '000076' => 'No original transaction record',
        '000077' => 'Not matching the original transaction record',
        '000096' => 'System error or data error',
        '000097' => 'System error',
        '000098' => 'Payment error',
        '000125' => 'Require Retry',

        // 01 Class
        '010117' => 'The settlement of previous day is not completed',
        '010123' => 'Insufficient balance',
        '010128' => 'Retry data does not match the card',
        '010130' => 'Card had been cancelled',
        '010131' => 'Incorrect card type',
        '010132' => 'Blacklist card',
        '010133' => 'Card has been locked',
        '010134' => 'Card does not activated',
        '010139' => 'Card information no need to revise',

        // 02 Class
        '020000' => 'Successful approval',
        '020004' => 'Blocked card',
        '020005' => 'Invalid verification code',
        '020012' => 'Invalid Payment',
        '020013' => 'Invalid Payment Amount',
        '020019' => 'Repeated transaction',
        '020030' => 'Incorrect format',
        '020051' => 'Insufficient balance',
        '020054' => 'Expired card',
        '020055' => 'Renewal no need',
        '020057' => 'Transaction is unauthorized',
        '020058' => 'Unauthorized transaction for this terminal',
        '020059' => 'Device is not activated',
        '020061' => 'Exceed the amount limits',
        '020065' => 'Exceed the transaction limits',
        '020076' => 'Original transaction record not found',
        '020077' => 'Inconsistent transaction contents',
        '020090' => 'Bank side system error',
        '020094' => 'Bank side timeout',

        // 04 Class
        '049000' => 'Success',
        '046402' => 'Transaction amount exceeds the limit',
        '046403' => 'Insufficient balance',
        '04640C' => 'Accumulated deduction amount exceeds daily limit',
        '04640D' => 'Accumulated deduction numbers exceed the limit',
        '046700' => 'Reader instruction error',
        '046A80' => 'Reader instruction error',
        '046B00' => 'Reader instruction error',
        '046D00' => 'Reader instruction error',
        '046E00' => 'Reader instruction error',
        '046F00' => 'Reader instruction error',

        // 90 Class
        '900000' => 'System error',
        '900001' => 'Reader in-use',
        '900002' => 'Dongle ID not match',
        '908002' => 'Incorrect data format',
        '909995' => 'System error',


        'patterns' => [

            // 04 Class
            "0461\w{2}" => 'Unusual card, transaction declined',
            '0462\w{2}' => 'Exception on card reading, Please execute Retry transaction',
            '0463\w{2}' => 'Reader error',
            '0464\w{2}' => 'Transaction Declined',
            '0465\w{2}' => 'Reader error',
            '0466\w{2}' => 'Reader error',

            // F0 Class
            'F0\w{4}' => 'Please refer to error codes of each bank',
        ],
    ];

    /**
     * EasycardException constructor.
     *
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        if (empty($message) && self::hasError($code)) {
            $message = __('scan2pay::messages.' . self::$responseTexts[$code]);
            $message = preg_replace("/^scan2pay::messages\./", '', $message);
        }
        parent::__construct($message, $code, $previous);
    }

    /**
     * @param $code
     * @return string
     */
    public static function getErrorMessage($code): string
    {
        $message = '';
        if (isset(self::$responseTexts[$code])) {
            $message = self::$responseTexts[$code];
        } else {
            foreach (self::$responseTexts['patterns'] as $pattern) {
                if (preg_match("/^$pattern$/", $code)) {
                    $message = self::$responseTexts['patterns'][$pattern];
                    break;
                }
            }
        }
        $message = __('scan2pay::messages.' . $message);
        return preg_replace("/^scan2pay::messages\./", '', $message);
    }

    /**
     * @param $code
     * @return bool
     */
    public static function hasError($code): bool
    {
        if (isset(self::$responseTexts[$code])) {
            return true;
        }
        foreach (self::$responseTexts['patterns'] as $pattern) {
            if (preg_match("/^$pattern$/", $code)) {
                return true;
            }
        }
        return false;
    }
}
