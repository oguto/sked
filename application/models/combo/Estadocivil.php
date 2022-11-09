<?php

class EstadoCivil extends CI_Model {


    public function __construct() {

        parent::__construct();
        
        
    }
 
     function dados($dados) {

        $array = array();

        $array['id'] = null;        

        $array['estado_civil'] = null;

        $array['sexo'] =  null;
        
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

         $this->db->insert("COMBO_ESTADO_CIVIL", $dados);

         $id = $this->db->insert_id();

         return $id;
    }

    function editar($dados) {

         $dados = array_filter($this->dados($dados));

         $this->db->where('id', $dados['id']);

         $this->db->where('COMBO_ESTADO_CIVIL.exclusao is null');
 
         $this->db->update("COMBO_ESTADO_CIVIL", $dados);
    }

    //$dados=array(categoria=>?usuario=>?)
    
    function listarCombo($sexo,$id=NULL,$maximo = NULL, $inicio = NULL) {

         $this->db->from("COMBO_ESTADO_CIVIL"); 

         $this->db->where('COMBO_ESTADO_CIVIL.sexo',$sexo);        

         $query = $this->db->get("", $maximo, $inicio);

         $listarEtadoCivil = array();

         $listarEtadoCivil[] = "<option>Selecione...</option>";

         foreach ($query->result_array() as $dados) {
            
            if ($id==$dados['id']) {

                $listarEtadoCivil[] = "<option value=".$dados['id']." selected>".$dados['estado_civil']."</option>";

             }else{

                $listarEtadoCivil[] = "<option value=".$dados['id'].">".$dados['estado_civil']."</option>";

             }                  

         }


         return $listarEtadoCivil;
    }

    //$dados=array(id=>?usuario=>?)

    function ver($id) {

         $this->db->from("COMBO_ESTADO_CIVIL");

         $this->db->where('id', $id);

         $this->db->where('COMBO_ESTADO_CIVIL.exclusao is null'); 

         $query = $this->db->get();

        return  $query->row_array();
    }


   function excluir($id) {

        $dados=array();

        $this->db->where('id', $id);

        $this->banco->usuario("COMBO_ESTADO_CIVIL");

        $dados['exclusao']=date("Y-m-d");

        $this->db->update("COMBO_ESTADO_CIVIL",$dados);
    }

    function deletar($id) {

         $this->db->where('id', $id);

         $this->db->where('COMBO_ESTADO_CIVIL.exclusao not null');   

         $this->db->delete("COMBO_ESTADO_CIVIL");
    
    }

}
