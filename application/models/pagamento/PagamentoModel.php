<?php


class PagamentoModel extends CI_Model {
    function __construct() {

        parent::__construct();

        $this->load->model('admin/AcessoLoginModel');

        $this->tabela = 'PAGAMENTO';

    }

    function dados($dados = array()) {

        $array = array();

        $array['id'] =null;

        $array['abatimento'] =null;

        $array['id_colaborador'] =null;

        $array['tipo'] =null;

        $array['observacoes'] =null;

        $array['id_cliente'] =null;

        $array['id_metodo_pagamento'] =null;

        $array['parcelamento'] =null;

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

        $array['abatimento'] =null;

        $array['id_colaborador'] =null;

        $array['tipo'] =null;

        $array['observacoes'] =null;

        $array['id_cliente'] =null;

        $array['id_metodo_pagamento'] =null;

        $array['id_servico'] =null;

        $array['parcelamento'] =null;

        $array['valor'] =null;

        $array['data'] =null;

        $array['filtro_de'] =null;

        $array['filtro_ate'] =null;


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

    function novoId() {


      $this->db->insert("PAGAMENTO",array());

      return $this->db->insert_id();
    }


    function incluir($dados) {

        $dados=array_filter($this->dados($dados));

        $dados['data'] =date("Y-m-d");

        $this->db->insert("PAGAMENTO", $dados);

        return $this->db->insert_id();
    }

    function editar($dados) {

        $dados = array_filter($this->dados($dados));

        $this->db->where('PAGAMENTO.id', $dados['id']);

        $this->db->where('PAGAMENTO.exclusao is null');

        $this->banco->usuario("PAGAMENTO");

        $this->db->update("PAGAMENTO", $dados);
    }

    function listar($maximo = NULL, $inicio = NULL) {

        $this->db->from("PAGAMENTO");

        $this->db->where('PAGAMENTO.exclusao is null');

        $this->banco->usuario("PAGAMENTO");

        $query = $this->db->get("", $maximo, $inicio);

        return $query->result_array();
    }

    function filtrar($filtro=array(),$maximo = NULL, $inicio = NULL){

        $this->db->from("PAGAMENTO");


        if(!empty($filtro['filtro_de'])){

            $this->db->where('PAGAMENTO.data>=',$filtro['filtro_de']);


        }

         if(!empty($filtro['filtro_ate'])){

            $this->db->where('PAGAMENTO.data<=',$filtro['filtro_ate']);

        }

        $this->db->like($this->dados($filtro));


        $this->db->where('PAGAMENTO.exclusao is null');

        $this->banco->usuario("PAGAMENTO");

        $query = $this->db->get("", $maximo, $inicio);

        return $query->result_array();

    }

    function ver($id) {

        $this->db->from("PAGAMENTO");

        $this->db->where('PAGAMENTO.id', $id);

        $this->db->where('PAGAMENTO.exclusao is null');

        $this->banco->usuario("PAGAMENTO");

        $query = $this->db->get();

        return $query->row_array();
    }

    function excluir($id) {

        $dados = array();

        $this->db->where('PAGAMENTO.id', $id);

        $this->banco->usuario("PAGAMENTO");

        $dados['exclusao']=date("Y-m-d");

        $this->db->update("PAGAMENTO",$dados);

    }

    function deletar($id) {

        $this->db->where('PAGAMENTO.id', $id);

        $this->db->where('PAGAMENTO.exclusao not null');

        $this->banco->usuario("PAGAMENTO");

        $this->db->delete("PAGAMENTO");

    }

    function contarTotal($filtro=false) {

        $this->db->select('*');

        $this->db->select('PAGAMENTO.id as id');

        $this->db->from("PAGAMENTO");

        $this->db->where('PAGAMENTO.exclusao is null');


        if(!empty($filtro)){

            $filtro = array_filter($filtro);

            $this->db->like($filtro);

        }

        $this->banco->usuario("PAGAMENTO");

        return $this->db->get()->num_rows();

    }

    function valorTotal($filtro=false) {

        $this->db->select_sum('valor');

        $this->db->from("PAGAMENTO");

        $this->db->where('PAGAMENTO.exclusao is null');


        if(!empty($filtro)){

            $filtro = array_filter($filtro);

            $this->db->like($filtro);

        }

        $this->banco->usuario("PAGAMENTO");

        return $this->db->get()->result_array();

    }

}
