<?php


class ColaboradorModel extends CI_Model {
    function __construct() {

        parent::__construct();

        $this->load->model('admin/AcessoLoginModel');

        $this->tabela = 'COLABORADOR';

    }

    function dados($dados = array()) {

        $array = array();

        $array['id'] =null;

        $array['email'] =null;

        $array['nome'] =null;

        $array['nascimento'] =null;

        $array['cpf'] =null;

        $array['telefone'] =null;

        $array['cep'] =null;

        $array['numero'] =null;

        $array['responsavel'] =null;

        $array['endereco'] =null;

        $array['comissao'] =null;

        $array['id_usuario'] =null;

        $array['data'] =null;

        $array['grupo'] =null;

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

        $this->db->insert("COLABORADOR", $dados);

        return $this->db->insert_id();
    }

    function editar($dados) {

        $dados = array_filter($this->dados($dados));

        $this->db->where('COLABORADOR.id', $dados['id']);

        $this->db->where('COLABORADOR.exclusao is null');

        $this->banco->usuario("COLABORADOR");

        $this->db->update("COLABORADOR", $dados);
    }

    function listar($maximo = NULL, $inicio = NULL) {

        $this->db->from("COLABORADOR");

        $this->db->where('COLABORADOR.exclusao is null');

        $this->banco->usuario("COLABORADOR");

        $query = $this->db->get("", $maximo, $inicio);

        return $query->result_array();
    }

    function filtrar($filtro=array(),$maximo = NULL, $inicio = NULL){

      $ordem= "";

      if(!empty($filtro['ordem'])){

        $ordem= $filtro['ordem'];

      }

        $filtro=array_filter($this->dados($filtro));

        $this->db->from("COLABORADOR");



        if(!empty($ordem)){

            $this->db->order_by('COLABORADOR.nome',$ordem);

        }

          $this->db->like($filtro);



        $this->db->where('COLABORADOR.exclusao is null');

        $this->banco->usuario("COLABORADOR");

        $query = $this->db->get("", $maximo, $inicio);

        return $query->result_array();

    }

    function ver($id) {

        $this->db->from("COLABORADOR");

        $this->db->where('COLABORADOR.id', $id);

        $this->db->where('COLABORADOR.exclusao is null');

        $this->banco->usuario("COLABORADOR");

        $query = $this->db->get();

        return $query->row_array();
    }

    function excluir($id) {

        $dados = array();

        $this->db->where('COLABORADOR.id', $id);

        $this->banco->usuario("COLABORADOR");

        $dados['exclusao']=date("Y-m-d");

        $this->db->update("COLABORADOR",$dados);

    }

    function deletar($id) {

        $this->db->where('COLABORADOR.id', $id);

        $this->db->where('COLABORADOR.exclusao not null');

        $this->banco->usuario("COLABORADOR");

        $this->db->delete("COLABORADOR");

    }

    function contarTotal($filtro=false) {

        unset($filtro['ordem']);

        $this->db->select('*');

        $this->db->select('COLABORADOR.id as id');

        $this->db->from("COLABORADOR");

        $this->db->where('COLABORADOR.exclusao is null');


        if(!empty($filtro)){

            $filtro = array_filter($filtro);

            $this->db->like($filtro);

        }

        $this->banco->usuario("COLABORADOR");

        return $this->db->get()->num_rows();

    }



}
