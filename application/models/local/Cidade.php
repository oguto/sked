<?php

 class Cidade extends CI_Model {
 
     function dados($dados) {

         $array = array();

         if (isset($dados['id'])and $dados['id'] != null) {

             $array['id'] = $dados['id'];

         }

         $array['nome'] = $dados['nome'];

         $array['estado'] = $dados['estado'];              

         return $array;
        }


     function editar($dados) {

         $dados = array_filter($this->dados($dados));

         $this->db->where('id', $dados['id']);
 
         $this->db->update("CIDADE", $dados);
     }

     //$dados=array(categoria=>?usuario=>?)
    
     function listar($maximo = NULL, $inicio = NULL) {

         $this->db->from("CIDADE");

         $query = $this->db->get("", $maximo, $inicio);

         $listaPessoa = array();

         foreach ($query->result_array() as $dados) {

             $listaPessoa[] = $dados;
         }

         return $listaPessoa;
     }

     function listarCombo($id=null,$id_cidade=NULL) {

         $this->db->from("CIDADE");

         if($id!=null){
             $this->db->where('estado', $id); 
         }         

         $query = $this->db->get();

         $listar = array();

         $listar[]= "<option value= >Selecione a cidade</option>";

         foreach ($query->result_array() as $dados) {

            $selected="";

            if($dados['id']==$id_cidade){
                
                $selected="selected";
            }

             $listar[]= "<option value=".$dados['id']." ".$selected.">".$dados['nome']."</option>";
          
         }

         return $listar;
     }
 
     //$dados=array(id=>?usuario=>?)

     function ver($id) {

         $this->db->from("CIDADE");

         $this->db->where('id', $id);

         $query = $this->db->get();

         $pessoa = NULL;

         if($query->row_array() != NULL) {

             $pessoa = $query->row_array();
         }
         return $pessoa;
     } 

}
