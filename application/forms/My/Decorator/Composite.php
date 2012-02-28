<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Composite
 *
 * @author tulio
 */
class My_Decorator_Composite extends Zend_Form_Decorator_Abstract
{
    public function buildLabel()
    {
        $element = $this->getElement();
        $label = $element->getLabel();
        
        if ($translator = $element->getTranslator()) {
            $label = $translator->translate($label);
        }

        if (!method_exists($element, 'getLabel')) {
            return $content;
        }
 
	$label .= ':';
                
        return "<th>" . 
                $element->getView()->formLabel($element->getName(), $label) . 
                "</th>";
        
//        return $element->getView()->formLabel($element->getName(), $label ) ;

    }
 
    public function buildInput()
    {
        $element = $this->getElement();
        $helper  = $element->helper;
        $title   = $element->getAttrib('title');

//        return "<div id='divcampo-blah' class='validate tip-stay right validate_error'>" . $element->getView()->$helper(
        return "<td>" . 
            $element->getView()->$helper(
            $element->getName(),
            $element->getValue(),
            $element->getAttribs(),
            $element->options
        ) . "</td>" ;
    }
 
    public function buildErrors()
    {
        $element  = $this->getElement();
        $messages = $element->getMessages();
        if (empty($messages)) {
            return '';
        }
        
        $errors = $element->getMessages();
        if (empty($errors)) {
        return '';
        }
        
        $html = '<td><div class="error-left"></div><div class="error-inner">';
        $label = $element->getLabel();
        foreach($errors as $err)
        {
//            $html .= "<p class='errorText'>[$label]: $err</p>";
            $html .= "<p>$err</p>";
        }
        $html .= "</div></td>";

        $content = '';

        $placement = $this->getPlacement();
        switch ($placement) {
        case (self::APPEND):
            return $content . $html;
        case (self::PREPEND):
            return $html . $content;
        }

//        return '<div class="error">' .
//               $element->getView()->formErrors($messages) . '</div>';
    }
 
    public function render($content)
    {
        $element = $this->getElement();
        if (!$element instanceof Zend_Form_Element) {
            return $content;
        }
        if (null === $element->getView()) {
            return $content;
        }
 
        $placement = $this->getPlacement();
        $label     = $this->buildLabel();
        $input     = $this->buildInput();
        $errors    = $this->buildErrors();
 
        $output = '<tr>'
                . $label
                . $input
                . $errors
                . '</tr>';
 
        switch ($placement) {
            case (self::PREPEND):
                return $output . $content;
            case (self::APPEND):
            default:
                return $content . $output;
        }
    }
}

?>
