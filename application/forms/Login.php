<?php

class Application_Form_Login extends Zend_Form {

    public function init()   {
    	
        $this-> setName('Login');
        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('Emaillll')
        	->setRequired(true)
        	->addFilter('StripTags')
        	->setAttrib('class','login-inp')
        	->addValidator('NotEmpty');
        
        $senha = new Zend_Form_Element_Password('senha');
        $senha->setLabel('Senha')
        	->setRequired(true)
        	->setAttrib('class','login-inp')
        	->addFilter('StripTags')
        	->addValidator('NotEmpty');
        
        $submit = new Zend_Form_Element_Submit('btn_entrar');
        $submit-> setLabel('Entrar')
        	->setAttrib('id','btn_entrar')
        	->setAttrib('class','submit-login')
        	->setIgnore(true);
        	
        $this->addElements(array($email,$senha,$submit));
       
        
    }


}

