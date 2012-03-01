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
    		$data_nota = $dados['data_nota'];
    		
    		
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
    	
		$filtro = $this->_getParam('filtro');
    	
		if (!empty($filtro)) {
			$cond = $model->select()->where('descricao = ?',$filtro)->orWhere('referencia = ?',$filtro);
			echo $model->select()->where('descricao = ?',$filtro)->orWhere('referencia = ?',$filtro)->assemble();
		} else {
			$cond= null;
		}
		
		
		$dados =  $model->fetchAll($cond);
		
    	
    	$pagina = intval($this->_getParam('pagina', 1));
    	$qtde_pagina = intval($this->_getParam('qtde_pagina', 2));    	
    	   	
		 $paginator = Zend_Paginator::factory($dados);
        // Seta a quantidade de registros por página
        $paginator->setItemCountPerPage($qtde_pagina);
        // numero de paginas que serão exibidas
        $paginator->setPageRange(7);
        // Seta a página atual
        $paginator->setCurrentPageNumber($pagina);
        // Passa o paginator para a view
        $this->view->paginator = $paginator;
        $this->view->pecas = $dados;        

    	
    }
    
    public function deletarAction() {
    	$model = new Application_Model_Peca();
    	$id = $this-> _getParam('id');
    	$res = $model->delete('peca = '. $id);
    	$this-> _forward('listar');
    	
    }

}

