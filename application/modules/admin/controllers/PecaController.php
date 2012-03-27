<?php

class Admin_PecaController extends Zend_Controller_Action
{

    public function init()
    {
    	$controller = $this->getRequest()->getControllerName();
    	$this->view->controller = $controller;
    }

    public function indexAction()
    {
        	$this-> _forward('/listar');
    }
    
    public function cadastroAction() {
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
    			$this-> _forward('/listar');
    		}
    	
    	}
    	
    
    }
    
    public function listarAction() {
    	$model = new Application_Model_Peca();
    	
		$filtro = $this->_getParam('filtro');
		
		    	
		if (!empty($filtro)) {
			$cond = $model->select()->where('descricao like ?','%'.$filtro.'%')->orWhere('referencia like ?','%'.$filtro.'%');
			echo $model->select()->where('descricao like ?','%'.$filtro.'%')->orWhere('referencia like ?','%'.$filtro.'%')->assemble();
		} else {
			$cond= null;
		}
		
		$this->view->filtro = $filtro;
		
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
    	$this-> _forward('/listar');
    	
    }

    public function etiquetaAction() {
    	 
    	if ($this->_request->isPost()) {
    		$dados = $this->_request->getPost();
    		$n = count($dados);
    		
//     		foreach($dados as $i => $v) {
//     			$dados[$i+$n] = $v;
//     		}

    		$pdf = new Zend_Pdf();
    		$pdf->pages[] = $page = new Zend_Pdf_Page(Zend_Pdf_Page::SIZE_A4);
    		
    		
    		$pontos = 842/297 ;
    		
    		$margem_superior = 10 ;
    		$margem_superior = 10 * $pontos;    		
    		
    		$altura_pagina = 297;
    		$altura_pagina = $altura_pagina * $pontos;
    		
    		$largura_pagina = 210 ;
    		$largura_pagina = $largura_pagina * $pontos;
    		 		    		
    		$etiqueta['altura']  = 30 * $pontos;
    		$etiqueta['largura'] = 60 * $pontos;
    		$etiqueta['distancia_horizontal'] = 5 * $pontos;  
    		$etiqueta['distancia_vertical'] = 15 * $pontos;    		
			$etiqueta['qtde_etiqueta_linha'] = 3 ;
    		$etiqueta['margem_esquerda'] = 10* $pontos ;
    		$etiqueta['margem_inferior'] = $altura_pagina-($margem_superior);  
 			
    		$linha_atual = 0;
    		$coluna_atual = 0;
    		$etiqueta_atual = 0;
    		    		
    		//echo "<pre>";
    		//print_r($dados);
    		// Draw text
    		foreach ($dados as $index => $valor) {

    			$coluna_atual= $etiqueta_atual % $etiqueta['qtde_etiqueta_linha'];
    			$linha_atual = floor($etiqueta_atual/$etiqueta['qtde_etiqueta_linha']);
    			
    			echo "CA: {$coluna_atual} - LA: {$linha_atual}<br>";
    			
    			$valor2 = str_pad($valor, 12,'0',STR_PAD_LEFT);
    			// Somente o texto a ser escrito é necessário
    			$barcodeOptions = array('text' => $valor2, 'BarHeight' => 10,'BarWidth' => 20);
    			
    			$bc = Zend_Barcode::factory(
    			    		    'ean13',
    			    		    'image',
    			$barcodeOptions,
    			array()
    			);
    			/* @var $bc Zend_Barcode */
    			$res = $bc->draw();
    			$filename = tempnam('/var/www/teste/', 'image').'.png';
    			imagepng($res, $filename);

    			$image = Zend_Pdf_Image::imageWithPath($filename);
    			$size = getimagesize($filename);
    			echo "<br>";
    			echo $left   = $etiqueta['margem_esquerda']+$coluna_atual*($etiqueta['largura']+$etiqueta['distancia_horizontal']); echo "<br>";
    			echo $bottom = $altura_pagina - $margem_superior - $etiqueta['altura']*($linha_atual+1)-$etiqueta['distancia_vertical']*$linha_atual;echo "<br>";
    			echo $top    = $bottom+$etiqueta['altura'];echo "<br>";
    			echo $right  = $left+$etiqueta['largura'];echo "<br>";
    			
    			$page->drawImage($image, $left, $bottom,$right,$top);
    			 
    			//echo $index ;    			
    			
    			$etiqueta_atual++;
    		}
    		
    		$pdfData = $pdf->render(true);
    		
    		
    		header("Content-Disposition: inline; filename=result.pdf");
    		header("Content-type: application/x-pdf");
    		
    		echo $pdfData; 
    		
    		

    		die;
    	
    	}
    }
    
}

