<?php

return [

    // Scan2Pay status
    'Success' => '執行成功',
    'Server unavailable temporarily' => '系統暫時無法提供服務',
    'Transaction Failed' => '交易失敗',
    'Transaction is ongoing' => '交易處理中',
    'SSL socket error' => '連接 SSL Socket Server 失敗',
    'System error' => '系統錯誤',
    'Network or crypto error' => '資料加密或解密錯誤',
    'Data conversion failed' => '資料轉換失敗',
    'Incorrect data format' => '資料格式不正確',
    'Decryption failed' => '解密失敗',
    'Incorrect verification code' => '校驗碼錯誤',
    'Version not supported' => '版本不支援',
    'Login failed' => '登入失敗',
    'User not exists' => '使用者不存在',
    'The account is already logged in to another device' => '帳號已在其它設備登入',
    'Invalid session' => 'Session 無效',
    'Incorrect transmission method' => '傳輸方式錯誤',
    'There was an error in the database. Please contact the system administrator' => '資料庫發生錯誤，請聯絡系統管理員',
    'Exchange rate service error' => '匯率服務發生錯誤',
    'Repeated user or ID' => '使用者或 ID 重複',
    'The transaction had reached the value of risk management' => '交易已達風控設定值',
    'Network connection failed' => '網路連線失敗',
    'Repeated order number' => '訂單編號已重複',
    'Order already refunded or cancelled' => '訂單已撤銷',
    'Order number not exists' => '訂單資料不存在',
    'Repeated refund number ' => '退款單編號已重複',
    'Refund not existed' => '退款單資料不存在',
    'Security check failed' => '資料未通過安全檢核',
    'Transaction tag not found' => '未傳入交易標記',
    'Order number verification failed' => '訂單編號驗證失敗',
    'Order amount verification failed' => '訂單金額驗證失敗',
    'Refund number verification failed' => '退款單編號驗證失敗',
    'Incorrect TradeKey or RefundKey' => '特店交易密碼錯誤',
    'Merchant device error' => '特店設備錯誤',
    'Refund amount verification failed' => '退款金額驗證失敗',
    'Too close to the last refund transaction time' => '與上筆退款交易時間過近',
    'Inconsistent refund amount' => '退款訂單金額不合',
    'Total refund amount exceeds the order amount' => '退款總金額超過訂單金額',
    'Order has already been refunded' => '訂單已全額退款',
    'Original order transaction failed' => '該退款單的原訂單交易失敗',
    'Order processing' => '訂單處理中',
    'Information inconsistent to original order' => '與原訂單資料不符合',
    'Information inconsistent to original refund' => '與原退款單資料不符合',
    'Transaction type not found' => '未傳入性質別',
    'Invalid transaction type' => '性質別驗證無效',
    'Refund processing' => '有退款單正在處理中',
    'Barcode or instruction format error' => '條碼或指令格式錯誤',
    'Barcode not found' => '找不到此條碼',
    'Incorrect payment password' => '支付密碼錯誤',
    'Barcode expired' => '條碼已過期無法使用',
    'Incorrect time format' => '時間格式錯誤',
    'Incorrect amount format' => '金額格式不符合',
    'Incorrect amount or amount exceeds the limit' => '金額錯誤或超過上限',
    'Incorrect Store Order number' => '訂單編號錯誤',
    'Incorrect format of store transaction number' => '商店交易序號格式錯誤',
    'Incorrect store number' => '門市代號錯誤',
    'Incorrect device number' => '設備代號錯誤',
    'Incorrect item format' => '項目格式錯誤',
    'Incorrect Merchant ID' => '商店代號錯誤',
    'Repeated cancellation of order' => '重覆取消交易',
    'Order cancellation failed' => '取消交易失敗',
    'Incorrect system transaction number' => '系統交易編號錯誤',
    'Incorrect refund object' => '退款對象錯誤',
    'Repeated refund' => '重複退款',
    'Refund failed' => '退款失敗',
    'Incorrect format of refund amount' => '退款金額格式錯誤',
    'Incorrect query object' => '查詢對象錯誤',
    'Query failed' => '查詢失敗',
    'Order creation failed' => '建立訂單失敗',
    'Incorrect merchant verification token' => '廠商身份驗證錯誤',
    'Merchant verification token not found' => '找不到此廠商身份驗證 token',
    'Exception found in merchant API request activities, access denied' => '廠商請求 API 行為偵測出異常，拒絕存取',
    'Repeated transaction number' => '交易單編號重複',
    'Transaction method not exists' => '訂單交易接受方式不存在',
    'Billing message is too long' => '帳單訊息字數過長',
    'Order notification is too long' => '訂單提示訊息字數過長',
    'Incorrect format of product information' => '商品資訊清單格式錯誤',
    'The product name is too long' => '商品名稱字數過長',
    'Incorrect format of product quantity' => '商品數量格式錯誤',
    'Incorrect format of product price' => '商品價格格式錯誤',
    'Refund message is too long' => '退款訊息字數過長',
    'Refund period expired ' => '超過允許退款時間',
    'Certificate not exists (Merchant)' => '憑證不存在(特店)',
    'Certificate not exists (Platform)' => '憑證不存在(本平台)',
    'Merchant IP verification error' => '特店 IP 檢核錯誤',
    'Incorrect payment method code' => '支付平台代號錯誤',
    'Incorrect order currency' => '訂單幣別錯誤',
    'Payment platform exchange rate not exists' => '支付平台匯率資料不存在[支付業者]',
    'Exchange rate not exists' => '匯率資料不存在',
    'Merchant is currently unable to create a payment order' => '商戶目前無法建立付款訂單',
    'Return to URL before the payment completed' => '行動裝置未付款時返回網址',
    'Incorrect format of Response URL ' => '回應網址格式錯誤',
    'Illegal URL or not a whitelist' => '網址不合法，未列為白名單',
    'Device ID deactivated' => '設備代號停用',
    'Incorrect refund key' => '退款密碼錯誤',
    'Offline service not activated' => '線下服務未開通',
    'Merchant not activated' => '特店服務未開通',
    'Signature verification error' => '加密簽章驗簽錯誤',
    'Payment method cannot be used' => '無法使用此支付通道',
    'Please contact the card issuing bank' => '請與發卡銀行聯絡',
    'Transaction declined' => '拒絕交易',
    'Card left in the machine' => '沒收卡片',
    'Card expired' => '卡片過期',
    'Incorrect transaction date' => '交易日期錯誤',
    'Transaction timeout' => '交易逾時',
    'Risk card number or installment bonus data failed to read' => '風險卡號或分期紅利資料讀取失敗',
    'Incorrect installment data' => '分期資料錯誤',
    'Incorrect bonus point data' => '紅利資料錯誤',
    'Installment payment not available' => '不支援分期交易',
    'Bonus point payment not available' => '不支援紅利交易',
    'Installment transaction, please enter the number of installment' => '分期交易,請輸入分期期數',
    'Incorrect entering of transaction type' => '交易模式輸入錯誤',
    'Incorrect card number' => '卡號錯誤',
    '3D secure verification failed' => '3D 交易認證錯誤',
    'incorrect format of card valid date' => '卡片效期格式錯誤',
    'The function is not supported by the terminal' => '端末機不支援此功能',
    'Incorrect entering of transaction code' => '交易代碼輸入錯誤',
    'Invalid order number, cannot cancel the authorization ' => '非有效訂單編號，無法取消授權',
    'Terminal has not been filed' => '端末機尚未建檔',
    'Invalid 3D secure signature of card issuer' => '發卡行 3D 認證數 簽章驗章失敗',
    "Error replied by card issuer's 3D verification server" => '發卡行 3D 認證主機回覆認證錯誤',
    'Amount exceeds the merchant monthly limit' => '超過特店月限額',
    'Amount of single transaction exceeds ' => '單筆交易金額超過限額',
    'Repeated request of billing' => '重複請款',
    'Incorrect cardholder IP' => '持卡人 IP 錯誤',
    'Transaction cancellation expired' => '取消交易不可超過期限',
    'Installment payment is not available for this card type' => '特店針對此卡別無分期交易之設定',
    'Bonus point payment expired for this card type' => '特店針對此卡別之紅利交易已過使用期限',
    'Deactivated card type' => '端末機卡別已停用',
    'Bonus point payment is not available' => '特店針對此卡別無紅利交易之設定',
    'Transfer to the card issuing bank for 3D secure verification' => '轉交發卡行進行 3D 認證',
    'Credit card authorization failed' => '信用卡授權失敗',
    'Installment transaction is not available for international credit cards' => '分期交易不接受國外卡',
    'International credit card is not acceptable in this store' => '該商店不允許國外卡交易',
    'Reached the credit card authorization amount ' => '信用卡授權額度已滿',
    'Not full-settlement or full-refund for installment transaction' => '分期交易非全額請款或退款',
    'Incorrect format of CVV' => '末三碼格式錯誤',
    'Direct authorization of card number is not acceptable' => '不接受卡號直授權',
    'Credit card lump-sum payment is not acceptable by this merchant' => '商店不啟用信用卡一次付清',
    'Invoice cancelled' => '發票已註銷',
    'Invoice not exists' => '發票不存在',
    'Unknown error' => '不明錯誤',
    'No information found' => '找不到符合條件的資料',
    'Data correspondence exception' => '資料對應異常',

    // Easycard status
    'Invalid Merchant' => '不合法的店櫃業者',
    'Invalid Card, already blocked' => '卡片沒收，Terminal 進行鎖卡',
    'Invalid Verification Code' => '卡片驗證碼錯誤',
    'Invalid Payment' => '交易不合法',
    'Invalid Payment Amount' => '金額不合法',
    'Invalid Card ID' => '卡號不合法',
    'Unknown Card Issuer' => '無此發卡業者',
    'Repeated Transaction' => '交易重複',
    'Unable to retrieve data' => '無法取得資料',
    'Data format error' => '訊息格式檢查錯誤',
    'Card has been reported as missing' => '此卡為遺失卡',
    'Exceed balance' => '額度不足',
    'Card already expired' => '卡片過期',
    'Transaction is not authorized' => '持卡人交易不被允許',
    'Invalid Device' => '端末設備不合法',
    'Exceed payment limit' => '超過金額上限',
    'Security Checking Failed' => '安全檢查錯誤',
    'No original transaction record' => '無法找到原始交易',
    'Not matching the original transaction record' => '找到原始交易，但是交易內容比對不一致',
    'System error or data error' => '系統發生異常或資料內容有誤',
    'Payment error' => '悠遊卡扣款失敗',
    'Require Retry' => '請作 Retry 交易',
    'The settlement of previous day is not completed' => '前日交易尚未完成結帳',
    'Insufficient balance' => '餘額不足',
    'Retry data does not match the card' => 'Retry 資料與實際卡片不符',
    'Card had been cancelled' => '票卡已退卡',
    'Incorrect card type' => '卡別錯誤',
    'Blacklist card' => '黑名單卡',
    'Card has been locked' => '票卡已鎖卡',
    'Card does not activated' => '未開卡',
    'Card information no need to revise' => '卡片資料不需修改',
    'Blocked card' => 'Terminal 進行鎖卡',
    'Invalid verification code' => '卡片驗證碼錯誤',
    'Repeated transaction' => '交易重複',
    'Incorrect format' => '格式錯誤',
    'Expired card' => '卡片過期',
    'Renewal no need' => '無需展期',
    'Transaction is unauthorized' => '持卡人交易不被允許',
    'Unauthorized transaction for this terminal' => '端末機交易不被允許',
    'Device is not activated' => '設備未啟用',
    'Exceed the amount limits' => '超過金額上限',
    'Exceed the transaction limits' => '超過交易次數上限',
    'Original transaction record not found' => '無法找到原始交易紀錄',
    'Inconsistent transaction contents' => '找到原始交易，但內如不一致',
    'Bank side system error' => '銀行端系統異常',
    'Bank side timeout' => '銀行端 timeout',
    'Unusual card, transaction declined' => '不正常卡片，拒絕交易',
    'Exception on card reading, Please execute Retry transaction' => '讀取卡片異常，請作 Retry 交易',
    'Reader error' => 'Reader 異常',
    'Transaction amount exceeds the limit' => '交易金額超過額度',
    'Accumulated deduction amount exceeds daily limit' => '累計扣款金額超出日上限',
    'Accumulated deduction numbers exceed the limit' => '累計扣款金額超出次限額',
    'Transaction Declined' => '拒絕交易',
    'Reader instruction error' => 'Reader 指令錯誤',
    'Reader in-use' => 'Reader 使用中',
    'Dongle ID not match' => 'Dongle ID 不合',
    'Please refer to error codes of each bank' => '請參各銀行錯誤代碼',
];
