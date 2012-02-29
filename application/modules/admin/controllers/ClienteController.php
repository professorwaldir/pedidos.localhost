<?php

class Admin_ClienteController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        	$this-> _forward('listar');
    }

    public function listarAction() {
    	$model = new Application_Model_Cliente();
    	$this->view->cliente = $model->fetchAll();
    }
}

