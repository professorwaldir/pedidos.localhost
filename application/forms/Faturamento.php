<?php
	class Application_Form_Faturamento extends Zend_Form {
		
		public function init() {
		
			$this->addElementPrefixPath('My_Decorator', '/var/www/pedidos/application/forms/My/Decorator', 'decorator');
    			$this->addDisplayGroupPrefixPath('My_Decorator', '/var/www/pedidos/application/forms/My/Decorator');

			$this->setName("Cadastro Faturamento");

			$this->setDecorators(array(
			    'FormElements',
			    array('HtmlTag', array('tag' => 'table','id' => 'id-form')),
			    
			    'Form',
			));
			
			$faturamento = new Zend_Form_Element_Hidden('faturamento');

			$fabrica = new Zend_Form_Element_Text('fabrica');
			$fabrica->setLabel('Fábrica')
			->setRequired(true)
			->setDecorators(array('Composite'))
    			->setErrorMessages(array('Campo Obrigatório'))
			->setAttrib('class','inp-form')
			->addFilter('StripTags')
			->addValidator('NoEmpty');

			$posto_codigo = new Zend_Form_Element_Text('posto_codigo');
			$posto_codigo->setLabel('Código Posto')
			->setRequired(true)
			->setDecorators(array('Composite'))
    			->setErrorMessages(array('Campo Obrigatório'))
			->setAttrib('class','inp-form')
			->addFilter('StripTags')
			->addValidator('NoEmpty');

			$posto_nome = new Zend_Form_Element_Text('posto_nome');
			$posto_nome->setLabel('Nome do Posto')
			->setRequired(true)
			->setDecorators(array('Composite'))
    			->setErrorMessages(array('Campo Obrigatório'))
			->setAttrib('class','inp-form')
			->addFilter('StripTags')
			->addValidator('NoEmpty');

			$pedido = new Zend_Form_Element_Text('pedido');
			$pedido->setLabel('Pedido')
			->setRequired(true)
			->setDecorators(array('Composite'))
    			->setErrorMessages(array('Campo Obrigatório'))
			->setAttrib('class','inp-form')
			->addFilter('StripTags')
			->addValidator('NoEmpty');

			$nota_fiscal = new Zend_Form_Element_Text('nota_fiscal');
			$nota_fiscal->setLabel('Nota Fiscal')
			->setRequired(true)
			->setDecorators(array('Composite'))
    			->setErrorMessages(array('Campo Obrigatório'))
			->setAttrib('class','inp-form')
			->addFilter('StripTags')
			->addValidator('NoEmpty');

			$submit = new Zend_Form_Element_Submit('btn_gravar');
			$submit->setAttrib('class','form-submit')
    			->setLabel(' ')
    			->setDecorators(array('Composite'))
			->setAttrib('id','btn_gravar')
			->setIgnore(true);

			$this->addElements(array($fabrica,$posto_codigo,$posto_nome,$pedido,$nota_fiscal,$submit,$faturamento));

			
		}
	}
