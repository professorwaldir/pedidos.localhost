<?php

class Application_Form_Transportadora extends Zend_Form
{

    public function init()
    {

    	$this->addElementPrefixPath('My_Decorator', '../My/Decorator', 'decorator');
    	$this->addDisplayGroupPrefixPath('My_Decorator', '../My/Decorator');
    	
    	$this-> setName('Cadastro de Transportadora');

    	$this->setDecorators(array(
		    'FormElements',
		    array('HtmlTag', array('tag' => 'table','id' => 'id-form')),
		    
		    'Form',
		));
    	$transportadora = new Zend_Form_Element_Hidden('transportadora');
    	
    	$referencia = new Zend_Form_Element_Text('endereco');
        $referencia->setLabel('Endereco')
        ->setRequired(true)
        ->setAttrib('class','inp-form')
        //->setDecorators(array('Composite'))
        ->setErrorMessages(array('Campo Obrigatório'))
        ->addFilter('StripTags')
        ->addValidator('NotEmpty');

        $descricao = new Zend_Form_Element_Text('descricao');
        $descricao->setLabel('Descricao')
        ->setRequired(true)
        ->setAttrib('class','inp-form')
        ->setErrorMessages(array('Campo Obrigatório'))
        //->setDecorators(array('Composite'))
        ->addFilter('StripTags')
        ->addValidator('NotEmpty');

        $fone = new Zend_Form_Element_Text('fone');
        $fone->setLabel('Telefone')
        ->setRequired(true)
        ->setAttrib('class','inp-form')
    
        //->setDecorators(array('Composite'))
        ->addFilter('StripTags');
    	
    	$submit = new Zend_Form_Element_Submit('btn_gravar');
    	$submit->setAttrib('class','form-submit')
    	->setLabel(' ')
    	//->setDecorators(array('Composite'))
    	->setAttrib('id','btn_gravar')
    	->setIgnore(true);
    	 
    	$this->addElements(array($referencia,$descricao, $fone, $transportadora, $submit));
    	
    }


}

