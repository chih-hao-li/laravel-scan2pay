<?php

namespace Chihhaoli\Scan2Pay\Constants;

/**
 * Class PaymentMethod
 *
 * @package Chihhaoli\Scan2Pay\Constants
 */
class PaymentMethod
{
    /**
     * Indefinite payment method
     * 不指定支付平台
     *
     * Indefinite payment method, can be Merchant/Customer-Presented QR Code
     * 消費者正掃/被掃可不指定支付平台
     */
    public const INDEFINITE = '00000';

    /**
     * WeChat
     * 微信
     *
     * SK Bank / Cross-border payment (for Chinese customer only)
     * 新光銀行 / 跨境支付 (中國大陸消費者適用)
     */
    public const WECHAT_SK = '10110';

    /**
     * WeChat
     * 微信
     *
     * CTBC Bank / Cross-border payment (for Chinese customer only)
     * 中國信託 / 跨境支付 (中國大陸消費者適用)
     */
    public const WECHAT_CTBC = '12710';

    /**
     * Alipay
     * 支付寶
     *
     * Yuanta Bank / Cross-border payment (for Chinese customer only)
     * 元大銀行 / 跨境支付 (中國大陸消費者適用)
     */
    public const ALIPAY_YUANTA = '10220';

    /**
     * Alipay
     * 支付寶
     *
     * SCSB / Cross-border payment (for Chinese customer only)
     * 上海商銀 / 跨境支付 (中國大陸消費者適用)
     */
    public const ALIPAY_SCSB = '12520';

    /**
     * Pi
     */
    public const PI = '10300';

    /**
     * O'Pay
     * 歐付寶
     */
    public const OPAY = '10500';

    /**
     * JKOPAY
     * 街口支付
     *
     * Customer-Presented QR Code
     * 消費者被掃
     */
    public const JKOPAY = '10900';

    /**
     * GAMA PAY
     * 橘子支
     */
    public const GAMA_PAY = '11300';

    /**
     * Aipei
     * 愛貝錢包
     */
    public const AIPEI = '11400';

    /**
     * LINE Pay
     */
    public const LINE_PAY = '11500';

    /**
     * Taiwan Pay
     * 台灣行動支付
     *
     * Can be Merchant/Customer-Presented QR Code, acquirer-SCSB
     * 消費者正/被掃, 上海商銀收單
     */
    public const TAIWAN_PAY_SCSB = '12000';

    /**
     * Taiwan Pay
     * 台灣行動支付
     *
     * Customer-Presented QR Code (Acquirer-Mega Bank)
     * 消費者被掃, 兆豐銀行收單
     */
    public const TAIWAN_PAY_MEGA_BANK = '13500';

    /**
     * Fubon LuckyPAY
     * 富邦 LuckyPAY
     */
    public const LUCKY_PAY = '13000';

    /**
     * DGPay
     * 數位付
     *
     * Using account ID and password to process the transaction
     * 使用帳密輸入交易
     */
    public const DG_PAY = '13110';

    /**
     * Credit Card Payment
     * 信用卡交易
     *
     * Indefinite acquirer bank/platform
     * 不指定支付平台
     */
    public const CREDIT_CARD = '20000';

    /**
     * Credit Card Payment
     * 信用卡交易
     *
     * Acquirer-Taishin Bank
     * 台新銀行收單
     */
    public const CREDIT_CARD_TAISHIN = '20800';

    /**
     * Credit Card Payment
     * 信用卡交易
     *
     * Acquirer-ECPay
     * 綠界信用卡收單
     */
    public const CREDIT_CARD_ECPAY = '21100';

    /**
     * Credit Card Payment
     * 信用卡交易
     *
     * Acquirer-SCSB
     * 上海商銀收單
     */
    public const CREDIT_CARD_SCSB = '22600';

    /**
     * Credit Card Payment
     * 信用卡交易
     *
     * Acquirer-Fubon Bank
     * 富邦銀行收單
     */
    public const CREDIT_CARD_FUBON = '23200';

    /**
     * Apple Pay
     *
     * Acquirer-Taishin Bank
     * 台新銀行收單
     */
    public const APPLE_PAY_TAISHIN = '20740';

    /**
     * Apple Pay
     *
     * Acquirer-Fubon Bank
     * 富邦銀行收單
     */
    public const APPLE_PAY_FUBON = '23240';

    /**
     * EasyCard
     * 悠遊卡
     *
     * To use with card reader
     * 搭配讀卡機使用
     */
    public const EASY_CARD = '31800';

    /**
     * iPass
     * 一卡通
     *
     * To use with card reader (Not available for normal merchant)
     * 搭配讀卡機使用 (尚未開放一般店家申請)
     */
    public const I_PASS = '32100';

    /**
     * iCASH
     * 愛金卡
     *
     * To use with card reader
     * 搭配讀卡機使用
     */
    public const ICASH = '32800';

    /**
     * Pi InApp
     *
     * InApp transaction
     * 使用於 InApp 交易
     */
    public const PI_IN_APP = '60300';

    /**
     * O'Pay InApp
     * 歐付寶 InApp
     *
     * InApp transaction
     * 使用於 InApp 交易
     */
    public const OPAY_IN_APP = '60500';
}
