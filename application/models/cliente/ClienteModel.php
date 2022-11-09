<?php


class ClienteModel extends CI_Model {
    function __construct() {

        parent::__construct();

        $this->load->model('admin/AcessoLoginModel');

        $this->tabela = 'CLIENTE';

    }

    function dados($dados = array()) {

        $array = array();

        $array['id'] =null;

        $array['nome'] =null;

        $array['telefone'] =null;

        $array['email'] =null;

        $array['nascimento'] =null;

        $array['cep'] =null;

        $array['numero'] =null;

        $array['endereco'] =null;

        $array['responsavel'] =null;

        $array['contato_responsavel'] =null;

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

        $this->db->insert("CLIENTE", $dados);

        return $this->db->insert_id();
    }

    function editar($dados) {

        $dados = array_filter($this->dados($dados));

        $this->db->where('CLIENTE.id', $dados['id']);

        $this->db->where('CLIENTE.exclusao is null');

        $this->banco->usuario("CLIENTE");

        $this->db->update("CLIENTE", $dados);
    }

    function listar($maximo = NULL, $inicio = NULL) {

        $this->db->from("CLIENTE");

        $this->db->where('CLIENTE.exclusao is null');

        $this->banco->usuario("CLIENTE");

        $query = $this->db->get("", $maximo, $inicio);

        return $query->result_array();
    }

    function filtrar($filtro=array(),$maximo = NULL, $inicio = NULL){

      $ordem= "";

      if(!empty($filtro['ordem'])){

        $ordem= $filtro['ordem'];

      }

      unset($filtro['ordem']);

        $filtro=array_filter($this->dados($filtro));

        $this->db->from("CLIENTE");

        if(!empty($ordem)){

            $this->db->order_by('CLIENTE.nome',$ordem);

        }

        $this->db->like($filtro);

        $this->db->where('CLIENTE.exclusao is null');

        $this->banco->usuario("CLIENTE");

        $query = $this->db->get("", $maximo, $inicio);

        return $query->result_array();

    }

    function ver($id) {

        $this->db->from("CLIENTE");

        $this->db->where('CLIENTE.id', $id);

        $this->db->where('CLIENTE.exclusao is null');

        $this->banco->usuario("CLIENTE");

        $query = $this->db->get();

        return $query->row_array();
    }

    function excluir($id) {

        $dados = array();

        $this->db->where('CLIENTE.id', $id);

        $this->banco->usuario("CLIENTE");

        $dados['exclusao']=date("Y-m-d");

        $this->db->update("CLIENTE",$dados);

    }

    function deletar($id) {

        $this->db->where('CLIENTE.id', $id);

        $this->db->where('CLIENTE.exclusao not null');

        $this->banco->usuario("CLIENTE");

        $this->db->delete("CLIENTE");

    }

    function contarTotal($filtro=false) {

        unset($filtro['ordem']);

        $this->db->select('*');

        $this->db->select('CLIENTE.id as id');

        $this->db->from("CLIENTE");

        $this->db->where('CLIENTE.exclusao is null');


        if(!empty($filtro)){

            $filtro = array_filter($filtro);

            $this->db->like($filtro);

        }

        $this->banco->usuario("CLIENTE");

        return $this->db->get()->num_rows();

    }



}
