<?php

class Escolaridade extends CI_Model {


    public function __construct() {

        parent::__construct();
        
        
    }
 
     function dados($dados) {

        $array = array();

        $array['id'] = null;        

        $array['escolaridade'] = null;

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

         $this->db->insert("COMBO_ESCOLARIDADE", $dados);

         $id = $this->db->insert_id();

         return $id;
    }

    function editar($dados) {

         $dados = array_filter($this->dados($dados));

         $this->db->where('id', $dados['id']);

         $this->db->where('COMBO_ESCOLARIDADE.exclusao is null');
 
         $this->db->update("COMBO_ESCOLARIDADE", $dados);
    }

    //$dados=array(categoria=>?usuario=>?)
    
    function listarCombo($id=NULL, $maximo = NULL, $inicio = NULL) {

         $this->db->from("COMBO_ESCOLARIDADE"); 

         $query = $this->db->get("", $maximo, $inicio);

         $listaEscolaridade = array();

         $listaEscolaridade[] = "<option>Selecione...</option>";

         foreach ($query->result_array() as $dados) {

            if ($id==$dados['id'] and $id!=NULL) {

                $listaEscolaridade[] = "<option value=".$dados['id']." selected>".$dados['escolaridade']."</option>";

             }else{

                $listaEscolaridade[] = "<option value=".$dados['id'].">".$dados['escolaridade']."</option>";
                
             }                  

         }

         return $listaEscolaridade;
    }

    //$dados=array(id=>?usuario=>?)

    function ver($id) {

         $this->db->from("COMBO_ESCOLARIDADE");

         $this->db->where('id', $id);

         $this->db->where('COMBO_ESCOLARIDADE.exclusao is null'); 

         $query = $this->db->get();

         return $query->row_array();
    }


  function excluir($id) {

        $dados=array();

        $this->db->where('id', $id);

        $this->banco->usuario("COMBO_ESCOLARIDADE");

        $dados['exclusao']=date("Y-m-d");

        $this->db->update("COMBO_ESCOLARIDADE",$dados);
    }

    function deletar($id) {

         $this->db->where('id', $id);

         $this->db->where('COMBO_ESCOLARIDADE.exclusao not null');   

         $this->db->delete("COMBO_ESCOLARIDADE");
    
    }

}
