<?php
namespace TwitterGeoProtocol;

return array(
    'view_manager' => array(
        'doctype'                  => 'HTML5',
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
    ),

    'controller_plugins'        => include __DIR__ . '/controller_plugins.config.php',
    'service_manager'           => include __DIR__ . '/service_manager.config.php',
    'view_helpers'              => include __DIR__ . '/view_helpers.config.php',
    'tweet_geo_protocol_status' => include __DIR__ . '/tweet_geo_protocol_status.config.php',
);
