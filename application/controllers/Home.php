<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent:: __construct();
		$this->load->model('categorias_model');
		$this->categorias = $this->categorias_model->listar_categorias();
	}


	public function index($pular =null,$post_por_pagina=null){

		$this->load->model('publicacoes_model');
		$this->load->library('pagination');

		$config['base_url'] = base_url('home');
		$config['total_rows'] = $this->publicacoes_model->contar();
		$config['per_page'] = 5;

		$this->pagination->initialize($config);

		$dados['links_paginacao'] = $this->pagination->create_links();


		$dados['categorias'] = $this->categorias;
		$dados['postagens'] = $this->publicacoes_model->destaque_home();

		// dados para serem enviados para o cabeçalho
		$dados['titulo'] = "Página inicial";
		$dados['subtitulo'] = "Postage Recentes";

		$this->load->view('frontend/template/html-header',$dados);
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/home');
		$this->load->view('frontend/template/aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}
}
