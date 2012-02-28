<?php

class Admin_PrecoController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction(){
    	$this-> _redirect('admin/preco/listar');
    	echo 0;
    	$this->listarAction();     
    }
    
    public function listarAction() {
    	echo '1';
    	$precos = new Application_Model_Preco();
    	$this->view->precos = $precos->fetchAll();
    }
   

    public function gravarAction() {
    	
    	$form = new Application_Form_Preco();
    	$gravar = new Application_Model_Preco();
    	
    	$this->view->form = $form;
    	
    	if ($this->_request->isPost()) {
    	
    		$data = $this->_request->getPost();
    	
    		if ($form->isValid($data)){
    			$id = $gravar->insert($form->getValues());
    			$this-> _forward('listar');
    		}	 
    	}
    }
    
    public function editarAction() {
    	 
    	$form = new Application_Form_Preco();
    	$form -> btn_gravar->setLabel('Alterar');
    	$editar = new Application_Model_Preco();    	
    	
    	$id = $this-> _getParam('id');
    	
    	$dados = $editar->fetchRow("preco=$id")->toArray();
    	$form->populate($dados);
    	$this->view->form = $form;
    	
    	if ($this->_request->isPost()) {
    		$data = $this->_request->getPost();
    		$values = $form->getValues();
    		
    		if ($form->isValid($data)){
    			unset($data['btn_gravar']);
    			$id = $editar->update($data,'preco = '.$values['preco']);
    			$this-> _forward('listar');
    		}	 
    	}
    	
    	
   
    }
    
    public function deletarAction() {
    	$deletar = new Application_Model_Preco();
    	$id = $this-> _getParam('id');
    	$res = $deletar->delete('preco = '. $id);
    	$this-> _forward('listar');    	
    }
}

