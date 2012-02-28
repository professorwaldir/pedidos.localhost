<?php

class Application_Form_Preco extends Zend_Form
{

    public function init()
    {
    	$this-> setName('Cadastro de Preços');
    	
    	$preco = new Zend_Form_Element_Hidden('preco');
    	
    	
    	$tabela = new Zend_Form_Element_Text('tabela');
    	$tabela->setLabel('tabela')
    	->setRequired(true)
    	->addFilter('StripTags')
    	->addValidator('NotEmpty');
    	
    	$peca = new Zend_Form_Element_Text('peca');
    	$peca->setLabel('peca')
    	->setRequired(true)
    	->addFilter('StripTags')
    	->addValidator('NotEmpty');
    	
    	$valor = new Zend_Form_Element_Text('valor');
    	$valor->setLabel('valor')
    	->setRequired(true)
    	->addFilter('StripTags')
    	->addValidator('NotEmpty');
    	
    	$submit = new Zend_Form_Element_Submit('btn_gravar');
    	$submit-> setLabel('Gravar')
    	->setAttrib('id','btn_gravar')
    	->setIgnore(true);
    	 
    	$this->addElements(array($preco,$tabela,$peca,$valor,$submit));
    	
    }


}

