<?php

class Admin_CondicaoPagamentoController extends Zend_Controller_Action {

    public function init() {
        $this->_model = new Application_Model_CondicaoPagamento();

        $this->view->assign('titulo', "Condição de Pagamento");
    }

    public function indexAction() {
        $this->_helper->redirector('listar');
    }

    public function condicaoAction() {
        $form = new Application_Form_CondicaoPagamento();
        $form->condicaoPagamento();

        $id = (int) $this->_getParam('id', 0);
        $data = $this->_model->_get($id);
        if ($data)
            $form->populate($data);

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->_request->getPost())) {
                $this->_model->_save($form->getValues());

                $this->_helper->redirector('index');
            } else {
                $form->populate($form->getValues());
            }
        }

        $this->view->assign('form', $form);
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

