<?php


class PersonalModel extends CI_Model {
    function __construct() {

        parent::__construct();

        $this->load->model('admin/AcessoLoginModel'); 

        $this->tabela = 'PERSONAL';
      
    }

    function dados($dados = array()) {

        $array = array();

        $array['id'] =null;

        $array['tipo'] =null;

        $array['nome'] =null;

        $array['foto'] =null;

        $array['nascimento'] =null;

        $array['rg'] =null;

        $array['cpf'] =null;

        $array['endereco'] =null;

        $array['cep'] =null;

        $array['horas_abertura'] =null;

        $array['horas_fechamento'] =null;

        $array['tel'] =null;

        $array['cel'] =null;

        $array['email'] =null;

        $array['descricao'] =null;

        $array['senha'] =null;

        $array['data'] =null;

        $array['admin'] =$this->AcessoLoginModel->verAdmin();

        $array['id_status'] =null;

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

        $this->db->insert("PERSONAL", $dados);

        return $this->db->insert_id();
    }

    function editar($dados) {

        $dados = array_filter($this->dados($dados));

        $this->db->where('PERSONAL.id', $dados['id']);

        $this->db->where('PERSONAL.exclusao is null');

        $this->banco->usuario("PERSONAL");

        $this->db->update("PERSONAL", $dados);
    }

    function listar($maximo = NULL, $inicio = NULL) {

        $this->db->from("PERSONAL");

        $this->db->where('PERSONAL.exclusao is null');

        $this->banco->usuario("PERSONAL");

        $query = $this->db->get("", $maximo, $inicio);
       
        return $query->result_array();
    }

    function filtrar($filtro=array(),$maximo = NULL, $inicio = NULL){

        $filtro=array_filter($this->dados($filtro));

        $this->db->from("PERSONAL");

        $this->db->like($filtro);

        $this->db->where('PERSONAL.exclusao is null');

        $this->banco->usuario("PERSONAL");

        $query = $this->db->get("", $maximo, $inicio);         

        return $query->result_array();

    }

    function ver($id) {

        $this->db->from("PERSONAL");

        $this->db->where('PERSONAL.id', $id);

        $this->db->where('PERSONAL.exclusao is null');

        $this->banco->usuario("PERSONAL");

        $query = $this->db->get();

        return $query->row_array();
    }

    function excluir($id) {

        $dados = array();

        $this->db->where('PERSONAL.id', $id);

        $this->banco->usuario("PERSONAL");

        $dados['exclusao']=date("Y-m-d");

        $this->db->update("PERSONAL",$dados);

    }

    function deletar($id) {

        $this->db->where('PERSONAL.id', $id);

        $this->db->where('PERSONAL.exclusao not null');

        $this->banco->usuario("PERSONAL");

        $this->db->delete("PERSONAL");

    }

    function contarTotal($filtro=false) {

        $this->db->select('*');

        $this->db->select('PERSONAL.id as id');

        $this->db->from("PERSONAL");

        $this->db->where('PERSONAL.exclusao is null');


        if(!empty($filtro)){

            $filtro = array_filter($filtro);

            $this->db->like($filtro);

        }  

        $this->banco->usuario("PERSONAL");

        return $this->db->get()->num_rows();        

    }  
      
  

}