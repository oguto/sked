<?php


class EnderecoModel extends CI_Model {
    function __construct() {

        parent::__construct();

        $this->load->model('admin/AcessoLoginModel'); 

        $this->tabela = 'ENDERECO';
      
    }

    function dados($dados = array()) {

        $array = array();

        $array['id'] =null;

        $array['cep'] =null;

        $array['estado'] =null;

        $array['cidade'] =null;

        $array['data'] =null;

        $array['bairro'] =null;

        $array['complemento'] =null;

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

        $this->db->insert("ENDERECO", $dados);

        return $this->db->insert_id();
    }

    function editar($dados) {

        $dados = array_filter($this->dados($dados));

        $this->db->where('ENDERECO.id', $dados['id']);

        $this->db->where('ENDERECO.exclusao is null');

        $this->banco->usuario("ENDERECO");

        $this->db->update("ENDERECO", $dados);
    }

    function listar($maximo = NULL, $inicio = NULL) {

        $this->db->from("ENDERECO");

        $this->db->where('ENDERECO.exclusao is null');

        $this->banco->usuario("ENDERECO");

        $query = $this->db->get("", $maximo, $inicio);
       
        return $query->result_array();
    }

    function filtrar($filtro=array(),$maximo = NULL, $inicio = NULL){

        $filtro=array_filter($this->dados($filtro));

        $this->db->from("ENDERECO");

        $this->db->like($filtro);

        $this->db->where('ENDERECO.exclusao is null');

        $this->banco->usuario("ENDERECO");

        $query = $this->db->get("", $maximo, $inicio);         

        return $query->result_array();

    }

    function ver($id) {

        $this->db->from("ENDERECO");

        $this->db->where('ENDERECO.id', $id);

        $this->db->where('ENDERECO.exclusao is null');

        $this->banco->usuario("ENDERECO");

        $query = $this->db->get();

        return $query->row_array();
    }

    function excluir($id) {

        $dados = array();

        $this->db->where('ENDERECO.id', $id);

        $this->banco->usuario("ENDERECO");

        $dados['exclusao']=date("Y-m-d");

        $this->db->update("ENDERECO",$dados);

    }

    function deletar($id) {

        $this->db->where('ENDERECO.id', $id);

        $this->db->where('ENDERECO.exclusao not null');

        $this->banco->usuario("ENDERECO");

        $this->db->delete("ENDERECO");

    }

    function contarTotal($filtro=false) {

        $this->db->select('*');

        $this->db->select('ENDERECO.id as id');

        $this->db->from("ENDERECO");

        $this->db->where('ENDERECO.exclusao is null');


        if(!empty($filtro)){

            $filtro = array_filter($filtro);

            $this->db->like($filtro);

        }  

        $this->banco->usuario("ENDERECO");

        return $this->db->get()->num_rows();        

    }  
      
  

}