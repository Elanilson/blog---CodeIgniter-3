<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sobrenos extends CI_Controller {

	public function __construct(){
		parent:: __construct();
		$this->load->model('categorias_model');
		$this->load->model('usuarios_model');
		$this->load->model('publicacoes_model');
		$this->categorias = $this->categorias_model->listar_categorias();
	}


	public function index(){

		

		$dados['categorias'] = $this->categorias;
		//$dados['postagens'] = $this->publicacoes_model->categoria_pub($id);
		$dados['autores'] = $this->usuarios_model->listar_autores();

		// dados para serem enviados para o cabeçalho
		$dados['titulo'] = "Sobre Nós";
		$dados['subtitulo'] = 'Conheça nossa equipe';
		//$dados['subtitulodb'] = $this->categorias_model->listar_titulo($id);

		$this->load->view('frontend/template/html-header',$dados);
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/sobrenos');
		$this->load->view('frontend/template/aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}
	public function autores($id,$slug = null){
		$this->load->model('publicacoes_model');

		$dados['categorias'] = $this->categorias;
		

		// dados para serem enviados para o cabeçalho
		$dados['titulo'] = "Sobre nos";
		$dados['subtitulo'] = 'Autor';
		$dados['autores'] = $this->usuarios_model->listar_autor($id);
		

		$this->load->view('frontend/template/html-header',$dados);
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/autor');
		$this->load->view('frontend/template/aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');

	}
}
