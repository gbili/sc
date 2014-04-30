<?php
return array(
    'map' => array(
        'lat' => '28.432433',
        'lng' => '-13.985597',
        'zoom' => '10',
    ),
    'query_params' => array(
        'v' => '3',
        'sensor' => 'true', // Allow sensor (ex: geolocation)
        //'language' => null, // Use defaults
        'callback' => 'initializeGoogleMap', //Call this asyncronously
    ),
    'shapes' => array(
        'icon_majanicho_fever' => array(
            // Clickable area of the icon
            'coord' => array(1, 1, 1, 20, 18, 20, 18 , 1),
            'type' => 'poly',
        ),
    ),
    'geolocation' => array(
        'boundaries' => array(
            'min' => array('lat' => '28.000000', 'lng' => '-14.530000'),
            'max' => array('lat' => '28.799259', 'lng' => '-13.759784'),
        ),
    ),
);
