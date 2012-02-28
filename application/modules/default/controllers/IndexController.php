<?php

class Default_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction() {
        // action body
        $form = new Application_Form_Login();
        
        $this->view->form = $form;
        
        if ($this->_request->isPost()) {
        	 
        	$data = $this->_request->getPost();
              	
        	if ($form->isValid($data)){
        		echo "Validou tela mas nao autenticou no banco";
        	} else {
        		echo "não validou";
        	}
        }
    }


}

