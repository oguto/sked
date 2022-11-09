<?php

class ControleAcessoModel extends CI_Model {


    public function __construct() {

        parent::__construct();


    }

    function dados($dados = array()) {

        $array = array();

        $array['id'] = null;

        $array['modulo'] = null;

        $array['geral'] = null;

        $array['editar'] = null;

        $array['visualizar'] = null;

        $array['incluir'] = null;

        $array['excluir'] = null;

        $array['id_grupo'] = null;

        $array['admin'] = $this->AcessoLoginModel->verAdmin();

        $array['exclusao'] = null;

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

        $this->db->insert("CONTROLE_ACESSO", $dados);

        return $this->db->insert_id();
    }

    function editar($dados) {

        $dados = array_filter($this->dados($dados));

        $this->db->where('CONTROLE_ACESSO.id', $dados['id']);

        $this->db->where('CONTROLE_ACESSO.exclusao is null');

        $this->banco->usuario("CONTROLE_ACESSO");

        $this->db->update("CONTROLE_ACESSO", $dados);
    }


    function listar($maximo = NULL, $inicio = NULL) {

        $this->db->from("CONTROLE_ACESSO");

        $this->db->where('CONTROLE_ACESSO.exclusao is null');

        $this->banco->usuario("CONTROLE_ACESSO");

        $query = $this->db->get("", $maximo, $inicio);

        return $query->result_array();
    }

     function filtrar($filtro,$maximo = NULL, $inicio = NULL){

        $this->db->from("CONTROLE_ACESSO");

        $this->db->where($filtro);

        $this->banco->usuario("CONTROLE_ACESSO");

        $query = $this->db->get("", $maximo, $inicio);

        return $query->result_array();

    }


    private function verificarSeMetodo($filtro){

        $this->load->database();

        $filtro['id_grupo']=$this->AcessoLoginModel->verGrupo();

        $this->db->from("CONTROLE_ACESSO");

        $this->db->where($filtro);

        $query = $this->db->get("");

        return $query->result_array();

        $this->db->close();



    }

    private function verificarSeGeral($filtro){

        $this->load->database();

        $filtro['id_grupo']=$this->AcessoLoginModel->verGrupo();

        $this->db->from("CONTROLE_ACESSO");

        $this->db->where($filtro);

        $query = $this->db->get("");

        return $query->result_array();

        $this->db->close();

    }

     function redirecionar($filtro){

        $user =$this->AcessoLoginModel->verLogin();


         $this->banco->conetarBanco() ;

        if($user['tipo']!=ADMIN){

            if(empty($this->verificarSeMetodo($filtro))){

                $this->session->set_flashdata('erro', 'Você não pode executar essa ação! ');

                $this->banco->desconetarBanco();

                redirect('home/acessobloqueado');


            }
        }

    }

    function bloqueio($filtro){

        $this->banco->conetarBanco() ;

        $liberado =0;

        $bloqueado =1;

         $user =$this->AcessoLoginModel->verLogin();


         if($user['tipo']!=ADMIN){

            if(!empty($this->verificarSeGeral($filtro))){

                if(!empty($this->verificarSeMetodo($filtro))){

                   return $liberado;
                }else{

                return $bloqueado;
                }


            }else{

                return $bloqueado;
            }



         }else{

            return $liberado;
        }

        $this->banco->desconetarBanco();


    }



    function ver($id) {

        $this->db->from("CONTROLE_ACESSO");

        $this->db->where('CONTROLE_ACESSO.id', $id);

        $this->db->where('CONTROLE_ACESSO.exclusao is null');

        $this->banco->usuario("CONTROLE_ACESSO");

        $query = $this->db->get();

        return $query->row_array();
    }


  function excluir($id) {

        $dados = array();

        $this->db->where('CONTROLE_ACESSO.id', $id);

        $this->banco->usuario("CONTROLE_ACESSO");

        $dados['exclusao']=date("Y-m-d");

        $this->db->update("CONTROLE_ACESSO",$dados);

    }

    function deletaPorUsuario($id_usuario) {

        $this->db->where('CONTROLE_ACESSO.id_usuario', $id_usuario);

        $this->banco->usuario("CONTROLE_ACESSO");

        $this->db->delete("CONTROLE_ACESSO");

    }

    function deletaPorGrupo($id_grupo) {

        $this->db->where('CONTROLE_ACESSO.id_grupo', $id_grupo);

        $this->banco->usuario("CONTROLE_ACESSO");

        $this->db->delete("CONTROLE_ACESSO");

    }

    function deletar($id) {

        $this->db->where('CONTROLE_ACESSO.id', $id);

        $this->db->where('CONTROLE_ACESSO.exclusao not null');

        $this->banco->usuario("CONTROLE_ACESSO");

        $this->db->delete("CONTROLE_ACESSO");

    }



}
