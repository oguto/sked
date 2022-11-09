<?php


class AlunoModel extends CI_Model {
    function __construct() {

        parent::__construct();

        $this->load->model('admin/AcessoLoginModel'); 

        $this->tabela = 'ALUNO';
      
    }

    function dados($dados = array()) {

        $array = array();

        $array['id'] =null;

        $array['nome'] =null;

        $array['foto'] =null;

        $array['nascimento'] =null;

        $array['cpf'] =null;

        $array['senha'] =null;

        $array['endereco'] =null;

        $array['cep'] =null;

        $array['tel'] =null;

        $array['cel'] =null;

        $array['email'] =null;

        $array['id_status'] =null;

        $array['data'] =null;

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

        $this->db->insert("ALUNO", $dados);

        return $this->db->insert_id();
    }

    function editar($dados) {

        $dados = array_filter($this->dados($dados));

        $this->db->where('ALUNO.id', $dados['id']);

        $this->db->where('ALUNO.exclusao is null');

        $this->banco->usuario("ALUNO");

        $this->db->update("ALUNO", $dados);
    }

    function listar($maximo = NULL, $inicio = NULL) {

        $this->db->from("ALUNO");

        $this->db->where('ALUNO.exclusao is null');

        $this->banco->usuario("ALUNO");

        $query = $this->db->get("", $maximo, $inicio);
       
        return $query->result_array();
    }

    function filtrar($filtro=array(),$maximo = NULL, $inicio = NULL){

        $filtro=array_filter($this->dados($filtro));

        $this->db->from("ALUNO");

        $this->db->like($filtro);

        $this->db->where('ALUNO.exclusao is null');

        $this->banco->usuario("ALUNO");

        $query = $this->db->get("", $maximo, $inicio);         

        return $query->result_array();

    }

    function ver($id) {

        $this->db->from("ALUNO");

        $this->db->where('ALUNO.id', $id);

        $this->db->where('ALUNO.exclusao is null');

        $this->banco->usuario("ALUNO");

        $query = $this->db->get();

        return $query->row_array();
    }

    function excluir($id) {

        $dados = array();

        $this->db->where('ALUNO.id', $id);

        $this->banco->usuario("ALUNO");

        $dados['exclusao']=date("Y-m-d");

        $this->db->update("ALUNO",$dados);

    }

    function deletar($id) {

        $this->db->where('ALUNO.id', $id);

        $this->db->where('ALUNO.exclusao not null');

        $this->banco->usuario("ALUNO");

        $this->db->delete("ALUNO");

    }

    function contarTotal($filtro=false) {

        $this->db->select('*');

        $this->db->select('ALUNO.id as id');

        $this->db->from("ALUNO");

        $this->db->where('ALUNO.exclusao is null');


        if(!empty($filtro)){

            $filtro = array_filter($filtro);

            $this->db->like($filtro);

        }  

        $this->banco->usuario("ALUNO");

        return $this->db->get()->num_rows();        

    }  
      
  

}