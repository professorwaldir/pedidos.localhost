<?php

class Admin_TransportadoraController extends Zend_Controller_Action
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
    	$form = new Application_Form_Transportadora();
    	
    	$this->view->form = $form;   	
    	$this->view->mErro = "style=display:none";
    	$model = new Application_Model_Transportadora();
    	
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
    	$form = new Application_Form_Transportadora();
    	$model = new Application_Model_Transportadora();
    
    	$id = $this-> _getParam('id');
    	 
    	$dados = $model->fetchRow("transportadora=$id")->toArray();
    	$form->populate($dados);
    	$this->view->form = $form;
    	
    	if ($this->_request->isPost()) {
    		$dados = $this->_request->getPost();
    	
    		if ($form->isValid($dados)){
    			
    			$values = $form->getValues();
    			$id = $model->update($values,'transportadora = '.$values['transportadora']);
    			$this-> _forward('listar');

    		}
    	
    	}

    }
    
    public function listarAction() {

    	$model = new Application_Model_Transportadora();
    	$this->view->transportadoras = $model->fetchAll();

    }
    
    public function deletarAction() {

    	$model = new Application_Model_Transportadora();
    	$id = $this-> _getParam('id');
    	$res = $model->delete('transportadora = '. $id);
    	$this-> _forward('listar');
    	
    }

}

