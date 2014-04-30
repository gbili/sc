<?php
namespace Sc\Controller;

/**
 * sc : Symptom cause solution
 */
class ScController extends \Zend\Mvc\Controller\AbstractActionController
{
    public function indexAction()
    {
        $form = new \TwitterExtendedGeoProtocol\Form\PostGeoStatus('post_geo_status');
        return new \Zend\View\Model\ViewModel(array(
            'form' => $form,
        ));
    }

    public function twitterAction()
    {
        /*$twitter = $this->twitter();

        $response = $twitter->account->verifyCredentials();
        if (!$response->isSuccess()) {
            throw new \Exception('Twitter Credentials are not valid');
        }
        $response = $twitter->statuses->userTimeline();
        $statuses = $response->toValue();
        $geoProtocolStatuses = $this->extractProtocolizedStatuses($statuses);*/
        die($this->getServiceLocator()->get('tegpConverter')->tests());
        return new \Zend\View\Model\ViewModel(array(
            'statuses' => $geoProtocolStatuses
        ));
    }

    public function statusupdateAction()
    {
        return $this->tegpRequestHandler();
    }
}
