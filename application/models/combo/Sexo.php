<?php

class Sexo extends CI_Model {


    public function __construct() {

        parent::__construct();
        
        
    }
 
     function dados($dados) {

        $array = array();

        $array['id'] = null;        

        $array['sexo'] = null;

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

         $this->db->insert("COMBO_SEXO", $dados);

         $id = $this->db->insert_id();

         return $id;
    }

    function editar($dados) {

         $dados = array_filter($this->dados($dados));

         $this->db->where('id', $dados['id']);

         $this->db->where('COMBO_SEXO.exclusao is null');
 
         $this->db->update("COMBO_SEXO", $dados);
    }

    //$dados=array(categoria=>?usuario=>?)
    
    function listarCombo($id=NULL) {

         $this->db->from("COMBO_SEXO"); 

         $query = $this->db->get("");

         $listarSexo = array();

         $listarSexo[] = "<option value=''>Selecione...</option>";

         foreach ($query->result_array() as $dados) {
            if ($id==$dados['id']) {
                $listarSexo[] = "<option value=".$dados['id']." selected>".$dados['sexo']."</option>";
             }else{
                $listarSexo[] = "<option value=".$dados['id'].">".$dados['sexo']."</option>";
             }                  

         }

         return $listarSexo;
    }

    //$dados=array(id=>?usuario=>?)

    function ver($id) {

        $this->db->from("COMBO_SEXO");

        $this->db->where('COMBO_SEXO.id', $id);

        $query = $this->db->get();

        return  $query->row_array();
    }


  function excluir($id) {

        $dados=array();

        $this->db->where('id', $id);

        $this->banco->usuario("COMBO_SEXO");

        $dados['exclusao']=date("Y-m-d");

        $this->db->update("COMBO_SEXO",$dados);
    }

    function deletar($id) {

         $this->db->where('id', $id);

         $this->db->where('COMBO_SEXO.exclusao not null');   

         $this->db->delete("COMBO_SEXO");
    
    }

}
