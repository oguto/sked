<?php


class FotosModel extends CI_Model {
    function __construct() {

        parent::__construct();

        $this->load->model('admin/AcessoLoginModel'); 

        $this->tabela = 'FOTOS';
      
    }

    function dados($dados = array()) {

        $array = array();

        $array['id'] =null;

        $array['foto'] =null;

        $array['descricao'] =null;

        $array['exclusao'] =null;

        $array['id_personal'] =null;

        $array['admin'] =$this->AcessoLoginModel->verAdmin();

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

        $this->db->insert("FOTOS", $dados);

        return $this->db->insert_id();
    }

    function editar($dados) {

        $dados = array_filter($this->dados($dados));

        $this->db->where('FOTOS.id', $dados['id']);

        $this->db->where('FOTOS.exclusao is null');

        $this->banco->usuario("FOTOS");

        $this->db->update("FOTOS", $dados);
    }

    function listar($maximo = NULL, $inicio = NULL) {

        $this->db->from("FOTOS");

        $this->db->where('FOTOS.exclusao is null');

        $this->banco->usuario("FOTOS");

        $query = $this->db->get("", $maximo, $inicio);
       
        return $query->result_array();
    }

    function filtrar($filtro=array(),$maximo = NULL, $inicio = NULL){

        $filtro=array_filter($this->dados($filtro));

        $this->db->from("FOTOS");

        $this->db->like($filtro);

        $this->db->where('FOTOS.exclusao is null');

        $this->banco->usuario("FOTOS");

        $query = $this->db->get("", $maximo, $inicio);         

        return $query->result_array();

    }

    function ver($id) {

        $this->db->from("FOTOS");

        $this->db->where('FOTOS.id', $id);

        $this->db->where('FOTOS.exclusao is null');

        $this->banco->usuario("FOTOS");

        $query = $this->db->get();

        return $query->row_array();
    }

    function excluir($id) {

        $dados = array();

        $this->db->where('FOTOS.id', $id);

        $this->banco->usuario("FOTOS");

        $dados['exclusao']=date("Y-m-d");

        $this->db->update("FOTOS",$dados);

    }

    function deletar($id) {

        $this->db->where('FOTOS.id', $id);

        $this->db->where('FOTOS.exclusao not null');

        $this->banco->usuario("FOTOS");

        $this->db->delete("FOTOS");

    }

    function contarTotal($filtro=false) {

        $this->db->select('*');

        $this->db->select('FOTOS.id as id');

        $this->db->from("FOTOS");

        $this->db->where('FOTOS.exclusao is null');


        if(!empty($filtro)){

            $filtro = array_filter($filtro);

            $this->db->like($filtro);

        }  

        $this->banco->usuario("FOTOS");

        return $this->db->get()->num_rows();        

    }  
      
  

}