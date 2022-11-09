<?php


class AgendaModel extends CI_Model {

    function __construct() {

        parent::__construct();

        $this->load->model('admin/AcessoLoginModel');

        $this->tabela = 'AGENDA';

    }

    function dados($dados = array()) {

        $array = array();

        $array['id'] =null;

        $array['id_cliente'] =null;

        $array['id_profissional'] =null;

        $array['id_servico'] =null;

        $array['status'] =null;

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

        $this->db->insert("AGENDA", $dados);

        return $this->db->insert_id();
    }

    function editar($dados) {

        $dados = array_filter($this->dados($dados));

        $this->db->where('AGENDA.id', $dados['id']);

        $this->db->where('AGENDA.exclusao is null');

        $this->banco->usuario("AGENDA");

        $this->db->update("AGENDA", $dados);
    }

    function listar($maximo = NULL, $inicio = NULL) {

        $this->db->from("AGENDA");

        $this->db->where('AGENDA.exclusao is null');

        $this->banco->usuario("AGENDA");

        $query = $this->db->get("", $maximo, $inicio);

        return $query->result_array();
    }

    function filtrar($filtro=array(),$maximo = NULL, $inicio = NULL){

        $filtro=array_filter($this->dados($filtro));

        $this->db->from("AGENDA");

        $this->db->where($filtro);

        $this->db->where('AGENDA.exclusao is null');

        $this->banco->usuario("AGENDA");

        $query = $this->db->get("", $maximo, $inicio);

        return $query->result_array();

    }

    function ver($id) {

        $this->db->from("AGENDA");

        $this->db->where('AGENDA.id', $id);

        $this->db->where('AGENDA.exclusao is null');

        $this->banco->usuario("AGENDA");

        $query = $this->db->get();

        return $query->row_array();
    }

    function excluir($id) {

        $dados = array();

        $this->db->where('AGENDA.id', $id);

        $this->banco->usuario("AGENDA");

        $dados['exclusao']=date("Y-m-d");

        $this->db->update("AGENDA",$dados);

    }

    function status($id) {

        $dados = array();

        $this->db->where('AGENDA.id', $id);

        $this->banco->usuario("AGENDA");

        $dados['status']="pago";

        $this->db->update("AGENDA",$dados);

    }

    function deletar($id) {

        $this->db->where('AGENDA.id', $id);

        $this->db->where('AGENDA.exclusao not null');

        $this->banco->usuario("AGENDA");

        $this->db->delete("AGENDA");

    }

    function contarTotal($filtro=false) {

        $this->db->select('*');

        $this->db->select('AGENDA.id as id');

        $this->db->from("AGENDA");

        $this->db->where('AGENDA.exclusao is null');


        if(!empty($filtro)){

            $filtro = array_filter($filtro);

            $this->db->like($filtro);

        }

        $this->banco->usuario("AGENDA");

        return $this->db->get()->num_rows();

    }


}
