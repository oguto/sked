<?php


class ControleAcessoModel extends CI_Model {
    function __construct() {

        parent::__construct();

        $this->load->model('admin/AcessoLoginModel');

        $this->tabela = 'CONTROLE_ACESSO';

    }

    function dados($dados = array()) {

        $array = array();

        $array['id'] =null;

        $array['modulo'] =null;

        $array['geral'] =null;

        $array['editar'] =null;

        $array['visualizar'] =null;

        $array['incluir'] =null;

        $array['excluir'] =null;

        $array['id_usuario'] =null;

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

        $this->db->insert("CONTROLE_ACESSO", $dados);

        return $this->db->insert_id();
    }

    function editar($dados) {

        $dados = array_filter($this->dados($dados));

        $this->db->where('CONTROLE_ACESSO.id', $dados['id']);

        $this->db->where('CONTROLE_ACESSO.exclusao is null');

        $this->banco->usuario("CONTROLE_ACESSO");

        $this->db->update("CONTROLE_ACESSO", $dados);
    }

    function listar($maximo = NULL, $inicio = NULL) {

        $this->db->from("CONTROLE_ACESSO");

        $this->db->where('CONTROLE_ACESSO.exclusao is null');

        $this->banco->usuario("CONTROLE_ACESSO");

        $query = $this->db->get("", $maximo, $inicio);

        return $query->result_array();
    }

    function filtrar($filtro=array(),$maximo = NULL, $inicio = NULL){

        $filtro=array_filter($this->dados($filtro));

        $this->db->from("CONTROLE_ACESSO");

        $this->db->like($filtro);

        $this->db->where('CONTROLE_ACESSO.exclusao is null');

        $this->banco->usuario("CONTROLE_ACESSO");

        $query = $this->db->get("", $maximo, $inicio);

        return $query->result_array();

    }

    function ver($id) {

        $this->db->from("CONTROLE_ACESSO");

        $this->db->where('CONTROLE_ACESSO.id', $id);

        $this->db->where('CONTROLE_ACESSO.exclusao is null');

        $this->banco->usuario("CONTROLE_ACESSO");

        $query = $this->db->get();

        return $query->row_array();
    }

    function excluir($id) {

        $dados = array();

        $this->db->where('CONTROLE_ACESSO.id', $id);

        $this->banco->usuario("CONTROLE_ACESSO");

        $dados['exclusao']=date("Y-m-d");

        $this->db->update("CONTROLE_ACESSO",$dados);

    }

    function deletar($id) {

        $this->db->where('CONTROLE_ACESSO.id', $id);

        $this->db->where('CONTROLE_ACESSO.exclusao not null');

        $this->banco->usuario("CONTROLE_ACESSO");

        $this->db->delete("CONTROLE_ACESSO");

    }

    function contarTotal($filtro=false) {

        $this->db->select('*');

        $this->db->select('CONTROLE_ACESSO.id as id');

        $this->db->from("CONTROLE_ACESSO");

        $this->db->where('CONTROLE_ACESSO.exclusao is null');


        if(!empty($filtro)){

            $filtro = array_filter($filtro);

            $this->db->like($filtro);

        }

        $this->banco->usuario("CONTROLE_ACESSO");

        return $this->db->get()->num_rows();

    }



}
