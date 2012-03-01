<?php

class Admin_FornecedorController extends Zend_Controller_Action
{

    public function init()
    {
    
    }

    public function indexAction()
    {
        	$this-> _forward('listar');
    }
    
    public function cadastroAction()
    {
    	$form = new Application_Form_Fornecedor();
    	
    	$this->view->form = $form;   	
    	$this->view->mErro = "style=display:none";
    	$model = new Application_Model_Fornecedor();
    	
    	if ($this->_request->isPost()) {

    		$dados = $this->_request->getPost();
    		
    		if ($form->isValid($dados)){
    			
    			$id = $model->insert($form->getValues());
    			$this-> _forward('listar');

    		} else {

    			$this->view->mErro = "style=display:block";

    		}
    		
    	}

    }

    public function editarAction() {
    	$form = new Application_Form_Fornecedor();
    	$model = new Application_Model_Fornecedor();
    
    	$id = $this-> _getParam('id');
    	 
    	$dados = $model->fetchRow("fornecedor=$id")->toArray();
    	$form->populate($dados);
    	$this->view->form = $form;
    	
    	if ($this->_request->isPost()) {
    		$dados = $this->_request->getPost();
    	
    		if ($form->isValid($dados)){
    			
    			$values = $form->getValues();
    			$id = $model->update($values,'fornecedor = '.$id);
    			$this-> _forward('listar');

    		}
    	
    	}

    }
    
    public function listarAction() {

    	$model = new Application_Model_Fornecedor();
    	$this->view->fornecedores = $model->fetchAll();

	
    }
    
    public function deletarAction() {

    	$model = new Application_Model_Fornecedor();
    	$id = $this-> _getParam('id');
    	$res = $model->delete('fornecedor = '. $id);
    	$this-> _forward('listar');
    	
    }

}

