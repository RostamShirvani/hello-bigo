<?php

use App\Enums\ECalendarType;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Facades\Lang;

if (!function_exists('slugify')) {
    function slugify($string, $separator = '-', $limit = 150)
    {
        $string = mb_strtolower($string);
        $string = mb_ereg_replace('/\s+/', ' ', $string);
        $string = \Illuminate\Support\Str::words($string, $limit, '');
        $string = mb_ereg_replace('([^آ-ی۰-۹a-z0-9_]|-)+', $separator, $string);

        return trim($string, $separator);
    }
}

if (!function_exists('__trans')) {
    function __trans($originalLangFile, $key, $alternativeLangFile = null, $replace = [], $locale = null)
    {
        if (
            is_string($alternativeLangFile)
            && strlen($alternativeLangFile) == 2
            && empty($replace)
            && empty($locale)
        ) {
            $locale = $alternativeLangFile;
            $replace = [];
            $alternativeLangFile = null;
        }

        if (
            is_string($alternativeLangFile)
            && is_string($replace)
            && strlen($replace) == 2
            && empty($locale)
        ) {
            $locale = $replace;
            $replace = [];
        }

        if (is_array($alternativeLangFile)) {
            if (empty($replace)) {
                $replace = $alternativeLangFile;
                $alternativeLangFile = null;
            }

            if (
                is_string($replace)
                && strlen($replace) == 2
                && empty($locale)
            ) {
                $locale = $replace;
                $replace = $alternativeLangFile;
                $alternativeLangFile = null;
            }
        }

        $originalLangFilePath = "{$originalLangFile}.{$key}";
        if (Lang::has($originalLangFilePath, $locale)) {
            return trans($originalLangFilePath, $replace, $locale);
        }

        $alternativeLangFilePath = "{$alternativeLangFile}.{$key}";
        if (!empty($alternativeLangFile) && Lang::has($alternativeLangFilePath, $locale)) {
            return trans($alternativeLangFilePath, $replace, $locale);
        }

        return trans($originalLangFilePath, $replace, $locale);
    }
}

if (!function_exists('getSimilarKeywordTrans')) {
    function getSimilarKeywordTrans($originalLangFile, $keyword, $mainKey = null, $alternativeLangFile = null)
    {
        $langFileArray = Lang::get($originalLangFile);

        if ((!isset($langFileArray[$mainKey]) || empty($langFileArray)) && !empty($alternativeLangFile)) {
            $langFileArray = Lang::get($alternativeLangFile);
        }

        if (isset($langFileArray[$mainKey]) && !empty($langFileArray) && is_array($langFileArray)) {
            $targetArray = (empty($mainKey) ? $langFileArray : $langFileArray[$mainKey]);
            $results = preg_grep("/$keyword/i", $targetArray);
            if (!empty($results) && is_array($results)) {
                return array_keys($results);
            }
        }

        return [];
    }
}

if (!function_exists('transToKey')) {
    function transToKey($originalLangFile, $keyword, $mainKey = null, $alternativeLangFile = null)
    {
        $langFileArray = Lang::get($originalLangFile);

        if (empty($langFileArray) && !empty($alternativeLangFile)) {
            $langFileArray = Lang::get($alternativeLangFile);
        }

        if (!empty($langFileArray) && is_array($langFileArray)) {
            $targetArray = (empty($mainKey) ? $langFileArray : $langFileArray[$mainKey]);
            $targetArray = array_map('mb_strtolower', $targetArray);
            $targetArray = preg_replace('/\s+/', '', $targetArray);
            $keyword = mb_strtolower($keyword);
            $keyword = preg_replace('/\s+/', '', $keyword);
            $result = array_search($keyword, $targetArray);
            if (!empty($result)) {
                return $result;
            }
        }

        return null;
    }
}

if (!function_exists('dateTimeFormat')) {
    function dateTimeFormat($datetime, $format = 'Y/m/d H:i:s', $calenderType = null)
    {
        if (empty($datetime)) {
            return null;
        }

        if (empty($calenderType)) {
            $locale = mb_strtolower(Lang::locale());
            $calenderType = ECalendarType::GREGORIAN;
            if ($locale === 'fa') {
                $calenderType = ECalendarType::JALALI;
            }
        }

        switch ($calenderType) {
            case ECalendarType::GREGORIAN:
                $datetime = Carbon::createFromFormat('Y-m-d H:i:s', $datetime)->format($format);
                break;
            case ECalendarType::JALALI:
                $datetime = Verta::instance($datetime)->format($format);
                break;
            default:
                $datetime = Carbon::createFromFormat('Y-m-d H:i:s', $datetime)->format($format);
        }

        return $datetime;
    }
}

if (!function_exists('sendRequest')) {
    function sendRequest($url, $method = 'GET', $data = [], $disableDecode = false)
    {
        $fields = '';

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
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
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

if (!function_exists('getParamFromUrl')) {
    function getParamFromUrl($url, $paramName)
    {
        parse_str(parse_url($url, PHP_URL_QUERY), $op); // Fetch query parameters from a string and convert to an associative array
        return array_key_exists($paramName, $op) ? $op[$paramName] : "Not Found"; // Check if the key exists in this array
    }
}
