<?php
function verifyRecaptcha($token) {
    $secretKey = '6LdS-dsqAAAAAKxw_yOmDo-4ftS8dZNzh8gmeXkY'; // from reCAPTCHA v2 Admin Console
    $url = 'https://www.google.com/recaptcha/api/siteverify';

    $data = [
        'secret' => $secretKey,
        'response' => $token
    ];

    $options = [
        'http' => [
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        ]
    ];

    $context  = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    return json_decode($response, true); // { "success": true/false, "challenge_ts":..., "hostname":... }
}
