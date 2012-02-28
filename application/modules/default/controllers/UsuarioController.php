<?php

class Default_UsuarioController extends Zend_Controller_Action
{

	public function init() {
		
	}

	
	public function indexAction()
	{
		$form = new Application_Form_Usuario();
		//$this->view->assign('form',$form);
		$this->view->form = $form;
		
		if ($this->_request->isPost()) {
			$data = $this->_request->getPost();
			
			echo "<pre>";
			print_r($data);
			
			if ($form->isValid($data)){
				$data['senha'] = sha1($data['senha']);
				echo $_POST['nome'];
				//print_r($data);
				
				$model = new Application_Model_Usuario();
				if ($model->save($data)) {
					$this->view->error= false;
				}
			}
		}		
	}

}

