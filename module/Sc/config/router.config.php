<?php
namespace Sc;

return array(
    'routes' => array(
        'sc_sc_index_route' => array(
            'type' => 'Zend\Mvc\Router\Http\Segment',
            'options' => array(
                'route'    => '/[:lang/]',
                'constraints' => array(
                    'lang' => $preConfig['regex_patterns']['lang'],
                ),
                'defaults' => array(
                    'lang'          => 'en',
                    'controller'    => 'sc_sc_controller',
                    'action'        => 'index',
                ),
            ),
            'may_terminate' => true,
        ),
        'sc_sc_single_route' => array(
            'type' => 'Zend\Mvc\Router\Http\Segment',
            'options' => array(
                'route'    => '/[:lang/]:slug',
                'constraints' => array(
                    'lang' => $preConfig['regex_patterns']['lang'],
                    'slug' => $preConfig['regex_patterns']['post_slug'],
                ),
                'defaults' => array(
                    'lang'          => 'en',
                    'controller'    => 'sc_sc_controller',
                    'action'        => 'single',
                ),
            ),
            'may_terminate' => true,
        ),

        'sc_sc_statusupdate_route' => array(
            'type' => 'Zend\Mvc\Router\Http\Segment',
            'options' => array(
                'route'    => '/[:lang/]statusupdate',
                'constraints' => array(
                    'lang' => $preConfig['regex_patterns']['lang'],
                ),
                'defaults' => array(
                    'lang'          => 'en',
                    'controller'    => 'sc_sc_controller',
                    'action'        => 'statusupdate',
                ),
            ),
            'may_terminate' => true,
        ),

        'sc_sc_search_route' => array(
            'type' => 'Zend\Mvc\Router\Http\Segment',
            'options' => array(
                'route'    => '[/:lang]/search',
                'constraints' => array(
                    'lang' => $preConfig['regex_patterns']['lang'],
                ),
                'defaults' => array(
                    'lang'       => 'en',
                    'controller' => 'sc_sc_controller',
                    'action'     => 'search',
                ),
            ),
            'may_terminate' => true,
        ),
    ),
);
