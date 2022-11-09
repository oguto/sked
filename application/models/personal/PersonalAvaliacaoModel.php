<?php


class PersonalAvaliacaoModel extends CI_Model {
    function __construct() {

        parent::__construct();

        $this->load->model('admin/AcessoLoginModel'); 

        $this->tabela = 'PERSONAL_AVALIACAO';
      
    }

    function dados($dados = array()) {

        $array = array();

        $array['id'] =null;

        $array['id_aluno'] =null;

        $array['id_personal'] =null;

        $array['descricao'] =null;

        $array['nota'] =null;

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

        $this->db->insert("PERSONAL_AVALIACAO", $dados);

        return $this->db->insert_id();
    }

    function editar($dados) {

        $dados = array_filter($this->dados($dados));

        $this->db->where('PERSONAL_AVALIACAO.id', $dados['id']);

        $this->db->where('PERSONAL_AVALIACAO.exclusao is null');

        $this->banco->usuario("PERSONAL_AVALIACAO");

        $this->db->update("PERSONAL_AVALIACAO", $dados);
    }

    function listar($maximo = NULL, $inicio = NULL) {

        $this->db->from("PERSONAL_AVALIACAO");

        $this->db->where('PERSONAL_AVALIACAO.exclusao is null');

        $this->banco->usuario("PERSONAL_AVALIACAO");

        $query = $this->db->get("", $maximo, $inicio);
       
        return $query->result_array();
    }

    function filtrar($filtro=array(),$maximo = NULL, $inicio = NULL){

        $filtro=array_filter($this->dados($filtro));

        $this->db->from("PERSONAL_AVALIACAO");

        $this->db->like($filtro);

        $this->db->where('PERSONAL_AVALIACAO.exclusao is null');

        $this->banco->usuario("PERSONAL_AVALIACAO");

        $query = $this->db->get("", $maximo, $inicio);         

        return $query->result_array();

    }

    function ver($id) {

        $this->db->from("PERSONAL_AVALIACAO");

        $this->db->where('PERSONAL_AVALIACAO.id', $id);

        $this->db->where('PERSONAL_AVALIACAO.exclusao is null');

        $this->banco->usuario("PERSONAL_AVALIACAO");

        $query = $this->db->get();

        return $query->row_array();
    }

    function excluir($id) {

        $dados = array();

        $this->db->where('PERSONAL_AVALIACAO.id', $id);

        $this->banco->usuario("PERSONAL_AVALIACAO");

        $dados['exclusao']=date("Y-m-d");

        $this->db->update("PERSONAL_AVALIACAO",$dados);

    }

    function deletar($id) {

        $this->db->where('PERSONAL_AVALIACAO.id', $id);

        $this->db->where('PERSONAL_AVALIACAO.exclusao not null');

        $this->banco->usuario("PERSONAL_AVALIACAO");

        $this->db->delete("PERSONAL_AVALIACAO");

    }

    function contarTotal($filtro=false) {

        $this->db->select('*');

        $this->db->select('PERSONAL_AVALIACAO.id as id');

        $this->db->from("PERSONAL_AVALIACAO");

        $this->db->where('PERSONAL_AVALIACAO.exclusao is null');


        if(!empty($filtro)){

            $filtro = array_filter($filtro);

            $this->db->like($filtro);

        }  

        $this->banco->usuario("PERSONAL_AVALIACAO");

        return $this->db->get()->num_rows();        

    }  
      
  

}