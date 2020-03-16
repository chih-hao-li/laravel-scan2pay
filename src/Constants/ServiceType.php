<?php

namespace Chihhaoli\Scan2Pay\Constants;

/**
 * Class ServiceType
 *
 * @package Chihhaoli\Scan2Pay\Constants
 */
class ServiceType
{
    /**
     * Merchant-presented QR codes
     * 消費者主掃
     *
     * Obtain a URL to generate a QR code for consumer to scan
     * 用來取得URL產生QR Code供消費者掃描交易
     */
    public const OL_PAY = 'OLPay';

    /**
     * Consumer-presented QR codes
     * 消費者被掃
     *
     * Consumer display the QR code on their mobile device for merchant to scan
     * 掃描消費者QR Code進行交易
     */
    public const MICRO_PAY = 'Micropay';

    /**
     * Credit card payment
     * 信用卡授權 / 悠遊卡扣款
     *
     * Credit card authorization transaction
     * 使用信用卡授權交易
     */
    public const PAYMENT = 'Payment';

    /**
     * Refund
     * 退款
     *
     * Payment refund
     * 退款
     */
    public const REFUND = 'Refund';

    /**
     * Single transaction query
     * 單筆交易查詢
     *
     * Query single transaction by order number
     * 依據訂單編號查詢單筆交易
     */
    public const SINGLE_ORDER_QUERY = 'SingleOrderQuery';

    /**
     * Multiple transactions query
     * 多筆交易查詢
     *
     * Query multiple transactions by date range
     * 依據日期區間查詢交易
     */
    public const ORDER_QUERY = 'OrderQuery';


    /**
     * Functions for EasyCard
     * 悠遊卡操作
     */

    /**
     * Obtain the device list
     * 取得裝置清單
     *
     * Obtain the device list under the merchant ID
     * 取得特店帳號下的裝置清單
     */
    public const DEVICE_QUERY = 'DeviceQuery';

    /**
     * Sign on
     * 登入
     *
     * Sign-on is required for EasyCard transaction, and it's only valid for 30 hours
     * 悠遊卡交易需先進行登入, 登入逾30小時需重新登入
     */
    public const SIGN_ON = 'SignOn';

    /**
     * Query the card number
     * 卡片查詢
     *
     * Obtain the card number
     * 取得卡片號碼
     */
    public const ID_QUERY = 'IdQuery';

    /**
     * Query the balance
     * 餘額查詢
     *
     * Check the balance of the card
     * 卡片餘額查詢
     */
    public const BALANCE_QUERY = 'BalanceQuery';

    /**
     * Settlement
     * 結帳
     *
     * Settlement (Calling for daily settlement before closing the account)
     * 結帳 (每日關帳前呼叫進行日結)
     */
    public const SETTLEMENT = 'Settlement';

    /**
     * Top-up
     * 加值
     *
     * Not yet available
     * 尚不開放
     */
    public const RESERVE = 'Reserve';

    /**
     * Query the top-up
     * 加值查詢
     *
     * Not yet available
     * 尚不開放
     */
    public const RESERVE_ORDER_QUERY = 'ReserveOrderQuery';


    /**
     * Query the order cancellation
     * 取消交易查詢
     *
     * Not yet available
     * 尚不開放
     */
    public const CANCEL_ORDER_QUERY = 'CancelOrderQuery';

    /**
     * Cancellation of the purchase
     * 購貨取消
     *
     * Not yet available
     * 尚不開放
     */
    public const CANCEL = 'Cancel';

    /**
     * Cash refund
     * 現金退款
     *
     * Directly refund to the card
     * 卡片直接退款
     */
    public const EZC_REFUND = 'EZCRefund';

    /**
     * Query the card transaction history
     * 卡片上消費記錄查詢
     *
     * Query the transaction history of the card
     * 查詢卡片上的消費記錄
     */
    public const EZC_ORDER_QUERY = 'EZCOrderQuery';
}
