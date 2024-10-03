<?php

namespace App\ThirdParties\BigoAPI;

use App\Enums\EAppType;
use App\Enums\ELoginTokenStatus;
use App\Enums\EState;
use App\Models\GiftCharge;
use App\Models\LoginToken\LoginToken;
use App\Models\RazerAccount;
use App\Models\RequestUrl\RequestUrl;
use App\Models\Setting;
use App\Models\SilverLink\SilverLink;
use Illuminate\Support\Facades\Http;

class BigoAPI
{
    public const BASE_URL = 'https://m.bigopay.tv';
    public $cookie;

    public $bigoId;
    protected $fromBigoId;
    protected $loginToken;

    public function __construct($bigoId)
    {
//        $this->cookie = 'uniqid=qXRITBmLt7NVoZyXhsDL6uj7U4ghYv9TTgs1Xdc6qQUCRajdQ7qJ9k3g7UaUPvuniT2fYW8oh1ZiG5h9HuVix8fahzsVTj9DE67BEa8i36XyNony1Y9EgGxM1Sh8Hkpj8CKCr0Ae8brd48UuWPuiQxnWhfiCaYuCUUK2qLcISjR6z9E8M7kc48JGw8K9IiDJAWPXaJHExhGSPItkowRcTOVTmFB1f9ROQezqajRDuQlHdP1n8hgFFp8Mv3nPvrwR1nEYdqZGGb53pF1mQbuB';
        $this->cookie = Setting::get()->token;
        $this->bigoId = $bigoId;
        $loginToken = LoginToken::query()
            //            ->where('bigo_id', $bigoId)
            ->where([
                ['state', EState::ENABLED],
                ['status', ELoginTokenStatus::ACTIVE],
            ])
            ->first();

        if ($loginToken && !empty($loginToken->token)) {
            $this->loginToken = $loginToken->token;
            $this->fromBigoId = $loginToken->bigo_id;
        }
    }

    public function getUserDetail()
    {


        $response = $this->getUserDetailFromWeb();

        if (!empty($response)) {
            $profileImage = null;
            if (!empty($response['avatar'])) {
                $profileImage = route('images.load', ['data' => $response['avatar']]);
            }

            return [
                'avatar' => $profileImage ?? '',
                'nick_name' => $response['nick_name'] ?? null,
                'id' => $this->bigoId,
                'level' => 2,
            ];
        }

        $url = self::BASE_URL . '/pay-bigolive-tv/quicklyPay/sendSmsCode';

        $response = $this->sendRequest($url, 'GET', [
            'bigoId' => $this->bigoId,
            'isFromApp' => 0,
        ]);

        if (isset($response['result']) && $response['result'] == 0) {
            return [
                'avatar' => $response['data']['avatar'] ?? null,
                'nick_name' => $response['data']['nick_name']['name'] ?? null,
                'id' => $response['data']['yyuid'] ?? null,
                'level' => $response['data']['level'] ?? null,
            ];
        }

        return null;
    }

    public function getUser()
    {
        $url = self::BASE_URL . '/live/quickPay/payIndex/getUser';

        $response = $this->sendRequest($url, 'GET', [
            'loginToken' => $this->loginToken,
            'isFromApp' => 0,
        ]);

        if (isset($response['result']) && $response['result'] == 0) {
            return [
                'avatar' => $response['data']['avatar'] ?? null,
                'nick_name' => $response['data']['nick_name']['name'] ?? null,
                'id' => $response['data']['yyuid'] ?? null,
                'level' => $response['data']['level'] ?? null,
            ];
        }

        return null;
    }

    public function sendVerificationCode()
    {
        $url = self::BASE_URL . '/live/quickPay/login/sendSmsCode';

        $response = $this->sendRequest($url, 'POST', [
            'bigoId' => $this->bigoId,
            'imType' => 'LOGIN',
            'isFromApp' => 0,
        ]);

        if (isset($response['result']) && $response['result'] == 0) {
            return true;
        }

        return false;
    }

    public function login($verificationCode)
    {
        $url = self::BASE_URL . '/live/quickPay/login/doLogin';

        $this->getUser();

        $response = $this->sendRequest($url, 'POST', [
            'bigoId' => $this->bigoId,
            'smsCode' => $verificationCode,
            'isFromApp' => 0,
        ]);

        if (!empty($response['data']['loginToken'])) {
            return $response['data']['loginToken'];
        }

        return null;
    }


