<?php
namespace Sc\View\Helper;

class CustomMarker extends \Zend\View\Helper\AbstractHelper
{
    protected $cache = array();

    public function __invoke($name, $markerIdentifier, array $config, $coma='')
    {
        return $this->getProperty($name, $markerIdentifier, $config, $coma);
    }

    public function getProperty($name, $markerIdentifier, array $config, $coma='')
    {
        if (isset($this->cache[$name . $markerIdentifier])) {
            return $this->cache[$name . $markerIdentifier];
        }

        $pluralName = $name . 's';
        $specificConfig = $this->getConfig($config, $pluralName, $markerIdentifier);
        if (empty($specificConfig)) {
            return '';
        }

        $method = 'getMarker' . ucfirst($name) . 'ObjectProperties';
        $properties = $this->$method($markerIdentifier, $specificConfig);

        $returnProperty = $this->convertPropertiesToObjectAndReturnAsAssignedToPropertyName($name, $properties);
        $this->chache[$name . $markerIdentifier] = $returnProperty;
        return $returnProperty . $coma;
    }

    public function getMarkerIconObjectProperties($markerIdentifier, array $iconConfig)
    {
        $properties = array();
        $properties[] = "url: '{$iconConfig['url']}'";
        $properties[] = "size: new google.maps.Size({$iconConfig['size'][0]}, {$iconConfig['size'][1]})";
        $properties[] = "origin: new google.maps.Point({$iconConfig['origin'][0]}, {$iconConfig['origin'][1]})";
        $properties[] = "anchor: new google.maps.Point({$iconConfig['anchor'][0]}, {$iconConfig['anchor'][1]})";
        return $properties;

    }

    public function getMarkerShapeObjectProperties($markerIdentifier, array $shapeConfig)
    {
        $properties = array();
        $coords = json_encode($shapeConfig['coord']);
        $properties[] = "coord: $coords";
        $properties[] = "type: '{$shapeConfig['type']}'";
        return $properties;
    }

    /**
     * Creates Js Object Code from the param properties,
     * and return it as if it were a property of some outer object 
     * ex: 
     * input -> 
     *    $what = 'someObject'
     *    $properties = array("prop1:'one'", 'prop_two:2');
     * output -> 
     *    'someObject: {prop1:'one', prop_two:2}'
     *
     * @return array
     */
    protected function convertPropertiesToObjectAndReturnAsAssignedToPropertyName($name, array $properties)
    {
        return $name . ':' . '{' . implode(",\n", $properties) . '}';
    }

    public function getConfig($config, $what, $markerIdentifier)
    {
        if (!isset($config[$what][$markerIdentifier])) {
            return array();
        }
        return $config[$what][$markerIdentifier];
    }
}
