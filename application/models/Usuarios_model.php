<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model {
	public $id;
	public $nome;	
	public $email;
	public $img;
	public $historico;
	public $user;
	public $senha;



	public function __construct(){
		parent:: __construct();

	}



	public function listar_autor($id){
		$this->db->select('id,nome,historico,img');
		$this->db->from('usuario');
		$this->db->where("id",$id);
		return $this->db->get()->result();
	}
	public function listar_usuario($id){
		$this->db->select('id,nome,historico,img,user');
		$this->db->from('usuario');
		$this->db->where("md5(id)",$id);
		return $this->db->get()->result();
	}
	public function listar_autores(){
		$this->db->select('id,nome,img');
		$this->db->from('usuario');
		$this->db->order_by('nome','ASC');
		return $this->db->get()->result();
	}
	public function adicionar($nome,$email,$historico,$user,$senha){

		$dados['nome'] = $nome;		
		$dados['email'] = $email;
		$dados['historico'] = $historico;
		$dados['user'] = $user;
		$dados['senha'] = md5($senha);
		

		return $this->db->insert('usuario',$dados);

	}
	public function excluir($id){

		$this->db->where('md5(id)',$id);
		return $this->db->delete('usuario');

	}


	
}
