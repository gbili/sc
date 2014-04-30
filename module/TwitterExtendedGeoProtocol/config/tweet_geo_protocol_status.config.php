<?php
namespace TwitterExtendedGeoProtocol;

return array(
    'patterns' => array(
        'user' =>  array(
            'user'      => '[A-Za-z0-9_]{1,15}',
        ),
        'geo' => array(
            'zoom'      => '(?:[1-9][0-9]?)|20|21', // 1 - 21
        ),
        'score' => array(
            'score_tag' => '(?:[a-z ]{0,19}[a-z])',
            'score_value'     => '0|(?:[1-9][0-9]?)|100',
        ),
    ),
);
