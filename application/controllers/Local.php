<?php

class Endereco extends MY_Controller {

    public function __construct() {
        
        parent::__construct();

        $this->load->model('local/cidade');

        $this->load->model('endereco/endereco');

      
    }


    public function listarCombo($id) {
      $this->banco->conetarBanco();
      $cidade =$this->cidade->listarCombo($id); 
      foreach ($cidade as $dados) {
       	echo $dados;
       } 
      $this->banco->desconetarBanco();

    }


    public function cadastrar() {
       $this->banco->conetarBanco();     
       $config['estado'] = $this->estado->listarCombo();
       $config['endereco']= $this->endereco->dados();
       $this->load->view("local/form_local", $config);
       $this->banco->desconetarBanco();
    }

//Clientes

    

}