    public function getPaymentUrl($withStatus = false)
    {
        $url = self::BASE_URL . '/live/quickPay/payment/pay';
        $response = $this->sendRequest($url, 'POST', [
            'bigoId' => $this->fromBigoId,
            'toBigoId' => $this->bigoId,
            'id' => 115,
            'loc' => '',
            'deviceId' => '',
            'scene' => 107,
            'login_type' => 1,
            'isFromApp' => 0,
        ]);

        if (!empty($response['pay_url'])) {
            return $response['pay_url'];
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

        if (!empty($silver)) {
//            $silverLink = new SilverLink();
//            $silverLink->app_type = EAppType::BIGO_LIVE;
//            $silverLink->silver = $silver;
//            $silverLink->created_at = now();
//            $silverLink->used_at = null;
//            $silverLink->save();


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

//            $botToken = "6420852445:AAF-LF7kN9GG9D2ruKQD-0ArY-Bvtjrt1jU";
//            $chatId = "-1002154374380";
//            $url = 'https://api.telegram.org/bot' . $botToken . '/sendMessage';
//            Http::post($url, ['chat_id' => $chatId, 'text' => "$redirect_value"]);


        }

        if (strpos($response, 'order_id') !== false) {

            $explode = explode('</h5>', last(explode('order_id:', $response)));

            if (isset($t_value) && $t_value) {
                $selected_account = RazerAccount::getCurrentSelectedRazerAccount();

                if (!$selected_account) {
                    alert()->error('عملیات ناموفق', 'اکانت فعالی یافت نشد!');
                    return redirect()->back();
                }
                $urlt = 'https://global.gold.razer.com/paymentwall/Redemption/ClaimSilver';
                $response = $this->sendRequest($urlt, 'POST', [

//                    'RazerId' => 'RZR_0770b6ca4085854a84c4b8adde61',
//                    'EmailAddress' => 'rostamshirvani07@gmail.com',

                    'RazerId' => $selected_account->razer_id,
                    'EmailAddress' => $selected_account->email_address,
                    'OrderId' => $t_value,
                ]);

                if ($selected_account) {
                    $selected_account->charge_balance += (int)$response;
                    if (($selected_account->charge_balance + (int)$response) >= $selected_account->charge_ceiling) {
                        $selected_account->charge_ceil_flag += 1;
                    }
                    $selected_account->save();
                }
            }

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

    public static function getSystemHealth($bigoId)
    {
        $loginToken = LoginToken::query()
            ->where('bigo_id', $bigoId)
            ->first();

        if ($loginToken && !empty($loginToken->token)) {
            $bigoAPI = new BigoAPI($bigoId);
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

    protected function sendRequest($url, $method = 'GET', $data = [], $disableDecode = false)
    {
        $fields = '';
        $baseUrl = $url;

        $requestUrl = RequestUrl::query()
            //            ->where('count_of_used', '>', 0)
            //            ->where('count_of_used', '<=', 50)
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

        if ($requestUrl) {
            $requestUrl->count_of_used++;
            $requestUrl->used_at = now();
            $requestUrl->save();

            if ($requestUrl->url !== 'localhost') {
                $response = $this->sendRequest($requestUrl->url . '/send_request.php', 'GET', [
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
        # sending manually set cookie
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Cookie: " . $this->cookie]);
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

//    protected function getUserDetailFromWeb()
//    {
//        $response = $this->sendRequest(
//            'https://www.bigo.tv/en/' . $this->bigoId,
//            'GET',
//            [],
//            true
//        );
//        $explode = explode('type="application/ld+json">', $response);
//
//        if (!empty($explode[1])) {
//            $explode = explode('</script>', $explode[1]);
//
//            if (!empty($explode[0])) {
//                $json = $explode[0];
//                $data = json_decode($json, true);
//
//                return [
//                    'nick_name' => !empty($data['author']) ? $data['author'] : null,
//                    'avatar' => !empty($data['thumbnailUrl'][0]) ? $data['thumbnailUrl'][0] : null,
//                ];
//            }
//        }
//
//        return null;
//    }
    protected function getUserDetailFromWeb()
    {
        $url = url('/bigo-user/' . $this->bigoId);  // Use the internal route

        $response = $this->sendRequest($url, 'GET', [
//            'bigoId' => $this->bigoId,
        ]);

        if ($response) {
            return [
                'avatar' => $response['profile_picture'] ?? null,
                'nick_name' => $response['username'] ?? null,
            ];
        }

        return null;
    }
}
