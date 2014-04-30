<?php
namespace TwitterExtendedGeoProtocol\Form\Fieldset;

class User extends \Zend\Form\Fieldset 
    implements \Zend\InputFilter\InputFilterProviderInterface
{
    public function __construct($name, $options=array())
    {
        parent::__construct($name, $options);

        $this->add(array(
            'name' => 'user',
            'type'  => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Screen Name'
            ),
            'attributes' => array(
                'class' => 'form-control'
            )
        ));
    }

    public function getInputFilterSpecification()
    {
        return array(
            'user' => array(
                'required' => true,
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 3,
                            'max'      => 21,
                        ),
                    ),
                ),
            ),
        );
    }
}
