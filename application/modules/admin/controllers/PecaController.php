<?php

class Admin_PecaController extends Zend_Controller_Action
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
    	$form = new Application_Form_Peca();
    	
    	$this->view->form = $form;   	
    	$this->view->mErro = "style=display:none";
    	$model = new Application_Model_Peca();
    	
    	if ($this->_request->isPost()) {
    		$dados = $this->_request->getPost();
    		
    		
    		if ($form->isValid($dados)){
    			//print_r($form->getValues());
    			$id = $model->insert($form->getValues());
    			$this-> _forward('listar');  			
    		}else {
    			$this->view->mErro = "style=display:block";
    		}
    		
    	}
    }

    public function editarAction() {
    	$form = new Application_Form_Peca();
    	$model = new Application_Model_Peca();
    
    	$id = $this-> _getParam('id');
    	 
    	$dados = $model->fetchRow("peca=$id")->toArray();
    	$form->populate($dados);
    	$this->view->form = $form;
    	
    	if ($this->_request->isPost()) {
    		$dados = $this->_request->getPost();
    	
    		if ($form->isValid($dados)){
    			
    			//unset($dados['btn_gravar']);
    			//print_r($dados);
    			$values = $form->getValues();
    			$id = $model->update($values,'peca = '.$values['peca']);
    			$this-> _forward('listar');
    		}
    	
    	}
    	
    
    }
    
    public function listarAction() {
    	$model = new Application_Model_Peca();
    	$this->view->pecas = $model->fetchAll();
    }
    
    public function deletarAction() {
    	$model = new Application_Model_Peca();
    	$id = $this-> _getParam('id');
    	$res = $model->delete('peca = '. $id);
    	$this-> _forward('listar');
    	
    }

}

