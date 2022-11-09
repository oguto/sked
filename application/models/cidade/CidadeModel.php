<?php


class CidadeModel extends CI_Model {
    function __construct() {

        parent::__construct();

        $this->load->model('admin/AcessoLoginModel'); 

        $this->tabela = 'CIDADE';
      
    }

    function dados($dados = array()) {

        $array = array();

        $array['id'] =null;

        $array['nome'] =null;

        $array['estado'] =null;

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

        $this->db->insert("CIDADE", $dados);

        return $this->db->insert_id();
    }

    function editar($dados) {

        $dados = array_filter($this->dados($dados));

        $this->db->where('CIDADE.id', $dados['id']);

        $this->db->where('CIDADE.exclusao is null');

        $this->banco->usuario("CIDADE");

        $this->db->update("CIDADE", $dados);
    }

    function listar($maximo = NULL, $inicio = NULL) {

        $this->db->from("CIDADE");

        $this->db->where('CIDADE.exclusao is null');

        $this->banco->usuario("CIDADE");

        $query = $this->db->get("", $maximo, $inicio);
       
        return $query->result_array();
    }

    function filtrar($filtro=array(),$maximo = NULL, $inicio = NULL){

        $filtro=array_filter($this->dados($filtro));

        $this->db->from("CIDADE");

        $this->db->like($filtro);

        $this->db->where('CIDADE.exclusao is null');

        $this->banco->usuario("CIDADE");

        $query = $this->db->get("", $maximo, $inicio);         

        return $query->result_array();

    }

    function ver($id) {

        $this->db->from("CIDADE");

        $this->db->where('CIDADE.id', $id);

        $this->db->where('CIDADE.exclusao is null');

        $this->banco->usuario("CIDADE");

        $query = $this->db->get();

        return $query->row_array();
    }

    function excluir($id) {

        $dados = array();

        $this->db->where('CIDADE.id', $id);

        $this->banco->usuario("CIDADE");

        $dados['exclusao']=date("Y-m-d");

        $this->db->update("CIDADE",$dados);

    }

    function deletar($id) {

        $this->db->where('CIDADE.id', $id);

        $this->db->where('CIDADE.exclusao not null');

        $this->banco->usuario("CIDADE");

        $this->db->delete("CIDADE");

    }

    function contarTotal($filtro=false) {

        $this->db->select('*');

        $this->db->select('CIDADE.id as id');

        $this->db->from("CIDADE");

        $this->db->where('CIDADE.exclusao is null');


        if(!empty($filtro)){

            $filtro = array_filter($filtro);

            $this->db->like($filtro);

        }  

        $this->banco->usuario("CIDADE");

        return $this->db->get()->num_rows();        

    }  
      
  

}