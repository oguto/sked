<?php


class PlanosModel extends CI_Model {
    function __construct() {

        parent::__construct();

        $this->load->model('admin/AcessoLoginModel'); 

        $this->tabela = 'PLANOS';
      
    }

    function dados($dados = array()) {

        $array = array();

        $array['id'] =null;

        $array['titiulo'] =null;

        $array['descricao'] =null;

        $array['valor'] =null;

        $array['qtd_imagens'] =null;

        $array['qtd_email'] =null;

        $array['qtd_mensagens'] =null;

        $array['exclusao'] =null;

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

        $this->db->insert("PLANOS", $dados);

        return $this->db->insert_id();
    }

    function editar($dados) {

        $dados = array_filter($this->dados($dados));

        $this->db->where('PLANOS.id', $dados['id']);

        $this->db->where('PLANOS.exclusao is null');

        $this->banco->usuario("PLANOS");

        $this->db->update("PLANOS", $dados);
    }

    function listar($maximo = NULL, $inicio = NULL) {

        $this->db->from("PLANOS");

        $this->db->where('PLANOS.exclusao is null');

        $this->banco->usuario("PLANOS");

        $query = $this->db->get("", $maximo, $inicio);
       
        return $query->result_array();
    }

    function filtrar($filtro=array(),$maximo = NULL, $inicio = NULL){

        $filtro=array_filter($this->dados($filtro));

        $this->db->from("PLANOS");

        $this->db->like($filtro);

        $this->db->where('PLANOS.exclusao is null');

        $this->banco->usuario("PLANOS");

        $query = $this->db->get("", $maximo, $inicio);         

        return $query->result_array();

    }

    function ver($id) {

        $this->db->from("PLANOS");

        $this->db->where('PLANOS.id', $id);

        $this->db->where('PLANOS.exclusao is null');

        $this->banco->usuario("PLANOS");

        $query = $this->db->get();

        return $query->row_array();
    }

    function excluir($id) {

        $dados = array();

        $this->db->where('PLANOS.id', $id);

        $this->banco->usuario("PLANOS");

        $dados['exclusao']=date("Y-m-d");

        $this->db->update("PLANOS",$dados);

    }

    function deletar($id) {

        $this->db->where('PLANOS.id', $id);

        $this->db->where('PLANOS.exclusao not null');

        $this->banco->usuario("PLANOS");

        $this->db->delete("PLANOS");

    }

    function contarTotal($filtro=false) {

        $this->db->select('*');

        $this->db->select('PLANOS.id as id');

        $this->db->from("PLANOS");

        $this->db->where('PLANOS.exclusao is null');


        if(!empty($filtro)){

            $filtro = array_filter($filtro);

            $this->db->like($filtro);

        }  

        $this->banco->usuario("PLANOS");

        return $this->db->get()->num_rows();        

    }  
      
  

}