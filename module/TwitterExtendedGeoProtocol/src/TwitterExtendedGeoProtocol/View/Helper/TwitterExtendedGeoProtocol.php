<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace TwitterExtendedGeoProtocol\View\Helper;

/**
 * View helper for translating messages.
 */
class TwitterExtendedGeoProtocol extends \Zend\View\Helper\AbstractHelper
{
    protected $service;

    public function __invoke()
    {
        return $this->service;
    }

    public function setService(\TwitterExtendedGeoProtocol\Service\Converter $service)
    {
        $this->service = $service;
    }
}
