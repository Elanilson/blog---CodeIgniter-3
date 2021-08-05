<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends CI_Controller {

	public function __construct(){
		parent:: __construct();
		if(!$this->session->userdata('logado')){
			redirect(base_url('admin/login'));

		}
		$this->load->model('categorias_model');
		$this->categorias = $this->categorias_model->listar_categorias();
		
	}


	public function index(){

		$this->load->library('table');

		$dados['categorias'] = $this->categorias;

		// dados para serem enviados para o cabeçalho
		$dados['titulo'] = "Painel de controle";
		$dados['subtitulo'] = "categoria";

		$this->load->view('backend/template/html-header',$dados);
		$this->load->view('backend/template/template');
		$this->load->view('backend/categoria');
		$this->load->view('backend/template/html-footer');
	}
	public function inserir(){ 
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txt-categoria',"Nome da Categoria",
			'required|min_length[3]|is_unique[categoria.titulo]'
	);

		if($this->form_validation->run() == FALSE){
			$this->index();

		}else{
			$titulo = $this->input->post('txt-categoria');
			if($this->categorias_model->adicionar($titulo)){
				redirect(base_url('admin/categoria'));

			}else{
				echo 'Houve um error no sistema';
			}

		}

	}

	public function excluir($id){

	if($this->categorias_model->excluir($id)){
		redirect(base_url('admin/categoria'));

	}else{
		echo 'Houve um error no sistema';
	}

		


	}
	public function alterar($id){

		$this->load->library('table');

		$dados['categorias'] = $this->categorias_model->listar_categoria($id);

		// dados para serem enviados para o cabeçalho
		$dados['titulo'] = "Painel de controle";
		$dados['subtitulo'] = "categoria";

		$this->load->view('backend/template/html-header',$dados);
		$this->load->view('backend/template/template');
		$this->load->view('backend/alterarcategoria');
		$this->load->view('backend/template/html-footer');

	}
	public function salvar_alteracao(){

			$this->load->library('form_validation');
		$this->form_validation->set_rules('txt-categoria',"Nome da Categoria",
			'required|min_length[3]|is_unique[categoria.titulo]'
	);

		if($this->form_validation->run() == FALSE){
			$this->index();

		}else{
			$titulo = $this->input->post('txt-categoria');
			$id = $this->input->post('txt-id');

			if($this->categorias_model->alterar($titulo,$id)){
				redirect(base_url('admin/categoria'));

			}else{
				echo 'Houve um error no sistema';
			}

		}


	}
}
