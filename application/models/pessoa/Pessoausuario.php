<?php

class Pessoausuario extends CI_Model {

     public function __construct() {

        parent::__construct();
        
    }
 

    function dados($dados) {
        
        $array = array(); 

        $array['id'] = null;

        $array['id_pessoa'] = null;

        $array['id_usuario'] = null;

        $array['admin'] = $this->usuario->verAdmin();        

        $array['exclusao'] = null;

         foreach ($array as $key => $value) {

             if(isset($dados[$key])){

                 $array[$key]=$dados[$key];

             } else{

                if(is_null($array[$key])){

                    $array[$key]=null;

                    }
             }
             
         }

         return $array;
    }

    function incluir($dados) { 

         $this->db->insert("PESSOA_USUARIO", array_filter($this->dados($dados)));

         $id = $this->db->insert_id(); 
 
         return $id;
    }

    function editar($dados) {

         $dados = $this->banco->tratarDados($this->dados($dados));
         
         $this->db->where('id', $dados['id']);

         $this->db->where('PESSOA_USUARIO.exclusao is null');

         $this->db->update("PESSOA_USUARIO", $dados);       
    }

    function listar($id, $maximo = NULL, $inicio = NULL) {

        $this->db->select('*');

        $this->db->select("PESSOA_USUARIO.id AS id");

        $this->db->from("PESSOA_USUARIO");

        $this->db->join("CONTATO","CONTATO.id=PESSOA_USUARIO.id_contato","left");

        $this->db->where('PESSOA_USUARIO.exclusao is null');

        $this->db->where('CONTATO.tipo_contato',1);

        $this->db->where('PESSOA_USUARIO.id_pessoa',$id);

        $this->banco->usuario("PESSOA_USUARIO");

        $query = $this->db->get("", $maximo, $inicio);

        return $query->result_array();
    }

    function filtrar($filtro, $maximo = NULL, $inicio = NULL) {

        $this->db->select('*');

        $this->db->select("PESSOA_USUARIO.id AS id");

        $this->db->from("PESSOA_USUARIO");

        $this->db->where(array_filter($filtro));

        $this->db->where('PESSOA_USUARIO.exclusao is null');

        $this->banco->usuario("PESSOA_USUARIO");

        $query = $this->db->get("", $maximo, $inicio);

        return $query->result_array();
    }
   

    function verPorUsuario($id_usuario) {

        $this->db->select('*');

        $this->db->select("PESSOA_USUARIO.id AS id");
        
        $this->db->from("PESSOA_USUARIO");

        $this->db->where('PESSOA_USUARIO.exclusao is null');

        $this->db->where('PESSOA_USUARIO.id_usuario',$id_usuario);      

        $this->banco->usuario("PESSOA_USUARIO");

        $query = $this->db->get();
              
        return $query->row_array();
    }


    function verPorPessoa($id_pessoa) {

        $this->db->select('*');

        $this->db->select("PESSOA_USUARIO.id AS id");
        
        $this->db->from("PESSOA_USUARIO");

        $this->db->where('PESSOA_USUARIO.exclusao is null');

        $this->db->where('PESSOA_USUARIO.id_pessoa',$id_pessoa);      

        $this->banco->usuario("PESSOA_USUARIO");

        $query = $this->db->get();
              
        return $query->row_array();
    }

 

    function excluir($id) {

        $dados=array();

        $this->db->where('id', $id);

        $this->banco->usuario("PESSOA_USUARIO");

        $dados['exclusao']=date("Y-m-d");

        $this->db->update("PESSOA_USUARIO",$dados);
    }

    function deletar($id) {
            
    }

}
