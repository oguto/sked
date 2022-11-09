<?php

class Estado extends CI_Model {
 
     function dados($dados) {

         $array = array();

         if (isset($dados['id'])and $dados['id'] != null) {

             $array['id'] = $dados['id'];

         }

         $array['nome'] = $dados['nome'];

         $array['uf'] = $dados['uf'];

         $array['pais'] = $dados['pais'];         

         return $array;
    }


   
   

    function editar($dados) {

         $dados = array_filter($this->dados($dados));

         $this->db->where('id', $dados['id']);
 
          $this->db->update("ESTADO", $dados);
    }

    //$dados=array(categoria=>?usuario=>?)
    
    function listar($maximo = NULL, $inicio = NULL) {

         $this->db->from("ESTADO");

         $query = $this->db->get("", $maximo, $inicio);

         $listar = array();

         foreach ($query->result_array() as $dados) {

             $listar[] = $dados;
         }

         return $listar;
    }


    function listarCombo( $id=null,$maximo = NULL, $inicio = NULL) {

         $this->db->from("ESTADO");

         $query = $this->db->get("", $maximo, $inicio);

         $listar = array();

          $listar[]= "<option value= >Selecione o estado</option>";

         foreach ($query->result_array() as $dados) {

                if ($dados['id']==$id) {
                     $listar[]= "<option value=".$dados['id']." selected>".$dados['nome']."</option>";

                }else{

                     $listar[]= "<option value=".$dados['id'].">".$dados['nome']."</option>";


                }


          
         }

         return $listar;
    }

    //$dados=array(id=>?usuario=>?)

    function ver($id) {

         $this->db->from("ESTADO");

         $this->db->where('id', $id);

         $query = $this->db->get();

         $pessoa = NULL;

         if($query->row_array() != NULL) {

             $pessoa = $query->row_array();
         }
         return $pessoa;
    }

}
