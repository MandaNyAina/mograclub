<?php
    require_once('config.php');
    class Payment {

        public function __construct() { }

        public function pay ($userDetails, $order) {
            $orderId = date("Y").time();
            $orderDetails = array();
            $orderDetails['appId'] = APP_ID;
            $orderDetails['notifyUrl'] = NOTIFY_URL;
            $orderDetails['returnUrl'] = RETURN_URL;
            $orderDetails['customerName'] = $userDetails['customerName'];
            $orderDetails['customerEmail'] = $userDetails['customerEmail'];
            $orderDetails['customerPhone'] = $userDetails['customerPhone'];
            $orderDetails['orderId'] = $orderId;
            $orderDetails['orderAmount'] = $order['orderAmount'];
            $orderDetails['orderNote'] = $order['orderNote'];
            $orderDetails['orderCurrency'] = $order['orderCurrency'];
            $orderDetails['signature'] = $this->generateSignature($orderDetails);
            ?>
            <div style="margin: auto;text-align: center;">
                <h1>Do not refresh this page ...........</h1>
            </div>
            <form id="redirectForm" method="post" action="<?php echo POST_SUBMIT_LINK; ?>">
                <input type="hidden" name="appId" value="<?php echo APP_ID; ?>"/>
                <input type="hidden" name="orderId" value="<?php echo $orderDetails['orderId']; ?>"/>
                <input type="hidden" name="orderAmount" value="<?php echo $orderDetails['orderAmount']; ?>"/>
                <input type="hidden" name="orderCurrency" value="<?php echo $orderDetails['orderCurrency']; ?>"/>
                <input type="hidden" name="orderNote" value="<?php echo $orderDetails['orderNote']; ?>"/>
                <input type="hidden" name="customerName" value="<?php echo $orderDetails['customerName']; ?>"/>
                <input type="hidden" name="customerEmail" value="<?php echo $orderDetails['customerEmail']; ?>"/>
                <input type="hidden" name="customerPhone" value="<?php echo $orderDetails['customerPhone']; ?>"/>
                <input type="hidden" name="returnUrl" value="<?php echo RETURN_URL; ?>"/>
                <input type="hidden" name="notifyUrl" value="<?php echo NOTIFY_URL; ?>"/>
                <input type="hidden" name="signature" value="<?php echo $orderDetails['signature']; ?>"/>
            </form>
            <script>document.getElementById("redirectForm").submit();</script>
            <?php
        }

        public function verficationBank ($data) {
            $all = [
                "bulkValidationId" => date("Y").time(),
                "entries" => [$data]
            ];
            $token = $this->createToken();
            $ch = curl_init();
            $header = array(
                'Authorization: Bearer '.$token['data']['token'],
                'Content-Type: application/json'
            );
            curl_setopt_array($ch, [
                CURLOPT_URL => ENV_LINK."/payout/v1/validation/bankDetails?name=John&phone=9876543210&bankAccount=026291800001191&ifsc=YESB0000262",
                CURLOPT_HTTPHEADER => $header,
                CURLOPT_RETURNTRANSFER => true
            ]);
            $response = json_decode(curl_exec($ch), true);
            curl_close($ch);
            $res = [
                "token_reponse" => $token,
                "api response" => $response
            ];
            return $res;
        }

        public function api ($endPoint, $data) {
            // $data['clientId'] = CLIENT_ID;
            // $data['secretId'] = CLIENT_SECRET;
            $token = $this->createToken();
            $ch = curl_init();
            $header = array(
                'Authorization: Bearer '.$token['data']['token'],
                'Content-Type: application/json'
            );
            curl_setopt_array($ch, [
                CURLOPT_URL => ENV_LINK."/payout/v1/".$endPoint,
                CURLOPT_HTTPHEADER => $header,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
                CURLOPT_POSTFIELDS => json_encode($data)
            ]);
            $response = json_decode(curl_exec($ch), true);
            curl_close($ch);
            $res = [
                "token_reponse" => $token,
                "api response" => $response
            ];
            return $res;
        }

        private function generateSignature ($postData) {
            $secretKey = SECRET_KEY;
            ksort($postData);
            $signatureData = "";
            foreach ($postData as $key => $value){
                $signatureData .= $key.$value;
            }
            $signature = hash_hmac('sha256', $signatureData, $secretKey,true);
            $signature = base64_encode($signature);
            return $signature;
        }

        private function createToken() {
            $ch = curl_init();
            $header = array(
                'X-Client-Id: '.CLIENT_ID, 
                'X-Client-Secret: '.CLIENT_SECRET,
                'X-Cf-Signature: '.$this->getSignature()
            );
            curl_setopt_array($ch, [
                CURLOPT_URL => ENV_LINK."/payout/v1/authorize",
                CURLOPT_HTTPHEADER => $header,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
                CURLOPT_POSTFIELDS => http_build_query([])
            ]);
            $response = json_decode(curl_exec($ch), true);
            curl_close($ch);
            return $response;
        }

        public static function getSignature() {
            $clientId = CLIENT_ID;
            $publicKey =
        openssl_pkey_get_public(file_get_contents(SITE_ROOT."/accountId_3366_public_key.pem"));
            $encodedData = $clientId.".".strtotime("now");
            return static::encrypt_RSA($encodedData, $publicKey);
          }
        private static function encrypt_RSA($plainData, $publicKey) { if (openssl_public_encrypt($plainData, $encrypted, $publicKey,
        OPENSSL_PKCS1_OAEP_PADDING))
              $encryptedData = base64_encode($encrypted);
            else return NULL;
            return $encryptedData;
          }
    }
?>