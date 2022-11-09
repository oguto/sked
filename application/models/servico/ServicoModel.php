<?php


class ServicoModel extends CI_Model {
    function __construct() {

        parent::__construct();

        $this->load->model('admin/AcessoLoginModel');

        $this->tabela = 'SERVICO';

    }

    function dados($dados = array()) {

        $array = array();

        $array['id'] =null;

        $array['nome'] =null;

        $array['preco_venda'] =null;

        $array['desconto'] =null;

        $array['estoque'] =null;

        $array['data'] =null;

        $array['horas'] =null;

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

        $this->db->insert("SERVICO", $dados);

        return $this->db->insert_id();
    }

    function editar($dados) {

        $dados = array_filter($this->dados($dados));

        $this->db->where('SERVICO.id', $dados['id']);

        $this->db->where('SERVICO.exclusao is null');

        $this->banco->usuario("SERVICO");

        $this->db->update("SERVICO", $dados);
    }

    function listar($maximo = NULL, $inicio = NULL) {

        $this->db->from("SERVICO");

        $this->db->where('SERVICO.exclusao is null');

        $this->banco->usuario("SERVICO");

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

        $this->db->from("SERVICO");

        if(!empty($ordem)){

            $this->db->order_by('SERVICO.nome',$ordem);

        }


        $this->db->like($filtro);

        $this->db->where('SERVICO.exclusao is null');

        $this->banco->usuario("SERVICO");

        $query = $this->db->get("", $maximo, $inicio);

        return $query->result_array();

    }

    function ver($id) {

        $this->db->from("SERVICO");

        $this->db->where('SERVICO.id', $id);

        $this->db->where('SERVICO.exclusao is null');

        $this->banco->usuario("SERVICO");

        $query = $this->db->get();

        return $query->row_array();
    }

    function excluir($id) {

        $dados = array();

        $this->db->where('SERVICO.id', $id);

        $this->banco->usuario("SERVICO");

        $dados['exclusao']=date("Y-m-d");

        $this->db->update("SERVICO",$dados);

    }

    function deletar($id) {

        $this->db->where('SERVICO.id', $id);

        $this->db->where('SERVICO.exclusao not null');

        $this->banco->usuario("SERVICO");

        $this->db->delete("SERVICO");

    }

    function contarTotal($filtro=false) {

        $this->db->select('*');

        $this->db->select('SERVICO.id as id');

        $this->db->from("SERVICO");

        $this->db->where('SERVICO.exclusao is null');


          $ordem= "";

          if(!empty($filtro['ordem'])){

            $ordem= $filtro['ordem'];

          }
          unset($filtro['ordem']);


        if(!empty($filtro)){

            $filtro = array_filter($filtro);

            $this->db->like($filtro);

        }

        $this->banco->usuario("SERVICO");

        return $this->db->get()->num_rows();

    }



}
