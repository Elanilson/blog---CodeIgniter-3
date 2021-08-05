<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias extends CI_Controller {

	public function __construct(){
		parent:: __construct();
		$this->load->model('categorias_model');
		$this->categorias = $this->categorias_model->listar_categorias();
	}


	public function index($id,$slug = null){

		$this->load->model('publicacoes_model');

		$dados['categorias'] = $this->categorias;
		$dados['postagens'] = $this->publicacoes_model->categoria_pub($id);

		// dados para serem enviados para o cabeçalho
		$dados['titulo'] = "Categorias";
		$dados['subtitulo'] = $slug;
		//$dados['subtitulodb'] = $this->categorias_model->listar_titulo($id);

		$this->load->view('frontend/template/html-header',$dados);
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/categoria');
		$this->load->view('frontend/template/aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}
}
