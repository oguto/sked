<?php


class ComboDiaModel extends CI_Model {
    function __construct() {

        parent::__construct();

        $this->load->model('admin/AcessoLoginModel'); 

        $this->tabela = 'COMBO_DIA';
      
    }

    function dados($dados = array()) {

        $array = array();

        $array['id'] =null;

        $array['dia'] =null;

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

        $this->db->insert("COMBO_DIA", $dados);

        return $this->db->insert_id();
    }

    function editar($dados) {

        $dados = array_filter($this->dados($dados));

        $this->db->where('COMBO_DIA.id', $dados['id']);

        $this->db->where('COMBO_DIA.exclusao is null');

        $this->banco->usuario("COMBO_DIA");

        $this->db->update("COMBO_DIA", $dados);
    }

    function listar($maximo = NULL, $inicio = NULL) {

        $this->db->from("COMBO_DIA");

        $this->db->where('COMBO_DIA.exclusao is null');

        $this->banco->usuario("COMBO_DIA");

        $query = $this->db->get("", $maximo, $inicio);
       
        return $query->result_array();
    }

    function filtrar($filtro=array(),$maximo = NULL, $inicio = NULL){

        $filtro=array_filter($this->dados($filtro));

        $this->db->from("COMBO_DIA");

        $this->db->like($filtro);

        $this->db->where('COMBO_DIA.exclusao is null');

        $this->banco->usuario("COMBO_DIA");

        $query = $this->db->get("", $maximo, $inicio);         

        return $query->result_array();

    }

    function ver($id) {

        $this->db->from("COMBO_DIA");

        $this->db->where('COMBO_DIA.id', $id);

        $this->db->where('COMBO_DIA.exclusao is null');

        $this->banco->usuario("COMBO_DIA");

        $query = $this->db->get();

        return $query->row_array();
    }

    function excluir($id) {

        $dados = array();

        $this->db->where('COMBO_DIA.id', $id);

        $this->banco->usuario("COMBO_DIA");

        $dados['exclusao']=date("Y-m-d");

        $this->db->update("COMBO_DIA",$dados);

    }

    function deletar($id) {

        $this->db->where('COMBO_DIA.id', $id);

        $this->db->where('COMBO_DIA.exclusao not null');

        $this->banco->usuario("COMBO_DIA");

        $this->db->delete("COMBO_DIA");

    }

    function contarTotal($filtro=false) {

        $this->db->select('*');

        $this->db->select('COMBO_DIA.id as id');

        $this->db->from("COMBO_DIA");

        $this->db->where('COMBO_DIA.exclusao is null');


        if(!empty($filtro)){

            $filtro = array_filter($filtro);

            $this->db->like($filtro);

        }  

        $this->banco->usuario("COMBO_DIA");

        return $this->db->get()->num_rows();        

    }  
      
  

}