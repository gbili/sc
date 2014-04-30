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
class PopupWrapper extends \Zend\View\Helper\AbstractHelper
{
    protected $isScriptRegistered   = false;
    protected $hidePopupButtonClass = 'hide-popup';
    protected $popupContentClass    = 'popup-content';

    /**
     * Translate a message
     * @return string
     */
    public function __invoke($popupContentHtml, $initialStateHidden=true, $classes=array())
    {
        $classes[] = $this->popupContentClass;
        $classes   = array_unique($classes);

        $html = '<div class="' . (($initialStateHidden)? ' hidden' : '') . '">'
                  . '<div class="popup-row' . (($initialStateHidden)? ' hidden' : '') . '">'
                      .'<div class="popup-cell">'
                          .'<div class="' . implode(' ', $classes) . '">'
                             . '<a class="' . $this->hidePopupButtonClass . '">✖</a>'
                             . $popupContentHtml
                         . '</div>'
                     . '</div>'
                 . '</div>'
              .'</div>';

        if (!$this->isScriptRegistered) {
            require_once realpath( __DIR__  . '/../../../../' ) . '/view/partial/formpopup_base.js.phtml';
        }

        return $html;
    }
}
