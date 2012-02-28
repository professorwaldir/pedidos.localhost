<?php

class Application_Form_Peca extends Zend_Form
{

    public function init()
    {
    	$this-> setName('Cadastro de peças');
    	
    	$peca = new Zend_Form_Element_Hidden('peca');
    	
    	
    	$referencia = new Zend_Form_Element_Text('referencia');
    	$referencia->setLabel('referencia')
    	->setRequired(true)
    	->setAttrib('class','inp-form')
    	->setErrorMessages(array('Campo Obrigatório'))
    	->addFilter('StripTags')
    	->addValidator('NotEmpty');
    	
    	$descricao = new Zend_Form_Element_Text('descricao');
    	$descricao->setLabel('descricao')
    	->setRequired(true)
    	->setAttrib('class','inp-form')    	
    	->addFilter('StripTags')
    	->addValidator('NotEmpty');
    	
    	$unidade = new Zend_Form_Element_Text('unidade');
    	$unidade->setLabel('unidade')
    	->setAttrib('class','inp-form')    	
    	->setRequired(true)
    	->addFilter('StripTags')
    	->addValidator('NotEmpty');
    	
    	$origem = new Zend_Form_Element_Select('origem');    	
    	$origem->addMultiOptions(array('Nac'=>'Nac','Imp'=>'Imp'));
    	$origem->setLabel('origem')
    	->setRequired(true)
    	->setAttrib('class','styledselect_form_1')    	
    	->addFilter('StripTags')
    	->addValidator('NotEmpty');
    	
    	$ipi = new Zend_Form_Element_Text('ipi');
    	$ipi->setLabel('ipi')
    	->setRequired(true)
    	->setAttrib('class','inp-form')
    	->addFilter('StripTags')
    	->addValidator('NotEmpty');
    	
    	$submit = new Zend_Form_Element_Submit('btn_gravar');
    	$submit-> setLabel('Gravar')
    	->setAttrib('class','form-submit')    	
    	->setAttrib('id','btn_gravar')
    	->setIgnore(true);
    	 
    	$this->addElements(array($referencia,$descricao,$unidade,$origem,$ipi,$submit,$peca));
    	
    }


}

