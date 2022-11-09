<?php

class Statussituacao extends CI_Model {


    public function __construct() {

        parent::__construct();


    }

    function dados($dados) {

        $array = array();

        $array['id'] = null;

        $array['nome'] = null;
        
        $array['exclusao'] = null;

          foreach ($array as $key => $value) {

                 if(isset($dados[$key])){
                     $array[$key]=$dados[$key];
                 } else{
                   if(is_null($array[$key])){
                       $array[$key]=null;
                    }                 }

             }


         return $array;
    }


    function incluir($dados) {

         $dados=array_filter($this->dados($dados));

         $this->db->insert("STATUS_SITUACAO", $dados);

         $id = $this->db->insert_id();

         return $id;
    }

    function editar($dados) {

         $dados = array_filter($this->dados($dados));

         $this->db->where('STATUS_SITUACAO.id', $dados['id']);

         $this->db->where('STATUS_SITUACAO.exclusao is null');

         $this->banco->usuario("STATUS_SITUACAO");

         $this->db->update("STATUS_SITUACAO", $dados);
    }


    function listar($maximo = NULL, $inicio = NULL) {

         $this->db->from("STATUS_SITUACAO");

         //$this->db->where('STATUS_SITUACAO.exclusao is null');

         $this->banco->usuario("STATUS_SITUACAO");

         $query = $this->db->get("", $maximo, $inicio);

         $lista = array();

         foreach ($query->result_array() as $dados) {

            $lista[] = $dados ;

         }

         return $lista;
    }

    //$dados=array(id=>?usuario=>?)

    function ver($id) {

         $this->db->from("STATUS_SITUACAO");

         $this->db->where('STATUS_SITUACAO.id', $id);

        $this->db->where('STATUS_SITUACAO.exclusao is null');

         $this->banco->usuario("STATUS_SITUACAO");

         $query = $this->db->get();

          $dados = array();

         if(sizeof(array_filter($query->row_array()))>0) {

             $dados = $query->row_array();
         }
         return $dados;
    }


  function excluir($id) {

        $dados=array();

        $this->db->where('STATUS_SITUACAO.id', $id);

        $this->banco->usuario("STATUS_SITUACAO");

        $dados['exclusao']=date("Y-m-d");

        $this->db->update("STATUS_SITUACAO",$dados);
    }

    function deletar($id) {

         $this->db->where('STATUS_SITUACAO.id', $id);

         $this->db->where('STATUS_SITUACAO.exclusao not null');

         $this->banco->usuario("STATUS_SITUACAO");

         $this->db->delete("STATUS_SITUACAO");

    }

}
