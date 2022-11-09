<?php


class FormaPagmentoModel extends CI_Model {
    function __construct() {

        parent::__construct();

        $this->load->model('admin/AcessoLoginModel'); 

        $this->tabela = 'FORMA_PAGMENTO';
      
    }

    function dados($dados = array()) {

        $array = array();

        $array['id'] =null;

        $array['descricao'] =null;

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

        $this->db->insert("FORMA_PAGMENTO", $dados);

        return $this->db->insert_id();
    }

    function editar($dados) {

        $dados = array_filter($this->dados($dados));

        $this->db->where('FORMA_PAGMENTO.id', $dados['id']);

        $this->db->where('FORMA_PAGMENTO.exclusao is null');

        $this->banco->usuario("FORMA_PAGMENTO");

        $this->db->update("FORMA_PAGMENTO", $dados);
    }

    function listar($maximo = NULL, $inicio = NULL) {

        $this->db->from("FORMA_PAGMENTO");

        $this->db->where('FORMA_PAGMENTO.exclusao is null');

        $this->banco->usuario("FORMA_PAGMENTO");

        $query = $this->db->get("", $maximo, $inicio);
       
        return $query->result_array();
    }

    function filtrar($filtro=array(),$maximo = NULL, $inicio = NULL){

        $filtro=array_filter($this->dados($filtro));

        $this->db->from("FORMA_PAGMENTO");

        $this->db->like($filtro);

        $this->db->where('FORMA_PAGMENTO.exclusao is null');

        $this->banco->usuario("FORMA_PAGMENTO");

        $query = $this->db->get("", $maximo, $inicio);         

        return $query->result_array();

    }

    function ver($id) {

        $this->db->from("FORMA_PAGMENTO");

        $this->db->where('FORMA_PAGMENTO.id', $id);

        $this->db->where('FORMA_PAGMENTO.exclusao is null');

        $this->banco->usuario("FORMA_PAGMENTO");

        $query = $this->db->get();

        return $query->row_array();
    }

    function excluir($id) {

        $dados = array();

        $this->db->where('FORMA_PAGMENTO.id', $id);

        $this->banco->usuario("FORMA_PAGMENTO");

        $dados['exclusao']=date("Y-m-d");

        $this->db->update("FORMA_PAGMENTO",$dados);

    }

    function deletar($id) {

        $this->db->where('FORMA_PAGMENTO.id', $id);

        $this->db->where('FORMA_PAGMENTO.exclusao not null');

        $this->banco->usuario("FORMA_PAGMENTO");

        $this->db->delete("FORMA_PAGMENTO");

    }

    function contarTotal($filtro=false) {

        $this->db->select('*');

        $this->db->select('FORMA_PAGMENTO.id as id');

        $this->db->from("FORMA_PAGMENTO");

        $this->db->where('FORMA_PAGMENTO.exclusao is null');


        if(!empty($filtro)){

            $filtro = array_filter($filtro);

            $this->db->like($filtro);

        }  

        $this->banco->usuario("FORMA_PAGMENTO");

        return $this->db->get()->num_rows();        

    }  
      
  

}