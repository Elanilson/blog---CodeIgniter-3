<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Postagens extends CI_Controller {

	public function __construct(){
		parent:: __construct();
		$this->load->model('categorias_model');
		$this->load->model('publicacoes_model');
		$this->categorias = $this->categorias_model->listar_categorias();
	}


	public function index($id,$slug = null){

		$this->load->model('publicacoes_model');

		

		$dados['categorias'] = $this->categorias;
		$dados['postagens'] = $this->publicacoes_model->publicacao($id);

		// dados para serem enviados para o cabeçalho
		$dados['titulo'] = "Publicação";
		$dados['subtitulo'] = $slug;
		//$dados['subtitulodb'] = $this->categorias_model->listar_titulo($id);

		$this->load->view('frontend/template/html-header',$dados);
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/publicacao');
		$this->load->view('frontend/template/aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}
}
