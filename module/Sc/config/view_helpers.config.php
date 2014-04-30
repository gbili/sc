<?php
namespace Sc;
return array(
    'invokables' => array(
        'customMarker' => __NAMESPACE__ . '\View\Helper\CustomMarker',
    ),
    'factories' => array(
        'googleMapsApiConfig' => function ($vhp) {
            $sm            = $vhp->getServiceLocator();
            $config        = $sm->get('Config');
            $fileStorageService = $sm->get('Sc\Service\DirArrayFilesAsStorage');
            $places        = $fileStorageService->getPlaces();
            $icons        = $fileStorageService->getIcons();

            $helper        = new View\Helper\GoogleMapsApiConfig($config['googlemapsapi']);
            $helper->setPlaces($places);
            $helper->setIcons($icons);
            return $helper;
        },
    ),
);
