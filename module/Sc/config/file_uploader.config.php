<?php
namespace Sc;

return array(
    'sc_dog_controller' => array(
        'alias' => 'ajax_media_upload',
        'service' => array(
            'form_action_route_params' => array(
                'route' => 'sc_dog_upload_route',
                'params' => array(
                    'controller' => 'sc_dog_controller',
                    'action' => 'upload',
                ),
                'reuse_matched_params' => true,
            ),
        ),

        'controller_plugin' => array(
            'route_success' => array(
                'route'                => 'sc_dog_add_route',
                'params'               => array(),
                'reuse_matched_params' => true,
            ),
        ),
    ),
);
