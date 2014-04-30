<?php
namespace TwitterExtendedGeoProtocol\Form;

class PostGeoStatus extends \Zend\Form\Form 
{
    public function __construct($name, array $options=array())
    {
        parent::__construct($name, $options);

        $this->add(new Fieldset\User('user'));
        $this->add(new Fieldset\Place('place'));
        $this->add(new Fieldset\Score('score'));

        $this->add(array(
            'name' => 'security',
            'type' => 'Zend\Form\Element\Csrf',
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Send',
                'id' => 'submitbutton',
                'class' => 'btn btn-default', 
            ),
        ));
    }

    public function getInputFilterSpecification()
    {
        return array(
            'security' => array(
                'required' => true,
            ),
        );
    }
}
