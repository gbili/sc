<?php
namespace TwitterExtendedGeoProtocol\Form\Fieldset;

class Score extends \Zend\Form\Fieldset 
    implements \Zend\InputFilter\InputFilterProviderInterface
{
    public function __construct($name, $options=array())
    {
        parent::__construct($name, $options);

        $this->add(array(
            'name' => 'tag',
            'type'  => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Tag'
            ),
            'attributes' => array(
                'class' => 'form-control'
            )
        ));

        $this->add(array(
            'name' => 'value',
            'type'  => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Value'
            ),
            'attributes' => array(
                'class' => 'form-control'
            )
        ));
    }

    public function getInputFilterSpecification()
    {
        return array(
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
            'value' => array(
                'required' => true,
                'validators' => array(
                    array('name' => 'Callback',
                        'options' => array(
                            'callback' => function ($value) {
                                return is_numeric($value) && $value >= 0 && $value <= 100;
                            },
                            'message' => 'Must be a number between 0 and 100',
                        ),
                    ),
                ),
            ),
        );
    }
}
