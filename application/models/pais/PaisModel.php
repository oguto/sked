<?php


class PaisModel extends CI_Model {
    function __construct() {

        parent::__construct();

        $this->load->model('admin/AcessoLoginModel'); 

        $this->tabela = 'PAIS';
      
    }

    function dados($dados = array()) {

        $array = array();

        $array['id'] =null;

        $array['nome'] =null;

        $array['sigla'] =null;

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

        $this->db->insert("PAIS", $dados);

        return $this->db->insert_id();
    }

    function editar($dados) {

        $dados = array_filter($this->dados($dados));

        $this->db->where('PAIS.id', $dados['id']);

        $this->db->where('PAIS.exclusao is null');

        $this->banco->usuario("PAIS");

        $this->db->update("PAIS", $dados);
    }

    function listar($maximo = NULL, $inicio = NULL) {

        $this->db->from("PAIS");

        $this->db->where('PAIS.exclusao is null');

        $this->banco->usuario("PAIS");

        $query = $this->db->get("", $maximo, $inicio);
       
        return $query->result_array();
    }

    function filtrar($filtro=array(),$maximo = NULL, $inicio = NULL){

        $filtro=array_filter($this->dados($filtro));

        $this->db->from("PAIS");

        $this->db->like($filtro);

        $this->db->where('PAIS.exclusao is null');

        $this->banco->usuario("PAIS");

        $query = $this->db->get("", $maximo, $inicio);         

        return $query->result_array();

    }

    function ver($id) {

        $this->db->from("PAIS");

        $this->db->where('PAIS.id', $id);

        $this->db->where('PAIS.exclusao is null');

        $this->banco->usuario("PAIS");

        $query = $this->db->get();

        return $query->row_array();
    }

    function excluir($id) {

        $dados = array();

        $this->db->where('PAIS.id', $id);

        $this->banco->usuario("PAIS");

        $dados['exclusao']=date("Y-m-d");

        $this->db->update("PAIS",$dados);

    }

    function deletar($id) {

        $this->db->where('PAIS.id', $id);

        $this->db->where('PAIS.exclusao not null');

        $this->banco->usuario("PAIS");

        $this->db->delete("PAIS");

    }

    function contarTotal($filtro=false) {

        $this->db->select('*');

        $this->db->select('PAIS.id as id');

        $this->db->from("PAIS");

        $this->db->where('PAIS.exclusao is null');


        if(!empty($filtro)){

            $filtro = array_filter($filtro);

            $this->db->like($filtro);

        }  

        $this->banco->usuario("PAIS");

        return $this->db->get()->num_rows();        

    }  
      
  

}