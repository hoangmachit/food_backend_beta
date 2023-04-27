<?php
if (!function_exists('replaceSpecialChar')) {
    function replaceSpecialChar($String = '')
    {
        return ucfirst(str_replace('_', ' ', $String));
    }
}
if (!function_exists('formatPrice')) {
    function formatPrice($price = '', $ext = "đ")
    {
        return number_format($price, 0, ",", ".") . $ext;
    }
}
if (!function_exists('sendResponse')) {
    function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'result'    => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }
}
if (!function_exists('sendError')) {
    function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];
        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }
}
