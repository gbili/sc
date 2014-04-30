<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace GbiliViewHelper\View\Helper;

/**
 * View helper for translating messages.
 */
class FormElement extends \Zend\I18n\View\Helper\AbstractTranslatorHelper
{
    /**
     * Has this element been already presented to user?
     * Used to decide whther to show error or success colors
     */
    protected $firstRendering = true;

    /**
     * Translate a message
     * @return string
     */
    public function __invoke($element=null)
    {
        if ($element instanceof \Zend\Form\Element) {
            return $this->render($element);
        }
        return $this;
    }

    public function setFirstRendering($boolean)
    {
        $this->firstRendering = $boolean;
        return $this;
    }


    public function render(\Zend\Form\Element $element)
    {
        if ($element instanceof \Zend\Form\Element\Hidden) {
            return $this->view->formHidden($element);
        }
        if ($element instanceof \Zend\Form\Element\Csrf) {
            return $this->view->formHidden($element);
        }

        $this->translatePlaceholderAttribute($element);
        $errors           = $this->renderTranslatedErrors($element);
        $hasErrors        = ('' !== ($errors));
        $statusClass      = (($hasErrors)? ' has-error' : (($this->firstRendering)? '' : ' has-success'));
        $formGroupClass   = $this->getElementOption($element, 'form_group_class', '');

        $controlsDivClass = $this->getElementOption($element, 'controls_div_class', '');
        $elementOptions   = $element->getOptions();

        if ($element instanceof \Zend\Form\Element\Select) {
            $helperMethod = 'renderSelectOptionalTranslation';
        } else if ($element instanceof \DoctrineModule\Form\Element\ObjectRadio) {
            $helperMethod = 'renderCustomizableOptionsRadio';
        } else {
            $helperMethod = $this->getElementOption($element, 'helper_method', 'formElement');
        }

        $helperMethodIsSameAsThisHelper = ('renderElement' === $helperMethod);
        if ($helperMethodIsSameAsThisHelper) {
            throw new \Exception('You cannot set the helper method to "renderElement" which returns this helper causing infinite recursion.');
        }

        return "<div class=\"form-group$statusClass $formGroupClass\">"
                    . $this->renderLabel($element)
                    . "<div class=\"controls $controlsDivClass\">"
                        . $this->view->$helperMethod($element)
                    . '</div>'
                    . $errors
             . '</div>';
    }

    public function getElementOption($element, $optionName, $return = '')
    {
        $options = $element->getOptions();
        if (isset($options[$optionName])) {
            return $options[$optionName];
        }
        return $return;
    }

    public function translatePlaceholderAttribute(\Zend\Form\Element $element)
    {
       return;
       $attributes = $element->getAttributes();
       if (!isset($attributes['placeholder'])) {
           return;
       }

       $placeholder = $attributes['placeholder'];
       $element->setAttribute('placeholder', $this->view->translate($placeholder));
    }

    public function renderTranslatedErrors(\Zend\Form\Element $element)
    {   
        $errors = $element->getMessages();
        if (empty($errors)) {
            return '';
        }
        $translatedErrors = array();
        foreach ($errors as $error) {
            $translatedErrors[] = $this->view->translate(current($errors));
        }

        $labelFor = $element->getAttribute('name');
        $errorsString = implode(', ' , $translatedErrors);

        return "<label class=\"control-label\" for=\"$labelFor\">$errorsString</label>";
    }

    public function renderLabel(\Zend\Form\Element $element)
    {
        if (null === $element->getLabel()) { 
            return '';
        }
        return $this->view->formLabel($element);
    }
}
