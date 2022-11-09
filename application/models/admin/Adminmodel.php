<?php

class Adminmodel extends CI_Model {


    public function __construct() {

        parent::__construct();


    }

    function dados($dados = array()) {

        $array = array();

        $array['id'] = null;

        $array['chave'] = null;

        $array['nome'] = null;

        $array['email'] = null;

        $array['id_congregacao'] = null;

        $array['id_crm'] = null;

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

        $this->db->insert("ADMIN", $dados);

        return $this->db->insert_id();;
    }

    function editar($dados) {

        $dados = array_filter($this->dados($dados));

        $this->db->where('ADMIN.id', $dados['id']);

        $this->db->where('ADMIN.exclusao is null');

        $this->banco->usuario("ADMIN");

        $this->db->update("ADMIN", $dados);
    }


    function listar($maximo = NULL, $inicio = NULL) {

        $this->db->from("ADMIN");

        $this->db->where('ADMIN.exclusao is null');

        $this->banco->usuario("ADMIN");

        $query = $this->db->get("", $maximo, $inicio);
       
        return $query->result_array();
    }

     function filtrar($filtro,$maximo = NULL, $inicio = NULL){

        $this->db->from("ADMIN");

        $this->db->where($filtro);

        $this->banco->usuario("ADMIN");

        $query = $this->db->get("", $maximo, $inicio);         

        return $query->result_array();

    }


    function ver($id) {

        $this->db->from("ADMIN");

        $this->db->where('ADMIN.id', $id);

        $this->db->where('ADMIN.exclusao is null');

        $this->banco->usuario("ADMIN");

        $query = $this->db->get();

        return $query->row_array();
    }


  function excluir($id) {

        $dados = array();

        $this->db->where('ADMIN.id', $id);

        $this->banco->usuario("ADMIN");

        $dados['exclusao']=date("Y-m-d");

        $this->db->update("ADMIN",$dados);

    }

    function deletar($id) {

        $this->db->where('ADMIN.id', $id);

        $this->db->where('ADMIN.exclusao not null');

        $this->banco->usuario("ADMIN");

        $this->db->delete("ADMIN");

    }

}
