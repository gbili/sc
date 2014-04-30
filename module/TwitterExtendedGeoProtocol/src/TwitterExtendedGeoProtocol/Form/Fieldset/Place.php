<?php
namespace TwitterExtendedGeoProtocol\Form\Fieldset;

class Place extends \Zend\Form\Fieldset 
    implements \Zend\InputFilter\InputFilterProviderInterface
{
    public function __construct($name, $options=array())
    {
        parent::__construct($name, $options);

        $this->add(array(
            'name' => 'tag', 
            'type'  => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => ucfirst($name),
            ),
            'attributes' => array(
                'class' => 'form-control'
            )
        ));

        $this->add(array(
            'name' => 'lat',
            'type'  => 'Zend\Form\Element\Hidden',
        ));

        $this->add(array(
            'name' => 'long',
            'type'  => 'Zend\Form\Element\Hidden',
        ));

        $this->add(array(
            'name' => 'zoom',
            'type'  => 'Zend\Form\Element\Hidden',
        ));
    }

    public function getInputFilterSpecification()
    {
        return array(
            'lat' => array(
                'required' => true,
            ),
            'long' => array(
                'required' => true,
            ),
            'zoom' => array(
                'required' => true,
                'validators' => array(
                    array('name' => 'Callback',
                        'options' => array(
                            'callback' => function ($value) {
                                return is_numeric($value) && $value >= 1 && $value <= 20;
                            },
                            'message' => 'Must be a number between 1 and 20',
                        ),
                    ),
                ),
            ),
            'tag' => array(
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
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
