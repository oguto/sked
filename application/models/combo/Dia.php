<?php

class Dia extends CI_Model {


    public function __construct() {

        parent::__construct();
        
        
    }
 
     function dados($dados) {

        $array = array();

        $array['id'] = null;        

        $array['dia'] = null;

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

         $this->db->insert("COMBO_DIA", $dados);

         $id = $this->db->insert_id();

         return $id;
    }

    function editar($dados) {

         $dados = array_filter($this->dados($dados));

         $this->db->where('id', $dados['id']);

         $this->db->where('COMBO_DIA.exclusao is null');
 
         $this->db->update("COMBO_DIA", $dados);
    }

    //$dados=array(categoria=>?usuario=>?)
    
    function listarCombo($id=NULL, $maximo = NULL, $inicio = NULL) {

         $this->db->from("COMBO_DIA");         

         $query = $this->db->get("", $maximo, $inicio);

         $listarDia = array();

         $listarDia[] = "<option value=''>Selecione...</option>";

         foreach ($query->result_array() as $dados) {
            if ($id==$dados['id']) {
                $listarDia[] = "<option value=".$dados['id']." selected>".$dados['dia']."</option>";
             }else{
                $listarDia[] = "<option value=".$dados['id'].">".$dados['dia']."</option>";
             }                  

         }

         return $listarDia;
    }

    function listar($id=NULL, $maximo = NULL, $inicio = NULL) {

         $this->db->from("COMBO_DIA"); 

         $query = $this->db->get("", $maximo, $inicio);

         $listarDia = $query->result_array();

         return $listarDia;
    }

     function listarUteis($id=NULL, $maximo = NULL, $inicio = NULL) {

         $this->db->from("COMBO_DIA"); 

         $this->db->where('COMBO_DIA.id<7');

         $this->db->where('COMBO_DIA.id>1');    

         $query = $this->db->get("", $maximo, $inicio);

         $listarDia = $query->result_array();

         return $listarDia;
    }


    //$dados=array(id=>?usuario=>?)

    function ver($id) {

         $this->db->from("COMBO_DIA");

         $this->db->where('id', $id);        

         $query = $this->db->get();

         $pessoa = $this->dados(array());

         if(sizeof(array_filter($query->row_array()))>0) {

             $dia = $query->row_array();
         }
         return $dia;
    }


  function excluir($id) {

        $dados=array();

        $this->db->where('id', $id);

        $this->banco->usuario("COMBO_DIA");

        $dados['exclusao']=date("Y-m-d");

        $this->db->update("COMBO_DIA",$dados);
    }

    function deletar($id) {

         $this->db->where('id', $id);

         $this->db->where('COMBO_DIA.exclusao not null');   

         $this->db->delete("COMBO_DIA");
    
    }

}
