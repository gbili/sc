<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace TwitterExtendedGeoProtocol\Controller\Plugin;

/**
 *
 */
class RequestHandler extends \Zend\Mvc\Controller\Plugin\AbstractPlugin
{
    /**
     * Upload action
     * @return mixed
     */
    public function __invoke()
    {
        $controller   = $this->getController();

        if (!$controller->getRequest()->isPost()) {
            die(__CLASS__ . ', says: Request must be Post');
        }

        $form = new \TwitterExtendedGeoProtocol\Form\PostGeoStatus('post_geo_status');

        $httpPostData = $controller->getRequest()->getPost();
        $form->setData($httpPostData);

        if (!$form->isValid()) {
            return new \Zend\View\Model\JsonModel(array(
                'status' => 0,
                'messages' => $form->getMessages(),
            ));
        }

        /*
        $converter = $controller->getServiceLocator()->get('TwitterExtendedGeoProtocol\Service\Converter');
        $converter->toText($validData);
        $controller->twitter()->statusesUpdate();
        */

        return new \Zend\View\Model\JsonModel(array(
            'status' => 1,
            'formData' => $form->getData(),
        ));
    }
}
