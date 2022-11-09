<?php


class ModuloModel extends CI_Model {
    function __construct() {

        parent::__construct();

        $this->load->model('admin/AcessoLoginModel'); 

        $this->tabela = 'MODULO';
      
    }

    function dados($dados = array()) {

        $array = array();

        $array['id'] =null;

        $array['nome'] =null;

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

        $this->db->insert("MODULO", $dados);

        return $this->db->insert_id();
    }

    function editar($dados) {

        $dados = array_filter($this->dados($dados));

        $this->db->where('MODULO.id', $dados['id']);

        $this->db->where('MODULO.exclusao is null');

        $this->banco->usuario("MODULO");

        $this->db->update("MODULO", $dados);
    }

    function listar($maximo = NULL, $inicio = NULL) {

        $this->db->from("MODULO");

        $this->db->where('MODULO.exclusao is null');

        $this->banco->usuario("MODULO");

        $query = $this->db->get("", $maximo, $inicio);
       
        return $query->result_array();
    }

    function filtrar($filtro=array(),$maximo = NULL, $inicio = NULL){

        $filtro=array_filter($this->dados($filtro));

        $this->db->from("MODULO");

        $this->db->like($filtro);

        $this->db->where('MODULO.exclusao is null');

        $this->banco->usuario("MODULO");

        $query = $this->db->get("", $maximo, $inicio);         

        return $query->result_array();

    }

    function ver($id) {

        $this->db->from("MODULO");

        $this->db->where('MODULO.id', $id);

        $this->db->where('MODULO.exclusao is null');

        $this->banco->usuario("MODULO");

        $query = $this->db->get();

        return $query->row_array();
    }

    function excluir($id) {

        $dados = array();

        $this->db->where('MODULO.id', $id);

        $this->banco->usuario("MODULO");

        $dados['exclusao']=date("Y-m-d");

        $this->db->update("MODULO",$dados);

    }

    function deletar($id) {

        $this->db->where('MODULO.id', $id);

        $this->db->where('MODULO.exclusao not null');

        $this->banco->usuario("MODULO");

        $this->db->delete("MODULO");

    }

    function contarTotal($filtro=false) {

        $this->db->select('*');

        $this->db->select('MODULO.id as id');

        $this->db->from("MODULO");

        $this->db->where('MODULO.exclusao is null');


        if(!empty($filtro)){

            $filtro = array_filter($filtro);

            $this->db->like($filtro);

        }  

        $this->banco->usuario("MODULO");

        return $this->db->get()->num_rows();        

    }  
      
  

}