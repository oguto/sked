<?php

class Usuariomodel extends CI_Model {


    public function __construct() {

        parent::__construct();


    }

    function dados($dados = array()) {

        $array = array();

        $array['id'] = null;

        $array['tipo'] = null;

        $array['nome'] = null;

        $array['email'] = null;

        $array['senha'] = null;

        $array['admin'] = $this->usuario->verAdmin();

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

        $this->db->insert("USUARIO", $dados);

        return $this->db->insert_id();;
    }

    function editar($dados) {


        $dados = array_filter($this->dados($dados));

        $this->db->where('USUARIO.id', $dados['id']);

        $this->db->where('USUARIO.exclusao is null');

        $this->banco->usuario("USUARIO");

        $this->db->update("USUARIO", $dados);
    }


    function listar($maximo = NULL, $inicio = NULL) {

        $this->db->from("USUARIO");

        $this->db->where('USUARIO.exclusao is null');

        $this->db->where('USUARIO.tipo>1');

        $this->banco->usuario("USUARIO");

        $query = $this->db->get("", $maximo, $inicio);
       
        return $query->result_array();
    }

     function filtrar($filtro,$maximo = NULL, $inicio = NULL){

        $this->db->from("USUARIO");

        $this->db->where($filtro);

        $this->banco->usuario("USUARIO");

        $query = $this->db->get("", $maximo, $inicio);         

        return $query->result_array();

    }


    function ver($id) {

        $this->db->from("USUARIO");

        $this->db->where('USUARIO.id', $id);

        $this->db->where('USUARIO.exclusao is null');

        $this->banco->usuario("USUARIO");

        $query = $this->db->get();

        return $query->row_array();
    }


  function excluir($id) {

        $dados = array();

        $this->db->where('USUARIO.id', $id);

        $this->banco->usuario("USUARIO");

        $dados['exclusao']=date("Y-m-d");

        $this->db->update("USUARIO",$dados);

    }

    function deletar($id) {

        $this->db->where('USUARIO.id', $id);

        $this->db->where('USUARIO.exclusao not null');

        $this->banco->usuario("USUARIO");

        $this->db->delete("USUARIO");

    }

}
