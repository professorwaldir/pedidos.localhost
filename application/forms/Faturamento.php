<?php
	class Application_Form_Faturamento extends Zend_Form {
		
		public function init() {
		
			$this->setName("Cadastro Faturamento");

			$fabrica = new Zend_Form_Element_Text('fabrica');
			$fabrica->setLabel('Fábrica')
			->setRequired(true)
			->addFilter('StripTags')
			->addValidator('NoEmpty');

			$posto_codigo = new Zend_Form_Element_Text('posto_codigo');
			$posto_codigo->setLabel('Código Posto')
			->setRequired(true)
			->addFilter('StripTags')
			->addValidator('NoEmpty');

			$posto_nome = new Zend_Form_Element_Text('posto_nome');
			$posto_nome->setLabel('Nome do Posto')
			->setRequired(true)
			->addFilter('StripTags')
			->addValidator('NoEmpty');

			$pedido = new Zend_Form_Element_Text('pedido');
			$pedido->setLabel('Pedido')
			->setRequired(true)
			->addFilter('StripTags')
			->addValidator('NoEmpty');

			$nota_fiscal = new Zend_Form_Element_Text('nota_fiscal');
			$nota_fiscal->setLabel('Nota Fiscal')
			->setRequired(true)
			->addFilter('StripTags')
			->addValidator('NoEmpty');

			$submit = new Zend_Form_Element_Submit('btn_gravar');
			$submit->setLabel('Gravar')
			->setAttrib('faturamento','btn_gravar')
			->setIgnore(true);

			$this->addElements(array($fabrica,$posto_codigo,$posto_nome,$pedido,$nota_fiscal,$submit));

			
		}
	}
