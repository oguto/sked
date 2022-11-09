<?php


class PeriodoLancamentoModel extends CI_Model {
    function __construct() {

        parent::__construct();

        $this->load->model('admin/AcessoLoginModel'); 

        $this->tabela = 'PERIODO_LANCAMENTO';
      
    }

    function dados($dados = array()) {

        $array = array();

        $array['id'] =null;

        $array['nome'] =null;

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

        $this->db->insert("PERIODO_LANCAMENTO", $dados);

        return $this->db->insert_id();
    }

    function editar($dados) {

        $dados = array_filter($this->dados($dados));

        $this->db->where('PERIODO_LANCAMENTO.id', $dados['id']);

        $this->db->where('PERIODO_LANCAMENTO.exclusao is null');

        $this->banco->usuario("PERIODO_LANCAMENTO");

        $this->db->update("PERIODO_LANCAMENTO", $dados);
    }

    function listar($maximo = NULL, $inicio = NULL) {

        $this->db->from("PERIODO_LANCAMENTO");

        $this->db->where('PERIODO_LANCAMENTO.exclusao is null');

        $this->banco->usuario("PERIODO_LANCAMENTO");

        $query = $this->db->get("", $maximo, $inicio);
       
        return $query->result_array();
    }

    function filtrar($filtro=array(),$maximo = NULL, $inicio = NULL){

        $filtro=array_filter($this->dados($filtro));

        $this->db->from("PERIODO_LANCAMENTO");

        $this->db->like($filtro);

        $this->db->where('PERIODO_LANCAMENTO.exclusao is null');

        $this->banco->usuario("PERIODO_LANCAMENTO");

        $query = $this->db->get("", $maximo, $inicio);         

        return $query->result_array();

    }

    function ver($id) {

        $this->db->from("PERIODO_LANCAMENTO");

        $this->db->where('PERIODO_LANCAMENTO.id', $id);

        $this->db->where('PERIODO_LANCAMENTO.exclusao is null');

        $this->banco->usuario("PERIODO_LANCAMENTO");

        $query = $this->db->get();

        return $query->row_array();
    }

    function excluir($id) {

        $dados = array();

        $this->db->where('PERIODO_LANCAMENTO.id', $id);

        $this->banco->usuario("PERIODO_LANCAMENTO");

        $dados['exclusao']=date("Y-m-d");

        $this->db->update("PERIODO_LANCAMENTO",$dados);

    }

    function deletar($id) {

        $this->db->where('PERIODO_LANCAMENTO.id', $id);

        $this->db->where('PERIODO_LANCAMENTO.exclusao not null');

        $this->banco->usuario("PERIODO_LANCAMENTO");

        $this->db->delete("PERIODO_LANCAMENTO");

    }

    function contarTotal($filtro=false) {

        $this->db->select('*');

        $this->db->select('PERIODO_LANCAMENTO.id as id');

        $this->db->from("PERIODO_LANCAMENTO");

        $this->db->where('PERIODO_LANCAMENTO.exclusao is null');


        if(!empty($filtro)){

            $filtro = array_filter($filtro);

            $this->db->like($filtro);

        }  

        $this->banco->usuario("PERIODO_LANCAMENTO");

        return $this->db->get()->num_rows();        

    }  
      
  

}