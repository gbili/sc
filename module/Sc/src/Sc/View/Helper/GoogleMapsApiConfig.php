<?php
namespace Sc\View\Helper;

class GoogleMapsApiConfig extends \Zend\View\Helper\AbstractHelper
{
    const GET_SET_STRLEN = 3; //strlen('get')

    protected $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function __invoke($fullConfig=false)
    {
        if ($fullConfig) {
            return $this->config;
        }
        return $this;
    }

    /**
     * Getter and Setter
     * Ex: setPlaces('config') -> __call('setPlaces', $config)
     * @param $method string set<Something>
     * @param $params array config 
     * @return Sc\View\Helper\GoogleMapsApiConfig
     */
    public function __call($method, $params)
    {
        if (self::GET_SET_STRLEN + 1 > strlen($method)) {
            throw new \Exception('Method not supported: ' . $method);
        }

        $filter = new \Zend\Filter\Word\CamelCaseToUnderscore();

        $what = strtolower($filter(substr($method, self::GET_SET_STRLEN)));
        $getOrSet = substr($method, 0, self::GET_SET_STRLEN);

        if ('get' === $getOrSet) {
            if (!isset($this->config[$what])) {
                throw new \Exception('Trying to get non existent config key');
            }
            return $this->config[$what];
        }

        if ('set' === $getOrSet) {
            if (empty($params)) {
                throw new \Exception($method . '($value) expects a value as first param. ');
            }
            $this->config[$what] = current($params);
            return $this;
        }

        throw new \Exception('Called method not supported or wrong params. Expecting getter or setter, given : ' . $method);
    }

    public function getPlacesByType()
    {
        $byType = array();
        foreach ($this->getPlaces() as $place) {
            if (!isset($place['type'])) $place['type'] = 'uncategorized';
            $type = $place['type'];
            if (!isset($byType[$type])) $byType[$type] = array();
            $byType[$type][] = $place;
        }
        return $byType;
    }
}
