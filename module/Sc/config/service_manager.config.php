<?php
namespace Sc;

return array(
    'factories' => array(
        'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
        'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',

        'Sc\Service\DirArrayFilesAsStorage' => function ($sm) {
            $config  = $sm->get('Config');
            $dir     = $config['array_storage_dir'];
            $service = new Service\DirArrayFilesAsStorage($dir);
            return $service;
        },

        'twitter' => function ($sm) {
            $service = new \ZendService\Twitter\Twitter\Twitter();
        },
    ),
);

