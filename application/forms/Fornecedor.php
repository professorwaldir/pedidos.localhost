<?php

class Application_Form_Fornecedor extends Zend_Form
{

    public function init()
    {

    	$this->addElementPrefixPath('My_Decorator', APPLICATION_PATH.'/forms/My/Decorator', 'decorator');
    	$this->addDisplayGroupPrefixPath('My_Decorator', APPLICATION_PATH.'/forms/My/Decorator');
    	
    	$this-> setName('Cadastro de Transportadora');

    	$this->setDecorators(array(
		    'FormElements',
		    array('HtmlTag', array('tag' => 'table','id' => 'id-form')),
		    
		    'Form',
		));
    	$fornecedor = new Zend_Form_Element_Hidden('fornecedor');
    	
		$descricao = new Zend_Form_Element_Text('descricao');
        $descricao->setLabel('Descricao')
        ->setRequired(true)
        ->setAttrib('class','inp-form')
        ->setErrorMessages(array('Campo Obrigatório'))
        ->setDecorators(array('Composite'))
        ->addFilter('StripTags')
        ->addValidator('NotEmpty');
        
        

    	$referencia = new Zend_Form_Element_Text('endereco');
        $referencia->setLabel('Endereco')
        ->setRequired(true)
        ->setAttrib('class','inp-form')
        ->setDecorators(array('Composite'))
        ->setErrorMessages(array('Campo Obrigatório'))
        ->addFilter('StripTags')
        ->addValidator('NotEmpty');

        
        $fone = new Zend_Form_Element_Text('telefone');
        $fone->setLabel('Telefone')
        ->setRequired(true)
        ->setAttrib('class','inp-form')
    
        ->setDecorators(array('Composite'))
        ->addFilter('StripTags');

        $data = new Zend_Form_Element_Text('data');
        $data->setLabel('Data')
        ->setRequired(true)
        ->setAttrib('class','inp-form')
        ->setErrorMessages(array('Campo Obrigatório'))
        ->setDecorators(array('Composite'))
        ->addFilter('StripTags')
        ->addValidator('NotEmpty');
        
        
        $grupo = new Zend_Form_Element_Text('grupo');
        $grupo->setLabel('Grupo')
        ->setRequired(true)
        ->setAttrib('class','inp-form')
        ->setErrorMessages(array('Campo Obrigatório'))
        ->setDecorators(array('Composite'))
        ->addFilter('StripTags')
        ->addValidator('NotEmpty');
        
        
    	$submit = new Zend_Form_Element_Submit('btn_gravar');
    	$submit->setAttrib('class','form-submit')
    	->setLabel(' ')
    	->setDecorators(array('Composite'))
    	->setAttrib('id','btn_gravar')
    	->setIgnore(true);
    	 
    	$this->addElements(array($descricao,$referencia, $fone, $fornecedor,$data,$grupo, $submit));
    	
    }


}

