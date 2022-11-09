<?php


class EstadoModel extends CI_Model {
    function __construct() {

        parent::__construct();

        $this->load->model('admin/AcessoLoginModel'); 

        $this->tabela = 'ESTADO';
      
    }

    function dados($dados = array()) {

        $array = array();

        $array['id'] =null;

        $array['nome'] =null;

        $array['uf'] =null;

        $array['pais'] =null;

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

        $this->db->insert("ESTADO", $dados);

        return $this->db->insert_id();
    }

    function editar($dados) {

        $dados = array_filter($this->dados($dados));

        $this->db->where('ESTADO.id', $dados['id']);

        $this->db->where('ESTADO.exclusao is null');

        $this->banco->usuario("ESTADO");

        $this->db->update("ESTADO", $dados);
    }

    function listar($maximo = NULL, $inicio = NULL) {

        $this->db->from("ESTADO");

        $this->db->where('ESTADO.exclusao is null');

        $this->banco->usuario("ESTADO");

        $query = $this->db->get("", $maximo, $inicio);
       
        return $query->result_array();
    }

    function filtrar($filtro=array(),$maximo = NULL, $inicio = NULL){

        $filtro=array_filter($this->dados($filtro));

        $this->db->from("ESTADO");

        $this->db->like($filtro);

        $this->db->where('ESTADO.exclusao is null');

        $this->banco->usuario("ESTADO");

        $query = $this->db->get("", $maximo, $inicio);         

        return $query->result_array();

    }

    function ver($id) {

        $this->db->from("ESTADO");

        $this->db->where('ESTADO.id', $id);

        $this->db->where('ESTADO.exclusao is null');

        $this->banco->usuario("ESTADO");

        $query = $this->db->get();

        return $query->row_array();
    }

    function excluir($id) {

        $dados = array();

        $this->db->where('ESTADO.id', $id);

        $this->banco->usuario("ESTADO");

        $dados['exclusao']=date("Y-m-d");

        $this->db->update("ESTADO",$dados);

    }

    function deletar($id) {

        $this->db->where('ESTADO.id', $id);

        $this->db->where('ESTADO.exclusao not null');

        $this->banco->usuario("ESTADO");

        $this->db->delete("ESTADO");

    }

    function contarTotal($filtro=false) {

        $this->db->select('*');

        $this->db->select('ESTADO.id as id');

        $this->db->from("ESTADO");

        $this->db->where('ESTADO.exclusao is null');


        if(!empty($filtro)){

            $filtro = array_filter($filtro);

            $this->db->like($filtro);

        }  

        $this->banco->usuario("ESTADO");

        return $this->db->get()->num_rows();        

    }  
      
  

}