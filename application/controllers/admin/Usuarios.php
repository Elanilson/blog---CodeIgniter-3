<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	public function __construct(){
		parent:: __construct();
		$this->load->model('usuarios_model');
	}


	public function index(){
		if(!$this->session->userdata('logado')){
			redirect(base_url('admin/login'));

		}

		$this->load->library('table');

		
		$dados['usuarios']= $this->usuarios_model->listar_autores();

		// dados para serem enviados para o cabeçalho
		$dados['titulo'] = "Painel de controle";
		$dados['subtitulo'] = "Usuarios";

		$this->load->view('backend/template/html-header',$dados);
		$this->load->view('backend/template/template');
		$this->load->view('backend/usuarios');
		$this->load->view('backend/template/html-footer');
	}

	public function inserir(){ 
		if(!$this->session->userdata('logado')){
			redirect(base_url('admin/login'));

		}
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txt-nome',"Nome do usuario",
			'required|min_length[3]'
	);
		$this->form_validation->set_rules('txt-email',"Email",
			'required|valid_email'
	);
		$this->form_validation->set_rules('txt-historico',"Historico",
			'required|min_length[20]'
	);
		$this->form_validation->set_rules('txt-user',"User",
			'required|min_length[3]|is_unique[usuario.user]'
	);
		$this->form_validation->set_rules('txt-senha',"Senha",
			'required|min_length[3]'
	);
		$this->form_validation->set_rules('txt-confirm-senha',"Confirmar senha",
			'required|matches[txt-senha]'
	);

		if($this->form_validation->run() == FALSE){
			$this->index();

		}else{
			$nome = $this->input->post('txt-nome');
			$email = $this->input->post('txt-email');		
			$user = $this->input->post('txt-user');
			$historico = $this->input->post('txt-historico');
			$senha = $this->input->post('txt-senha');
			if($this->usuarios_model->adicionar($nome,$email,$historico,$user,$senha)){
				redirect(base_url('admin/usuarios'));

			}else{
				echo 'Houve um error no sistema';
			}

		}

	}

	public function excluir($id){
		if(!$this->session->userdata('logado')){
			redirect(base_url('admin/login'));

		}

	if($this->usuarios_model->excluir($id)){
		redirect(base_url('admin/usuarios'));

	}else{
		echo 'Houve um error no sistema';
	}

		


	}
	public function alterar($id){
		if(!$this->session->userdata('logado')){
			redirect(base_url('admin/login'));

		}

		

		$dados['usuarios'] = $this->usuarios_model->listar_usuario($id);

		// dados para serem enviados para o cabeçalho
		$dados['titulo'] = "Painel de controle";
		$dados['subtitulo'] = "Usuarios";

		$this->load->view('backend/template/html-header',$dados);
		$this->load->view('backend/template/template');
		$this->load->view('backend/alterarusuario');
		$this->load->view('backend/template/html-footer');

	}
	public function salvar_alteracao(){
		if(!$this->session->userdata('logado')){
			redirect(base_url('admin/login'));

		}

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

	public function pageLogin(){

		// dados para serem enviados para o cabeçalho
		$dados['titulo'] = "Painel de controle";
		$dados['subtitulo'] = "Entrar no sistema";

		$this->load->view('backend/template/html-header',$dados);
		$this->load->view('backend/login');
		$this->load->view('backend/template/html-footer');

	}
	public function login(){
			$this->load->library('form_validation');
		$this->form_validation->set_rules('txt-user',"Usuário",
			'required|min_length[3]'
	);
		$this->form_validation->set_rules('txt-senha',"Senha",
			'required|min_length[3]'
	);

		if($this->form_validation->run() == FALSE){
			$this->pageLogin();

		}else{
			$usuario = $this->input->post('txt-user');
			$senha = $this->input->post('txt-senha');
			$this->db->where('user',$usuario);
			$this->db->where('senha',md5($senha));
			$userLogado = $this->db->get('usuario')->result();
			if(count($userLogado)==1){
				$dadosSessao['userLogado'] = $userLogado[0];
				$dadosSessao['logado'] = true;
				$this->session->set_userdata($dadosSessao);
				redirect(base_url('admin'));

			}else{

				$dadosSessao['userLogado'] = null;
				$dadosSessao['logado'] = false;
				$this->session->set_userdata($dadosSessao);
				redirect(base_url('admin/login'));

			}
			

		}
	}

	public function logout(){

				$dadosSessao['userLogado'] = null;
				$dadosSessao['logado'] = false;
				$this->session->set_userdata($dadosSessao);
				redirect(base_url('admin/login'));

	}
}
