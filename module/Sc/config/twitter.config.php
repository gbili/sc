<?php
return array(
    'access_token' => array(
        'token'  => 'twitter-access-token-here',
        'secret' => 'twitter-access-secret-here',
    ),
    'oauth_options' => array(
        'consumerKey' => 'twitter-consumer-key-here',
        'consumerSecret' => 'twitter-consumer-secret-here',
    ),
    'http_client_options' => array(
        'adapter' => 'Zend\Http\Client\Adapter\Curl',
        'curloptions' => array(
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
        ),
    ),
);
