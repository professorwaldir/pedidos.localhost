<?php

class Admin_GrupoClientesController extends Zend_Controller_Action
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
    	$form = new Application_Form_GrupoClientes();
    	
    	$this->view->form = $form;   	
    	$this->view->mErro = "style=display:none";
    	$model = new Application_Model_GrupoClientes();
    	
    	if ($this->_request->isPost()) {
    		$dados = $this->_request->getPost();
    		
                    if ($form->isValid($dados)){
    			$id = $model->insert($form->getValues());
    			$this-> _forward('listar');  			
    		}else {
    			$this->view->mErro = "style=display:block";
    		}
    		
    	}
    }
    
     public function listarAction() {
    	$model = new Application_Model_GrupoClientes();
    	$dados =  $model->fetchAll();
    	
    	$pagina = intval($this->_getParam('pagina', 1));
    	$qtde_pagina = intval($this->_getParam('qtde_pagina', 2));    	
    	    	
          $paginator = Zend_Paginator::factory($dados);
          $paginator->setItemCountPerPage($qtde_pagina);
          $paginator->setPageRange(7);
          $paginator->setCurrentPageNumber($pagina);
          $this->view->paginator = $paginator;
          $this->view->pecas = $dados;        

    	
    }
    
    public function deletarAction() {
    	$model = new Application_Model_GrupoClientes();
    	$id = $this-> _getParam('id');
    	$res = $model->delete(' grupo_cliente = '. $id);
    	$this-> _forward('listar');
    	
    }

    public function editarAction() {
    	$form = new Application_Form_GrupoClientes();
    	$model = new Application_Model_GrupoClientes();
    	$id = $this-> _getParam('id');
    	$dados = $model->fetchRow(" grupo_cliente = $id")->toArray();
    	$form->populate($dados);
    	$this->view->form = $form;
    	
    	if ($this->_request->isPost()) {
    		$dados = $this->_request->getPost();
    	
    		if ($form->isValid($dados)){
    			
    			$values = $form->getValues();
    			$id = $model->update($values,'grupo_cliente = '.$values['grupo_cliente']);
    			$this-> _forward('listar');
    		}
    	
    	}
    	
    
    }
    
}

