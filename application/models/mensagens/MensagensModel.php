<?php


class MensagensModel extends CI_Model {
    function __construct() {

        parent::__construct();

        $this->load->model('admin/AcessoLoginModel'); 

        $this->tabela = 'MENSAGENS';
      
    }

    function dados($dados = array()) {

        $array = array();

        $array['id'] =null;

        $array['titulo'] =null;

        $array['descricao'] =null;

        $array['id_personal'] =null;

        $array['data'] =null;

        $array['id_aluno'] =null;

        $array['id_mensagem'] =null;

        $array['status_remetente'] =null;

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

        $this->db->insert("MENSAGENS", $dados);

        return $this->db->insert_id();
    }

    function editar($dados) {

        $dados = array_filter($this->dados($dados));

        $this->db->where('MENSAGENS.id', $dados['id']);

        $this->db->where('MENSAGENS.exclusao is null');

        $this->banco->usuario("MENSAGENS");

        $this->db->update("MENSAGENS", $dados);
    }

    function listar($maximo = NULL, $inicio = NULL) {

        $this->db->from("MENSAGENS");

        $this->db->where('MENSAGENS.exclusao is null');

        $this->banco->usuario("MENSAGENS");

        $query = $this->db->get("", $maximo, $inicio);
       
        return $query->result_array();
    }

    function filtrar($filtro=array(),$maximo = NULL, $inicio = NULL){

        $filtro=array_filter($this->dados($filtro));

        $this->db->from("MENSAGENS");

        $this->db->like($filtro);

        $this->db->where('MENSAGENS.exclusao is null');

        $this->banco->usuario("MENSAGENS");

        $query = $this->db->get("", $maximo, $inicio);         

        return $query->result_array();

    }

    function ver($id) {

        $this->db->from("MENSAGENS");

        $this->db->where('MENSAGENS.id', $id);

        $this->db->where('MENSAGENS.exclusao is null');

        $this->banco->usuario("MENSAGENS");

        $query = $this->db->get();

        return $query->row_array();
    }

    function excluir($id) {

        $dados = array();

        $this->db->where('MENSAGENS.id', $id);

        $this->banco->usuario("MENSAGENS");

        $dados['exclusao']=date("Y-m-d");

        $this->db->update("MENSAGENS",$dados);

    }

    function deletar($id) {

        $this->db->where('MENSAGENS.id', $id);

        $this->db->where('MENSAGENS.exclusao not null');

        $this->banco->usuario("MENSAGENS");

        $this->db->delete("MENSAGENS");

    }

    function contarTotal($filtro=false) {

        $this->db->select('*');

        $this->db->select('MENSAGENS.id as id');

        $this->db->from("MENSAGENS");

        $this->db->where('MENSAGENS.exclusao is null');


        if(!empty($filtro)){

            $filtro = array_filter($filtro);

            $this->db->like($filtro);

        }  

        $this->banco->usuario("MENSAGENS");

        return $this->db->get()->num_rows();        

    }  
      
  

}