<?php


class GrupoModel extends CI_Model {
    function __construct() {

        parent::__construct();

        $this->load->model('usuario/AcessoLoginModel'); 

        $this->tabela = 'GRUPO';
      
    }

    function dados($dados = array()) {

        $array = array();

        $array['id'] =null;

        $array['nome'] =null;

        $array['admin'] =$this->AcessoLoginModel->verAdmin();

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

        $this->db->insert("GRUPO", $dados);

        return $this->db->insert_id();
    }

    function editar($dados) {

        $dados = array_filter($this->dados($dados));

        $this->db->where('GRUPO.id', $dados['id']);

        $this->db->where('GRUPO.exclusao is null');

        $this->banco->usuario("GRUPO");

        $this->db->update("GRUPO", $dados);
    }

    function listar($maximo = NULL, $inicio = NULL) {

        $this->db->from("GRUPO");

        $this->db->where('GRUPO.exclusao is null');

        $this->banco->usuario("GRUPO");

        $query = $this->db->get("", $maximo, $inicio);
       
        return $query->result_array();
    }

    function filtrar($filtro=array(),$maximo = NULL, $inicio = NULL){

        $filtro=array_filter($this->dados($filtro));

        $this->db->from("GRUPO");

        $this->db->like($filtro);

        $this->db->where('GRUPO.exclusao is null');

        $this->banco->usuario("GRUPO");

        $query = $this->db->get("", $maximo, $inicio);         

        return $query->result_array();

    }

    function ver($id) {

        $this->db->from("GRUPO");

        $this->db->where('GRUPO.id', $id);

        $this->db->where('GRUPO.exclusao is null');

        $this->banco->usuario("GRUPO");

        $query = $this->db->get();

        return $query->row_array();
    }

    function excluir($id) {

        $dados = array();

        $this->db->where('GRUPO.id', $id);

        $this->banco->usuario("GRUPO");

        $dados['exclusao']=date("Y-m-d");

        $this->db->update("GRUPO",$dados);

    }

    function deletar($id) {

        $this->db->where('GRUPO.id', $id);

        $this->db->where('GRUPO.exclusao not null');

        $this->banco->usuario("GRUPO");

        $this->db->delete("GRUPO");

    }

    function contarTotal($filtro=false) {

        $this->db->select('*');

        $this->db->select('GRUPO.id as id');

        $this->db->from("GRUPO");

        $this->db->where('GRUPO.exclusao is null');


        if(!empty($filtro)){

            $filtro = array_filter($filtro);

            $this->db->like($filtro);

        }  

        $this->banco->usuario("GRUPO");

        return $this->db->get()->num_rows();        

    }  
      
  

}