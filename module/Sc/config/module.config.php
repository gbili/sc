<?php
namespace Sc;

return array(
    'view_manager' => array(
        'doctype'                  => 'HTML5',
        'display_not_found_reason' => true,
        'display_exceptions'       => true,

        'strategies' => array(
            'ViewJsonStrategy',
        ),

        'template_path_stack'      => array(
            strtolower(__NAMESPACE__) => __DIR__ . '/../view',
        ),

        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'sc/sc/index'   => __DIR__ . '/../view/sc/sc/index.phtml',
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'error/index'   => __DIR__ . '/../view/error/index.phtml',
            'error/404'     => __DIR__ . '/../view/error/404.phtml',
        ),
    ),

    'controllers'     => include __DIR__ . '/controllers.config.php',
    'router'          => include __DIR__ . '/router.config.php',
    'translator'      => include __DIR__ . '/translator.config.php',
    'service_manager' => include __DIR__ . '/service_manager.config.php',
    'view_helpers'    => include __DIR__ . '/view_helpers.config.php',
    'navigation'      => include __DIR__ . '/navigation.config.php',
    'googlemapsapi'   => include __DIR__ . '/googlemapsapi.config.php',
    'twitter_module'  => include __DIR__ . '/twitter_module.config.php',

    'array_storage_dir' => __DIR__ . '/../data',
);
