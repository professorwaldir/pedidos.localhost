<?php

class Application_Form_GrupoClientes extends Zend_Form
{

    public function init()
    {
    	$this->addElementPrefixPath('My_Decorator', APPLICATION_PATH.'/forms/My/Decorator', 'decorator');
    	$this->addDisplayGroupPrefixPath('My_Decorator', APPLICATION_PATH.'/forms/My/Decorator');
    	
    	$this-> setName('Cadastro de Grupo de Clientes');

    	$this->setDecorators(array(
		    'FormElements',
		    array('HtmlTag', array('tag' => 'table','id' => 'id-form')),
		    
		    'Form',
		));
    	$grupo_cliente = new Zend_Form_Element_Hidden('grupo_cliente');
    	
    	
    	$nome = new Zend_Form_Element_Text('nome');
    	$nome->setLabel('Nome')
    	->setRequired(true)
    	->setAttrib('class','inp-form')
    	->setDecorators(array('Composite'))
    	->setErrorMessages(array('Campo Obrigatório'))
    	->addFilter('StripTags')
    	->addValidator('NotEmpty');
    	
    	$ativo = new Zend_Form_Element_Radio('ativo');
          $ativo->setLabel('Ativo')
          ->setAttrib('class','form-radio')
    	->setDecorators(array('Composite'));
          $ativo->addMultiOption("inativo", "Inativo");
          $ativo->addMultiOption("ativo", "Ativo")
          ->setAttrib("checked", "checked");
    	
    	$submit = new Zend_Form_Element_Submit('btn_gravar');
    	$submit->setAttrib('class','form-submit')
    	->setLabel(' ')
    	->setDecorators(array('Composite'))
    	->setAttrib('id','btn_gravar')
    	->setIgnore(true);
    	 
    	$this->addElements(array($grupo_cliente,$nome,$ativo,$submit));
    	
    }


}

