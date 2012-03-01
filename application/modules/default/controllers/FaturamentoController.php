<?php
	class Default_FaturamentoController extends Zend_Controller_Action {

		public function init() {

		}

		public function indexAction() {
			
			$form = new Application_Form_Faturamento();

			$this->view->form = $form;

			if ($this->_request->isPost()) {
				$data = $this->_request->getPost();
			
				echo "<pre>";
				print_r($data);
			
				if ($form->isValid($data)){
						
					$model = new Application_Model_Faturamento();
					if ($model->save($data)) {
						$this->view->error= false;
					}
				}
			}

		}

		public function updateAction() {

			$form = new Application_Form_Faturamento();

			$this->view->form = $form;

			if ($this->_request->isPost()) {
				$data = $this->_request->getPost();
			
				if ($form->isValid($data)){
						
					$model = new Application_Model_Faturamento();
					if ($model->save($data, "id =".$data['faturamento'])) {
						$this->view->error= false;
					}
				}
			}

		}

		public function deleteAction() {
			
			$model = new Application_Model_Faturamento();
			$faturamento = $this->_getParam('faturamento');			
			$model->delete("id = $faturamento");

		}

	}
