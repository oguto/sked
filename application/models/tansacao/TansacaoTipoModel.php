<?php


class TansacaoTipoModel extends CI_Model {
    function __construct() {

        parent::__construct();

        $this->load->model('admin/AcessoLoginModel');

        $this->tabela = 'TANSACAO_TIPO';

    }

    function dados($dados = array()) {

        $array = array();

        $array['id'] =null;

        $array['nome'] =null;

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

        $this->db->insert("TANSACAO_TIPO", $dados);

        return $this->db->insert_id();
    }

    function editar($dados) {

        $dados = array_filter($this->dados($dados));

        $this->db->where('TANSACAO_TIPO.id', $dados['id']);

        $this->db->where('TANSACAO_TIPO.exclusao is null');

        $this->banco->usuario("TANSACAO_TIPO");

        $this->db->update("TANSACAO_TIPO", $dados);
    }

    function listar($maximo = NULL, $inicio = NULL) {

        $this->db->from("TANSACAO_TIPO");

        $this->db->where('TANSACAO_TIPO.exclusao is null');

        $this->banco->usuario("TANSACAO_TIPO");

        $query = $this->db->get("", $maximo, $inicio);

        return $query->result_array();
    }

    function filtrar($filtro=array(),$maximo = NULL, $inicio = NULL){

        $filtro=array_filter($this->dados($filtro));

        $this->db->from("TANSACAO_TIPO");

        $this->db->like($filtro);

        $this->db->where('TANSACAO_TIPO.exclusao is null');

        $this->banco->usuario("TANSACAO_TIPO");

        $query = $this->db->get("", $maximo, $inicio);

        return $query->result_array();

    }

    function ver($id) {

        $this->db->from("TANSACAO_TIPO");

        $this->db->where('TANSACAO_TIPO.id', $id);

        $this->db->where('TANSACAO_TIPO.exclusao is null');

        $this->banco->usuario("TANSACAO_TIPO");

        $query = $this->db->get();

        return $query->row_array();
    }

    function excluir($id) {

        $dados = array();

        $this->db->where('TANSACAO_TIPO.id', $id);

        $this->banco->usuario("TANSACAO_TIPO");

        $dados['exclusao']=date("Y-m-d");

        $this->db->update("TANSACAO_TIPO",$dados);

    }

    function deletar($id) {

        $this->db->where('TANSACAO_TIPO.id', $id);

        $this->db->where('TANSACAO_TIPO.exclusao not null');

        $this->banco->usuario("TANSACAO_TIPO");

        $this->db->delete("TANSACAO_TIPO");

    }

    function contarTotal($filtro=false) {

        $this->db->select('*');

        $this->db->select('TANSACAO_TIPO.id as id');

        $this->db->from("TANSACAO_TIPO");

        $this->db->where('TANSACAO_TIPO.exclusao is null');


        if(!empty($filtro)){

            $filtro = array_filter($filtro);

            $this->db->like($filtro);

        }

        $this->banco->usuario("TANSACAO_TIPO");

        return $this->db->get()->num_rows();

    }



}
