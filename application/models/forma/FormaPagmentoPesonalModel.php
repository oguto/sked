<?php


class FormaPagmentoPesonalModel extends CI_Model {
    function __construct() {

        parent::__construct();

        $this->load->model('admin/AcessoLoginModel'); 

        $this->tabela = 'FORMA_PAGMENTO_PESONAL';
      
    }

    function dados($dados = array()) {

        $array = array();

        $array['id'] =null;

        $array['id_forma_pagamento'] =null;

        $array['descricao'] =null;

        $array['id_loja'] =null;

        $array['admin'] =$this->AcessoLoginModel->verAdmin();

        $array['exclusao'] =null;

        foreach ($array as $key => $value) {

             if(isset($dados[$key])){

                 $array[$key]=$dados[$key];

             } else{

               if(is_null($array[$key])){

                   $array[$key] = null;

                }               
              }

        }


        return $array;
    }

   

    function incluir($dados) {

        $dados=array_filter($this->dados($dados));

        $this->db->insert("FORMA_PAGMENTO_PESONAL", $dados);

        return $this->db->insert_id();
    }

    function editar($dados) {

        $dados = array_filter($this->dados($dados));

        $this->db->where('FORMA_PAGMENTO_PESONAL.id', $dados['id']);

        $this->db->where('FORMA_PAGMENTO_PESONAL.exclusao is null');

        $this->banco->usuario("FORMA_PAGMENTO_PESONAL");

        $this->db->update("FORMA_PAGMENTO_PESONAL", $dados);
    }

    function listar($maximo = NULL, $inicio = NULL) {

        $this->db->from("FORMA_PAGMENTO_PESONAL");

        $this->db->where('FORMA_PAGMENTO_PESONAL.exclusao is null');

        $this->banco->usuario("FORMA_PAGMENTO_PESONAL");

        $query = $this->db->get("", $maximo, $inicio);
       
        return $query->result_array();
    }

    function filtrar($filtro=array(),$maximo = NULL, $inicio = NULL){

        $filtro=array_filter($this->dados($filtro));

        $this->db->from("FORMA_PAGMENTO_PESONAL");

        $this->db->like($filtro);

        $this->db->where('FORMA_PAGMENTO_PESONAL.exclusao is null');

        $this->banco->usuario("FORMA_PAGMENTO_PESONAL");

        $query = $this->db->get("", $maximo, $inicio);         

        return $query->result_array();

    }

    function ver($id) {

        $this->db->from("FORMA_PAGMENTO_PESONAL");

        $this->db->where('FORMA_PAGMENTO_PESONAL.id', $id);

        $this->db->where('FORMA_PAGMENTO_PESONAL.exclusao is null');

        $this->banco->usuario("FORMA_PAGMENTO_PESONAL");

        $query = $this->db->get();

        return $query->row_array();
    }

    function excluir($id) {

        $dados = array();

        $this->db->where('FORMA_PAGMENTO_PESONAL.id', $id);

        $this->banco->usuario("FORMA_PAGMENTO_PESONAL");

        $dados['exclusao']=date("Y-m-d");

        $this->db->update("FORMA_PAGMENTO_PESONAL",$dados);

    }

    function deletar($id) {

        $this->db->where('FORMA_PAGMENTO_PESONAL.id', $id);

        $this->db->where('FORMA_PAGMENTO_PESONAL.exclusao not null');

        $this->banco->usuario("FORMA_PAGMENTO_PESONAL");

        $this->db->delete("FORMA_PAGMENTO_PESONAL");

    }

    function contarTotal($filtro=false) {

        $this->db->select('*');

        $this->db->select('FORMA_PAGMENTO_PESONAL.id as id');

        $this->db->from("FORMA_PAGMENTO_PESONAL");

        $this->db->where('FORMA_PAGMENTO_PESONAL.exclusao is null');


        if(!empty($filtro)){

            $filtro = array_filter($filtro);

            $this->db->like($filtro);

        }  

        $this->banco->usuario("FORMA_PAGMENTO_PESONAL");

        return $this->db->get()->num_rows();        

    }  
      
  

}