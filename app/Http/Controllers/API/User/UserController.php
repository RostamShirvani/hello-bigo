<?php

namespace App\Http\Controllers\API\User;

use App\Enums\EAppType;
use App\Http\Controllers\API\BaseAPIController;
use App\Http\Requests\API\User\GetUserDetailRequest;
use App\Repositories\API\UserRepository;
use App\ThirdParties\BigoAPI\BigoAPI;
use App\ThirdParties\LikeeAPI\LikeeAPI;
use DOMDocument;
use DOMXPath;
use Illuminate\Support\Facades\Response;

class UserController extends BaseAPIController
{
    protected $userPinRepository;

    public function __construct(UserRepository $userPinRepository)
    {
        $this->userPinRepository = $userPinRepository;
    }

    public function getUserDetail(GetUserDetailRequest $request)
    {
        $accountId = $request->input('bigo_id');
        $appType = $request->input('app_type') ?? EAppType::BIGO_LIVE;
        $clientAPI = null;

        if ($appType == EAppType::BIGO_LIVE) {
            $clientAPI = new BigoAPI($accountId);
        } elseif ($appType == EAppType::LIKEE) {
            $clientAPI = new LikeeAPI($accountId);
        }

        if (!$clientAPI) {
            return Response::json([
                'status' => false,
                'message' => 'no client api'
            ], 422);
        }

        $userDetail = $clientAPI->getUserDetail();

        if (!empty($userDetail)) {
            $userDetail['status'] = true;

            if ($appType == EAppType::BIGO_LIVE && !empty($request->input('send_verification_code'))) {
                $clientAPI->sendVerificationCode();
            }

            return Response::json($userDetail);
        }

        return Response::json([
            'status' => false,
            'message' => 'empty detail'
        ], 422);
    }

    public function getBigoUser($bigoId)
    {
        $bigoId = $bigoId ?? '280871105'; // Default value if not provided

        // URL of the Bigo user profile
        $url = 'https://www.bigo.tv/en/' . $bigoId;

        // Initialize cURL session
        $ch = curl_init();

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        // Execute the cURL request
        $html = curl_exec($ch);

        // Check if the request was successful
        if ($html === false) {
            return response()->json(['error' => 'Failed to load page: ' . curl_error($ch)], 500);
        }

        // Check HTTP response code
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($httpCode !== 200) {
            return response()->json(['error' => 'Failed to load page: HTTP status code ' . $httpCode], $httpCode);
        }

        // Close cURL session
        curl_close($ch);

        // Parse the HTML to extract user details
        $dom = new DOMDocument();

        // Suppress warnings for invalid HTML
        libxml_use_internal_errors(true);

        // Load HTML into DOMDocument
        $dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));

        // Clear libxml errors
        libxml_clear_errors();

        // Extract username from the <title> tag
        $title = $dom->getElementsByTagName('title')->item(0)->textContent;
        preg_match('/Watch (.*?) Live Stream/', $title, $matches);
        $username = $matches[1] ?? 'Not found';

        // Extract profile picture URL from meta tags
        $xpath = new DOMXPath($dom);
        $profilePicNode = $xpath->query('//meta[@property="og:image"]/@content');
        $profilePic = $profilePicNode->length > 0 ? $profilePicNode->item(0)->nodeValue : 'Not found';

        // Validate profile picture URL
        if (strpos($profilePic, 'https://esx.bigo.sg') === false) {
            $profilePic = 'Invalid image URL';
        }

        // Return the result as JSON
        return response()->json([
            'username' => $username,
            'profile_picture' => $profilePic
        ], 200, [], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}
