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
 
        if ($element->isRequired()) {
            $label .= '*';
        }

        $class = $this->getElement()->getAttrib('labelClass');
        $this->setOption('class', $class);

        
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
        $_htmlElementSeparator = '</p><p>';
        $element  = $this->getElement();
        $messages = $element->getMessages();
        $this->setOption('separator','</p><p>');
        if (empty($messages)) {
            return '';
        }
        
        $errors = $element->getMessages();
        if (empty($errors)) {
        return '';
        }

        $html = '<div class="notice error">';
        $label = $element->getLabel();
        foreach($errors as $err)
        {
//            $html .= "<p class='errorText'>[$label]: $err</p>";
            $html .= "<p>$err</p>";
        }
        $html .= "</div>";

        $content = '';
        $separator = $this->getSeparator();
        $placement = $this->getPlacement();
        switch ($placement) {
        case (self::APPEND):
            return $content . $separator . $html;
        case (self::PREPEND):
            return $html . $separator . $content;
        }

//        return '<div class="error">' .
//               $element->getView()->formErrors($messages) . '</div>';
    }
 
    public function buildDescription()
    {
        $element = $this->getElement();
        $desc    = $element->getDescription();
        if (empty($desc)) {
            return '';
        }
        return '<table>' . $desc . '</table>';
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
 
        $separator = $this->getSeparator();
        $placement = $this->getPlacement();
        $label     = $this->buildLabel();
        $input     = $this->buildInput();
        $errors    = $this->buildErrors();
        $desc      = $this->buildDescription();
 
        $class = $this->getElement()->getAttrib('divClass');
        $output = '<tr>'
                . $label
                . $input
                . $errors
                . $desc
                . '</tr>';
 
        switch ($placement) {
            case (self::PREPEND):
                return $output . $separator . $content;
            case (self::APPEND):
            default:
                return $content . $separator . $output;
        }
    }
}

?>
