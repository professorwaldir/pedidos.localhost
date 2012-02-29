<?php

class Admin_FaturamentoController extends Zend_Controller_Action {

    public function init() {
        $this->_model = new Application_Model_Faturamento();

        $this->view->assign('titulo', "Faturamento");
    }

    public function indexAction() {
        $this->_helper->redirector('listar');
    }

    public function cadastroAction() {

    	$form  = new Application_Form_Faturamento();
    	$model = new Application_Model_Faturamento();
    	
    	$this->view->form  = $form;   	
    	$this->view->mErro = "style=display:none";
    	
    	if ($this->_request->isPost()) {

    		$dados = $this->_request->getPost();
    		
    		if ($form->isValid($dados)){
    			
    			$id = $model->insert($form->getValues());
    			$this->_forward('listar');

    		} else {

    			$this->view->mErro = "style=display:block";

    		}
    		
    	}

    }

    public function editarAction() {

    	$form  = new Application_Form_Faturamento();
    	$model = new Application_Model_Faturamento();
    
    	$id = $this-> _getParam('id');
    	 
    	$dados = $model->fetchRow("faturamento=$id")->toArray();
    	$form->populate($dados);
    	$this->view->form = $form;
    	
    	if ($this->_request->isPost()) {
    		$dados = $this->_request->getPost();
    	
    		if ($form->isValid($dados)){
    			
    			$values = $form->getValues();
    			$id = $model->update($values,'faturamento = '.$values['faturamento']);
    			$this-> _forward('listar');

    		}
    	
    	}

    }

    public function listarAction() {

        $this->view->assign('data', $this->_model->fetchAll());
    }

    public function deleteAction() {
        $id = (int) $this->_getParam('id', 0);

        $this->_model->_delete($id);
        $this->_helper->redirector('listar');
    }

}

