<?php


class StatusModel extends CI_Model {
    function __construct() {

        parent::__construct();

        $this->load->model('admin/AcessoLoginModel'); 

        $this->tabela = 'STATUS';
      
    }

    function dados($dados = array()) {

        $array = array();

        $array['id'] =null;

        $array['descricao'] =null;

        $array['id_modulo'] =null;

        $array['id_status'] =null;

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

        $this->db->insert("STATUS", $dados);

        return $this->db->insert_id();
    }

    function editar($dados) {

        $dados = array_filter($this->dados($dados));

        $this->db->where('STATUS.id', $dados['id']);

        $this->db->where('STATUS.exclusao is null');

        $this->banco->usuario("STATUS");

        $this->db->update("STATUS", $dados);
    }

    function listar($maximo = NULL, $inicio = NULL) {

        $this->db->from("STATUS");

        $this->db->where('STATUS.exclusao is null');

        $this->banco->usuario("STATUS");

        $query = $this->db->get("", $maximo, $inicio);
       
        return $query->result_array();
    }

    function filtrar($filtro=array(),$maximo = NULL, $inicio = NULL){

        $filtro=array_filter($this->dados($filtro));

        $this->db->from("STATUS");

        $this->db->like($filtro);

        $this->db->where('STATUS.exclusao is null');

        $this->banco->usuario("STATUS");

        $query = $this->db->get("", $maximo, $inicio);         

        return $query->result_array();

    }

    function ver($id) {

        $this->db->from("STATUS");

        $this->db->where('STATUS.id', $id);

        $this->db->where('STATUS.exclusao is null');

        $this->banco->usuario("STATUS");

        $query = $this->db->get();

        return $query->row_array();
    }

    function excluir($id) {

        $dados = array();

        $this->db->where('STATUS.id', $id);

        $this->banco->usuario("STATUS");

        $dados['exclusao']=date("Y-m-d");

        $this->db->update("STATUS",$dados);

    }

    function deletar($id) {

        $this->db->where('STATUS.id', $id);

        $this->db->where('STATUS.exclusao not null');

        $this->banco->usuario("STATUS");

        $this->db->delete("STATUS");

    }

    function contarTotal($filtro=false) {

        $this->db->select('*');

        $this->db->select('STATUS.id as id');

        $this->db->from("STATUS");

        $this->db->where('STATUS.exclusao is null');


        if(!empty($filtro)){

            $filtro = array_filter($filtro);

            $this->db->like($filtro);

        }  

        $this->banco->usuario("STATUS");

        return $this->db->get()->num_rows();        

    }  
      
  

}