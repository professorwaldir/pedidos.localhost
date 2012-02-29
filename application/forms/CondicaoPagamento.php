<?php

class Application_Form_CondicaoPagamento extends Zend_Form {

    public function init() {
        /* Form Elements & Other Definitions Here ... */
    }

    public function condicaoPagamento() {
        $this->setName('Post');
        $this->setAttrib('class', 'form');

        $id = new Zend_Form_Element_Hidden('condicao_pagamento');

        $codigo = new Zend_Form_Element_Text('codigo');
        $codigo->setLabel('Código')
                ->setRequired(true)
                ->setAttrib('class', 'inp-form')
                ->addFilter('StripTags')
                ->addValidator('NotEmpty');

        $descricao = new Zend_Form_Element_Text('descricao');
        $descricao->setLabel('Descrição')
                ->setRequired(true)
                ->setAttrib('class', 'inp-form')
                ->addFilter('StripTags')
                ->addValidator('NotEmpty');

        $status = new Zend_Form_Element_Select('ativo');

        $status->setLabel('Status')
                ->addMultiOption(0, 'Ativo')
                ->addMultiOption(1, 'Inativo')
                ->setAttrib('class', 'styledselect_form_1');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Gravar')->setIgnore(true);

        $this->addElements(array($id, $codigo, $descricao, $descricao, $status, $submit));
    }

}

