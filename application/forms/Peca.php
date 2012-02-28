<?php

class Application_Form_Peca extends Zend_Form
{

    public function init()
    {

    	$this->addElementPrefixPath('My_Decorator', '/var/www/pedidos.localhost/application/forms/My/Decorator', 'decorator');
    	$this->addDisplayGroupPrefixPath('My_Decorator', '/var/www/pedidos.localhost/application/forms/My/Decorator');
    	
    	$this-> setName('Cadastro de peças');
    	$this->setDecorators(array(
		    'FormElements',
		    array('HtmlTag', array('tag' => 'table')),
		    'Form',
		));
    	$peca = new Zend_Form_Element_Hidden('peca');
    	
    	
    	$referencia = new Zend_Form_Element_Text('referencia');
    	$referencia->setLabel('referencia')
    	->setRequired(true)
    	->setAttrib('class','inp-form')
    	->setDecorators(array('Composite'))
    	->setErrorMessages(array('Campo Obrigatório'))
    	->addFilter('StripTags')
    	->addValidator('NotEmpty');
    	
    	$descricao = new Zend_Form_Element_Text('descricao');
    	$descricao->setLabel('descricao')
    	->setRequired(true)
    	->setAttrib('class','inp-form')    	
    	->setDecorators(array('Composite'))
    	->addFilter('StripTags')
    	->addValidator('NotEmpty');
    	
    	$unidade = new Zend_Form_Element_Text('unidade');
    	$unidade->setLabel('unidade')
    	->setAttrib('class','inp-form')   
    	->setDecorators(array('Composite'))
    	->setRequired(true)
    	->addFilter('StripTags')
    	->addValidator('NotEmpty');
    	
    	$origem = new Zend_Form_Element_Select('origem');    	
    	$origem->addMultiOptions(array('Nac'=>'Nac','Imp'=>'Imp'));
    	$origem->setLabel('origem')
    	->setRequired(true)
    	->setAttrib('class','styledselect_form_1')
    	->setDecorators(array('Composite'))
    	->addFilter('StripTags')
    	->addValidator('NotEmpty');
    	
    	$ipi = new Zend_Form_Element_Text('ipi');
    	$ipi->setLabel('ipi')
    	->setRequired(true)
    	->setDecorators(array('Composite'))
    	->setAttrib('class','inp-form')
    	->addFilter('StripTags')
    	->addValidator('NotEmpty');
    	
    	$submit = new Zend_Form_Element_Submit('btn_gravar');
    	$submit-> setLabel('Gravar')
    	->setAttrib('class','form-submit')  
    	->setDecorators(array('Composite'))
    	->setAttrib('id','btn_gravar')
    	->setIgnore(true);
    	 
    	$this->addElements(array($referencia,$descricao,$unidade,$origem,$ipi,$submit,$peca));
    	
    }


}

