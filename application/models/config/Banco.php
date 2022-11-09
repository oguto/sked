<?php

class Banco extends CI_Model {

    function conetarBanco() {
        $this->load->database();
    }

    function desconetarBanco() {
        $this->db->close();
    }
    function abrirTransacao() {
        $this->db->trans_begin();
    }
    function verificarTransacao() {
       return $this->db->trans_status();
    }
    function confirmarTransacao() {
       $this->db->trans_commit();
    }

    function cancelarTransacao() {
        $this->db->trans_rollback();
    }

    function fecharTransacao(){

        if($this->db->trans_status()){

             $this->db->trans_commit();

        }else{

             $this->db->trans_rollback();

        }



    }

    function usuario($tabela=null) {

      $this->db->where($tabela.".admin",$this->AcessoLoginModel->verAdmin()); 

    }

    function tratarDados($array=array(),$keyArray=array(),$keyUnset=array()){

        $array=array_filter($array);

        foreach ($keyArray as $key => $value) {
                if (!isset($array[$key])) {
                    $array[$key]=null;
                }
            }

        foreach ($keyUnset as $key => $value) {
                   unset($array[$key]);

            }

        unset($array['data']);

        unset($array['admin']);

        unset($array['usuario']);

        unset($array['grupo']);

        unset($array['exclusao']);

        return $array;
    }





}
