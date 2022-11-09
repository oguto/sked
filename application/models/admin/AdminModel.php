<?php


class AdminModel extends CI_Model {
    function __construct() {

        parent::__construct();

        $this->load->model('admin/AcessoLoginModel');

        $this->tabela = 'ADMIN';

    }

    function dados($dados = array()) {

        $array = array();

        $array['id'] =null;

        $array['email'] =null;

        $array['nome'] =null;

        $array['senha'] =null;

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

        $dados['data'] =date("Y-m-d");

        $this->db->insert("ADMIN", $dados);

        return $this->db->insert_id();
    }

    function editar($dados) {

        $dados = array_filter($this->dados($dados));

        $this->db->where('ADMIN.id', $dados['id']);

        $this->db->where('ADMIN.exclusao is null');

        $this->banco->usuario("ADMIN");

        $this->db->update("ADMIN", $dados);
    }

    function listar($maximo = NULL, $inicio = NULL) {

        $this->db->from("ADMIN");

        $this->db->where('ADMIN.exclusao is null');

        $this->banco->usuario("ADMIN");

        $query = $this->db->get("", $maximo, $inicio);

        return $query->result_array();
    }

    function filtrar($filtro=array(),$maximo = NULL, $inicio = NULL){

        $filtro=array_filter($this->dados($filtro));

        $this->db->from("ADMIN");

        $this->db->like($filtro);

        $this->db->where('ADMIN.exclusao is null');

        $this->banco->usuario("ADMIN");

        $query = $this->db->get("", $maximo, $inicio);

        return $query->result_array();

    }

    function ver($id) {

        $this->db->from("ADMIN");

        $this->db->where('ADMIN.id', $id);

        $this->db->where('ADMIN.exclusao is null');

        $this->banco->usuario("ADMIN");

        $query = $this->db->get();

        return $query->row_array();
    }

    function excluir($id) {

        $dados = array();

        $this->db->where('ADMIN.id', $id);

        $this->banco->usuario("ADMIN");

        $dados['exclusao']=date("Y-m-d");

        $this->db->update("ADMIN",$dados);

    }

    function deletar($id) {

        $this->db->where('ADMIN.id', $id);

        $this->db->where('ADMIN.exclusao not null');

        $this->banco->usuario("ADMIN");

        $this->db->delete("ADMIN");

    }

    function contarTotal($filtro=false) {

        $this->db->select('*');

        $this->db->select('ADMIN.id as id');

        $this->db->from("ADMIN");

        $this->db->where('ADMIN.exclusao is null');


        if(!empty($filtro)){

            $filtro = array_filter($filtro);

            $this->db->like($filtro);

        }

        $this->banco->usuario("ADMIN");

        return $this->db->get()->num_rows();

    }



}
