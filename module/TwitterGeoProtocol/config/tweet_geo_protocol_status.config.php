<?php
namespace TwitterGeoProtocol;

return array(
    'patterns' => array(
        'user' =>  array(
            'user'      => '[A-Za-z0-9_]{1,15}',
        ),
        'geo' => array(
            'geo_tag'   => '[A-Za-z0-9 ]{0,28}',
            'lat'       => '\\d{1,2}\\.\\d{6}',
            'long'      => '-?\\d{1,2}\\.\\d{6}',
            'zoom'      => '[1-9][0-9]?',
        ),
        'score' => array(
            'score_tag' => '(?:[a-z ]{0,19}[a-z])',
            'score_value'     => '0|(?:[1-9][0-9]?)|100',
        ),
    ),
);
