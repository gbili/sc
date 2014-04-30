<?php
namespace TwitterModule;

return array(
    'factories' => array(
        'twitter' => function ($sm) {
            $config = $sm->get('Config');
            if (!isset($config['twitter_module'])) {
                throw new \Zend\Mvc\ServiceManager\Exception('No twitter config file was found. Create a config/twitter_module.config.php, and include it in your config/module.config.php with the key "twitter_module"');
            }
            $service = new \ZendService\Twitter\Twitter($config['twitter_module']);
            return $service;
        },
    ),
);
