<?php


class TipoUsuarioModel extends CI_Model {
    function __construct() {

        parent::__construct();

        $this->load->model('admin/AcessoLoginModel'); 

        $this->tabela = 'TIPO_USUARIO';
      
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

        $this->db->insert("TIPO_USUARIO", $dados);

        return $this->db->insert_id();
    }

    function editar($dados) {

        $dados = array_filter($this->dados($dados));

        $this->db->where('TIPO_USUARIO.id', $dados['id']);

        $this->db->where('TIPO_USUARIO.exclusao is null');

        $this->banco->usuario("TIPO_USUARIO");

        $this->db->update("TIPO_USUARIO", $dados);
    }

    function listar($maximo = NULL, $inicio = NULL) {

        $this->db->from("TIPO_USUARIO");

        $this->db->where('TIPO_USUARIO.exclusao is null');

        $this->banco->usuario("TIPO_USUARIO");

        $query = $this->db->get("", $maximo, $inicio);
       
        return $query->result_array();
    }

    function filtrar($filtro=array(),$maximo = NULL, $inicio = NULL){

        $filtro=array_filter($this->dados($filtro));

        $this->db->from("TIPO_USUARIO");

        $this->db->like($filtro);

        $this->db->where('TIPO_USUARIO.exclusao is null');

        $this->banco->usuario("TIPO_USUARIO");

        $query = $this->db->get("", $maximo, $inicio);         

        return $query->result_array();

    }

    function ver($id) {

        $this->db->from("TIPO_USUARIO");

        $this->db->where('TIPO_USUARIO.id', $id);

        $this->db->where('TIPO_USUARIO.exclusao is null');

        $this->banco->usuario("TIPO_USUARIO");

        $query = $this->db->get();

        return $query->row_array();
    }

    function excluir($id) {

        $dados = array();

        $this->db->where('TIPO_USUARIO.id', $id);

        $this->banco->usuario("TIPO_USUARIO");

        $dados['exclusao']=date("Y-m-d");

        $this->db->update("TIPO_USUARIO",$dados);

    }

    function deletar($id) {

        $this->db->where('TIPO_USUARIO.id', $id);

        $this->db->where('TIPO_USUARIO.exclusao not null');

        $this->banco->usuario("TIPO_USUARIO");

        $this->db->delete("TIPO_USUARIO");

    }

    function contarTotal($filtro=false) {

        $this->db->select('*');

        $this->db->select('TIPO_USUARIO.id as id');

        $this->db->from("TIPO_USUARIO");

        $this->db->where('TIPO_USUARIO.exclusao is null');


        if(!empty($filtro)){

            $filtro = array_filter($filtro);

            $this->db->like($filtro);

        }  

        $this->banco->usuario("TIPO_USUARIO");

        return $this->db->get()->num_rows();        

    }  
      
  

}