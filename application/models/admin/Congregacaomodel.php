<?php

class Congregacaomodel extends CI_Model {


    public function __construct() {

        parent::__construct();


    }

    function dados($dados = array()) {

        $array = array();

        $array['id'] = null;

        $array['id_modulo'] = null;

        $array['geral'] = null;

        $array['editar'] = null;

        $array['visualizar'] = null;

        $array['excluir'] = null;

        $array['id_usuario'] = null;

        $array['admin'] = null;

        $array['exclusao'] = null;

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

        $this->db->insert("CONGREGACAO", $dados);

        return $this->db->insert_id();;
    }

    function editar($dados) {

        $dados = array_filter($this->dados($dados));

        $this->db->where('CONGREGACAO.id', $dados['id']);

        $this->db->where('CONGREGACAO.exclusao is null');

        $this->banco->usuario("CONGREGACAO");

        $this->db->update("CONGREGACAO", $dados);
    }


    function listar($maximo = NULL, $inicio = NULL) {

        $this->db->from("CONGREGACAO");

        $this->db->where('CONGREGACAO.exclusao is null');

        $this->banco->usuario("CONGREGACAO");

        $query = $this->db->get("", $maximo, $inicio);
       
        return $query->result_array();
    }

     function filtrar($filtro,$maximo = NULL, $inicio = NULL){

       $this->db->from("CONGREGACAO");

        $this->db->where($filtro);

        $this->db->where($filtro);

        $this->banco->usuario("CONGREGACAO");

        $query = $this->db->get("", $maximo, $inicio);         

        return $query->result_array();    

    }



    function ver($id) {

        $this->db->from("CONGREGACAO");

        $this->db->where('CONGREGACAO.id', $id);

        $this->db->where('CONGREGACAO.exclusao is null');

        $this->banco->usuario("CONGREGACAO");

        $query = $this->db->get();

        return $query->row_array();
    }


  function excluir($id) {

        $dados = array();

        $this->db->where('CONGREGACAO.id', $id);

        $this->banco->usuario("CONGREGACAO");

        $dados['exclusao']=date("Y-m-d");

        $this->db->update("CONGREGACAO",$dados);

    }

    function deletar($id) {

        $this->db->where('CONGREGACAO.id', $id);

        $this->db->where('CONGREGACAO.exclusao not null');

        $this->banco->usuario("CONGREGACAO");

        $this->db->delete("CONGREGACAO");

    }

}
