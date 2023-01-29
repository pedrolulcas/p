<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home extends CI_Controller {

	
	
	public function index()
	{
		$this->load->database();
		$this->load->model('bd_padaria');

		$notify = $this->bd_padaria->get_estoque();
		foreach($notify as $n){
			if($n->quantidade_disponivel <= $n->quantidade_minima_produto+($n->quantidade_minima_produto*0.5)){
				$notify_all[] = $n;
			}
		}


		$data["title"] = "Home";
		$data["favoritas"] = $this->bd_padaria->get_favoritas();
		$data["notificacoes"] = $notify_all;

		$this->load->helper('url');
		$this->load->view('components/navbar');
		$this->load->view('components/header', $data);
		$this->load->view('home');
	}


}
