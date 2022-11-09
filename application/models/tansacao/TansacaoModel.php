<?php


class TansacaoModel extends CI_Model {
    function __construct() {

        parent::__construct();

        $this->load->model('admin/AcessoLoginModel');

        $this->tabela = 'TANSACAO';

    }

    function dados($dados = array()) {

        $array = array();

        $array['id'] =null;

        $array['descricao'] =null;

        $array['id_tipo'] =null;

        $array['valor'] =null;

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


    function dadosFiltro($dados = array()) {

        $array = array();

        $array['id'] =null;

        $array['descricao'] =null;

        $array['id_tipo'] =null;

        $array['valor'] =null;

        $array['data'] =null;

        $array['filtro_de'] =null;

        $array['filtro_ate'] =null;

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

        $this->db->insert("TANSACAO", $dados);

        return $this->db->insert_id();
    }

    function editar($dados) {

        $dados = array_filter($this->dados($dados));

        $this->db->where('TANSACAO.id', $dados['id']);

        $this->db->where('TANSACAO.exclusao is null');

        $this->banco->usuario("TANSACAO");

        $this->db->update("TANSACAO", $dados);
    }

    function listar($maximo = NULL, $inicio = NULL) {

        $this->db->from("TANSACAO");

        $this->db->where('TANSACAO.exclusao is null');

        $this->banco->usuario("TANSACAO");

        $query = $this->db->get("", $maximo, $inicio);

        return $query->result_array();
    }

    function filtrar($filtro=array(),$maximo = NULL, $inicio = NULL){

      if(!empty($filtro['filtro_de'])){

          $this->db->where('TANSACAO.data>=',$filtro['filtro_de']);


      }

       if(!empty($filtro['filtro_ate'])){

          $this->db->where('TANSACAO.data<=',$filtro['filtro_ate']);

      }

        $filtro=array_filter($this->dados($filtro));

        $this->db->from("TANSACAO");

        $this->db->like($filtro);

        $this->db->where('TANSACAO.exclusao is null');

        $this->banco->usuario("TANSACAO");

        $query = $this->db->get("", $maximo, $inicio);

        return $query->result_array();

    }

    function ver($id) {

        $this->db->from("TANSACAO");

        $this->db->where('TANSACAO.id', $id);

        $this->db->where('TANSACAO.exclusao is null');

        $this->banco->usuario("TANSACAO");

        $query = $this->db->get();

        return $query->row_array();
    }

    function excluir($id) {

        $dados = array();

        $this->db->where('TANSACAO.id', $id);

        $this->banco->usuario("TANSACAO");

        $dados['exclusao']=date("Y-m-d");

        $this->db->update("TANSACAO",$dados);

    }

    function deletar($id) {

        $this->db->where('TANSACAO.id', $id);

        $this->db->where('TANSACAO.exclusao not null');

        $this->banco->usuario("TANSACAO");

        $this->db->delete("TANSACAO");

    }

    function contarTotal($filtro=false) {

        $this->db->select('*');

        $this->db->select('TANSACAO.id as id');

        $this->db->from("TANSACAO");

        $this->db->where('TANSACAO.exclusao is null');

        if(!empty($filtro['filtro_de'])){

            $this->db->where('TANSACAO.data>=',$filtro['filtro_de']);


        }

         if(!empty($filtro['filtro_ate'])){

            $this->db->where('TANSACAO.data<=',$filtro['filtro_ate']);

        }

        if(!empty($filtro)){

            $filtro = array_filter($this->dados($filtro));

            $this->db->like($filtro);

        }

        $this->banco->usuario("TANSACAO");

        return $this->db->get()->num_rows();

    }

    function valorTotal($filtro=false) {

        $this->db->select_sum('valor');

        $this->db->from("TANSACAO");

        $this->db->where('TANSACAO.exclusao is null');


        if(!empty($filtro)){

            $filtro = array_filter($filtro);

            $this->db->like($filtro);

        }

        $this->banco->usuario("TANSACAO");

        return $this->db->get()->result_array();

    }


}
