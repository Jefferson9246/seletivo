<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function index()
	{
			$this->load->view('mostra_usuarios.php');
	}

	public function get_prod(){
		$this->load->model('usuarios_model','usuarios');
		$produtos = $this->usuarios->getUsuarios();
		// $dados['produtos'] = $produtos;
		$pass = false;
		if($produtos){
			$pass = true;
		}

		json_output(array(
			'pass'=> $pass,
			'produtos'=> $produtos
		));
	}

}
