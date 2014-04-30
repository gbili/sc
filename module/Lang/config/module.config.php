<?php
namespace Lang;

return array(
    'lang' => array(
        'date_time_formats' =>array(
            'es' => 'dd/mm/yy',
            'fr' => 'dd-mm-yy',
            'en' => 'yy-mm-dd',
        ), 
        'langs_available' =>array(
            'es',
            'fr',
            'en',
            'de',
            'it',
        ), 
    ),

    'translator' => array(
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
                'text_domain' => strtolower(__NAMESPACE__),
            ),
        ),
    ),

    'controllers'        => include __DIR__ . '/controllers.config.php',
    'controller_plugins' => include __DIR__ . '/controller_plugins.config.php',
    'lang_selector'      => include __DIR__ . '/lang_selector.config.php',
    'navigation'         => include __DIR__ . '/navigation.config.php',
    'service_manager'    => include __DIR__ . '/service_manager.config.php',
    'translator'      => include __DIR__ . '/translator.config.php',
    'router'             => include __DIR__ . '/router.config.php',
    'view_helpers'       => include __DIR__ . '/view_helpers.config.php',
);
