<?php


class PagamentoMetodoModel extends CI_Model {
    function __construct() {

        parent::__construct();

        $this->load->model('admin/AcessoLoginModel');

        $this->tabela = 'PAGAMENTO_METODO';

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

        $this->db->insert("PAGAMENTO_METODO", $dados);

        return $this->db->insert_id();
    }

    function editar($dados) {

        $dados = array_filter($this->dados($dados));

        $this->db->where('PAGAMENTO_METODO.id', $dados['id']);

        $this->db->where('PAGAMENTO_METODO.exclusao is null');

        $this->banco->usuario("PAGAMENTO_METODO");

        $this->db->update("PAGAMENTO_METODO", $dados);
    }

    function listar($maximo = NULL, $inicio = NULL) {

        $this->db->from("PAGAMENTO_METODO");

        $this->db->where('PAGAMENTO_METODO.exclusao is null');

        $this->banco->usuario("PAGAMENTO_METODO");

        $query = $this->db->get("", $maximo, $inicio);

        return $query->result_array();
    }

    function filtrar($filtro=array(),$maximo = NULL, $inicio = NULL){

        $filtro=array_filter($this->dados($filtro));

        $this->db->from("PAGAMENTO_METODO");

        $this->db->like($filtro);

        $this->db->where('PAGAMENTO_METODO.exclusao is null');

        $this->banco->usuario("PAGAMENTO_METODO");

        $query = $this->db->get("", $maximo, $inicio);

        return $query->result_array();

    }

    function ver($id) {

        $this->db->from("PAGAMENTO_METODO");

        $this->db->where('PAGAMENTO_METODO.id', $id);

        $this->db->where('PAGAMENTO_METODO.exclusao is null');

        $this->banco->usuario("PAGAMENTO_METODO");

        $query = $this->db->get();

        return $query->row_array();
    }

    function excluir($id) {

        $dados = array();

        $this->db->where('PAGAMENTO_METODO.id', $id);

        $this->banco->usuario("PAGAMENTO_METODO");

        $dados['exclusao']=date("Y-m-d");

        $this->db->update("PAGAMENTO_METODO",$dados);

    }

    function deletar($id) {

        $this->db->where('PAGAMENTO_METODO.id', $id);

        $this->db->where('PAGAMENTO_METODO.exclusao not null');

        $this->banco->usuario("PAGAMENTO_METODO");

        $this->db->delete("PAGAMENTO_METODO");

    }

    function contarTotal($filtro=false) {

        $this->db->select('*');

        $this->db->select('PAGAMENTO_METODO.id as id');

        $this->db->from("PAGAMENTO_METODO");

        $this->db->where('PAGAMENTO_METODO.exclusao is null');


        if(!empty($filtro)){

            $filtro = array_filter($filtro);

            $this->db->like($filtro);

        }

        $this->banco->usuario("PAGAMENTO_METODO");

        return $this->db->get()->num_rows();

    }



}
