<?php

class Application_Form_Usuario extends Zend_Form
{

    public function init() {
        $this-> setName('Cadastro Usuarios');
        
        
        $nome = new Zend_Form_Element_Text('nome');
        $nome->setLabel('nome')
        ->setRequired(true)
        ->addFilter('StripTags')
        ->addValidator('NotEmpty');
              
        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('Email')
        	->setRequired(true)
        	->addFilter('StripTags')
        	->addValidator('NotEmpty');

        $telefone = new Zend_Form_Element_Text('telefone');
        $telefone->setLabel('Telefone')
        ->setRequired(true)
        ->addFilter('StripTags')
        ->addValidator('NotEmpty');
        
        $senha = new Zend_Form_Element_Password('senha');
        $senha->setLabel('Senha')
        	->setRequired(true)
        	->addFilter('StripTags')
        	->addValidator('NotEmpty');
        
        $resenha = new Zend_Form_Element_Password('resenha');
        $resenha->setLabel('Repita a Senha')
        ->setRequired(true)
        ->addFilter('StripTags')
        ->addValidator('NotEmpty');
        
        $submit = new Zend_Form_Element_Submit('btn_entrar');
        $submit-> setLabel('Entrar')
        	->setAttrib('id','btn_entrar')
        	->setIgnore(true);
        	
        $this->addElements(array($nome,$email,$telefone,$senha,$resenha,$submit));
       
    }


}

