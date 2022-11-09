<?php


class AlunoPersonalModel extends CI_Model {
    function __construct() {

        parent::__construct();

        $this->load->model('admin/AcessoLoginModel'); 

        $this->tabela = 'ALUNO_PERSONAL';
      
    }

    function dados($dados = array()) {

        $array = array();

        $array['id'] =null;

        $array['id_aluno'] =null;

        $array['id_personal'] =null;

        $array['id_indicado'] =null;

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

        $this->db->insert("ALUNO_PERSONAL", $dados);

        return $this->db->insert_id();
    }

    function editar($dados) {

        $dados = array_filter($this->dados($dados));

        $this->db->where('ALUNO_PERSONAL.id', $dados['id']);

        $this->db->where('ALUNO_PERSONAL.exclusao is null');

        $this->banco->usuario("ALUNO_PERSONAL");

        $this->db->update("ALUNO_PERSONAL", $dados);
    }

    function listar($maximo = NULL, $inicio = NULL) {

        $this->db->from("ALUNO_PERSONAL");

        $this->db->where('ALUNO_PERSONAL.exclusao is null');

        $this->banco->usuario("ALUNO_PERSONAL");

        $query = $this->db->get("", $maximo, $inicio);
       
        return $query->result_array();
    }

    function filtrar($filtro=array(),$maximo = NULL, $inicio = NULL){

        $filtro=array_filter($this->dados($filtro));

        $this->db->from("ALUNO_PERSONAL");

        $this->db->like($filtro);

        $this->db->where('ALUNO_PERSONAL.exclusao is null');

        $this->banco->usuario("ALUNO_PERSONAL");

        $query = $this->db->get("", $maximo, $inicio);         

        return $query->result_array();

    }

    function ver($id) {

        $this->db->from("ALUNO_PERSONAL");

        $this->db->where('ALUNO_PERSONAL.id', $id);

        $this->db->where('ALUNO_PERSONAL.exclusao is null');

        $this->banco->usuario("ALUNO_PERSONAL");

        $query = $this->db->get();

        return $query->row_array();
    }

    function excluir($id) {

        $dados = array();

        $this->db->where('ALUNO_PERSONAL.id', $id);

        $this->banco->usuario("ALUNO_PERSONAL");

        $dados['exclusao']=date("Y-m-d");

        $this->db->update("ALUNO_PERSONAL",$dados);

    }

    function deletar($id) {

        $this->db->where('ALUNO_PERSONAL.id', $id);

        $this->db->where('ALUNO_PERSONAL.exclusao not null');

        $this->banco->usuario("ALUNO_PERSONAL");

        $this->db->delete("ALUNO_PERSONAL");

    }

    function contarTotal($filtro=false) {

        $this->db->select('*');

        $this->db->select('ALUNO_PERSONAL.id as id');

        $this->db->from("ALUNO_PERSONAL");

        $this->db->where('ALUNO_PERSONAL.exclusao is null');


        if(!empty($filtro)){

            $filtro = array_filter($filtro);

            $this->db->like($filtro);

        }  

        $this->banco->usuario("ALUNO_PERSONAL");

        return $this->db->get()->num_rows();        

    }  
      
  

}