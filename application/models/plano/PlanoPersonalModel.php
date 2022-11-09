<?php


class PlanoPersonalModel extends CI_Model {
    function __construct() {

        parent::__construct();

        $this->load->model('admin/AcessoLoginModel'); 

        $this->tabela = 'PLANO_PERSONAL';
      
    }

    function dados($dados = array()) {

        $array = array();

        $array['id'] =null;

        $array['id_personal'] =null;

        $array['vencimento'] =null;

        $array['id_plano'] =null;

        $array['valor'] =null;

        $array['id_status'] =null;

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

        $this->db->insert("PLANO_PERSONAL", $dados);

        return $this->db->insert_id();
    }

    function editar($dados) {

        $dados = array_filter($this->dados($dados));

        $this->db->where('PLANO_PERSONAL.id', $dados['id']);

        $this->db->where('PLANO_PERSONAL.exclusao is null');

        $this->banco->usuario("PLANO_PERSONAL");

        $this->db->update("PLANO_PERSONAL", $dados);
    }

    function listar($maximo = NULL, $inicio = NULL) {

        $this->db->from("PLANO_PERSONAL");

        $this->db->where('PLANO_PERSONAL.exclusao is null');

        $this->banco->usuario("PLANO_PERSONAL");

        $query = $this->db->get("", $maximo, $inicio);
       
        return $query->result_array();
    }

    function filtrar($filtro=array(),$maximo = NULL, $inicio = NULL){

        $filtro=array_filter($this->dados($filtro));

        $this->db->from("PLANO_PERSONAL");

        $this->db->like($filtro);

        $this->db->where('PLANO_PERSONAL.exclusao is null');

        $this->banco->usuario("PLANO_PERSONAL");

        $query = $this->db->get("", $maximo, $inicio);         

        return $query->result_array();

    }

    function ver($id) {

        $this->db->from("PLANO_PERSONAL");

        $this->db->where('PLANO_PERSONAL.id', $id);

        $this->db->where('PLANO_PERSONAL.exclusao is null');

        $this->banco->usuario("PLANO_PERSONAL");

        $query = $this->db->get();

        return $query->row_array();
    }

    function excluir($id) {

        $dados = array();

        $this->db->where('PLANO_PERSONAL.id', $id);

        $this->banco->usuario("PLANO_PERSONAL");

        $dados['exclusao']=date("Y-m-d");

        $this->db->update("PLANO_PERSONAL",$dados);

    }

    function deletar($id) {

        $this->db->where('PLANO_PERSONAL.id', $id);

        $this->db->where('PLANO_PERSONAL.exclusao not null');

        $this->banco->usuario("PLANO_PERSONAL");

        $this->db->delete("PLANO_PERSONAL");

    }

    function contarTotal($filtro=false) {

        $this->db->select('*');

        $this->db->select('PLANO_PERSONAL.id as id');

        $this->db->from("PLANO_PERSONAL");

        $this->db->where('PLANO_PERSONAL.exclusao is null');


        if(!empty($filtro)){

            $filtro = array_filter($filtro);

            $this->db->like($filtro);

        }  

        $this->banco->usuario("PLANO_PERSONAL");

        return $this->db->get()->num_rows();        

    }  
      
  

}