<?php


class PagamentoServicoModel extends CI_Model {
    function __construct() {

        parent::__construct();

        $this->load->model('admin/AcessoLoginModel');

        $this->tabela = 'PAGAMENTO_SERVICO';

    }

    function dados($dados = array()) {

        $array = array();

        $array['id'] =null;

        $array['id_servico'] =null;

        $array['id_profissional'] =null;

        $array['id_pagamento'] =null;

        $array['valor'] =null;

        $array['desconto'] =null;

        $array['data'] =null;

        $array['admin'] =$this->AcessoLoginModel->verAdmin();

        $array['exclusao'] =null;

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

        $dados['data'] =date("Y-m-d");

        $this->db->insert("PAGAMENTO_SERVICO", $dados);

        return $this->db->insert_id();
    }

    function editar($dados) {

        $dados = array_filter($this->dados($dados));

        $this->db->where('PAGAMENTO_SERVICO.id', $dados['id']);

        $this->db->where('PAGAMENTO_SERVICO.exclusao is null');

        $this->banco->usuario("PAGAMENTO_SERVICO");

        $this->db->update("PAGAMENTO_SERVICO", $dados);
    }

    function listar($maximo = NULL, $inicio = NULL) {

        $this->db->from("PAGAMENTO_SERVICO");

        $this->db->where('PAGAMENTO_SERVICO.exclusao is null');

        $this->banco->usuario("PAGAMENTO_SERVICO");

        $query = $this->db->get("", $maximo, $inicio);

        return $query->result_array();
    }

    function filtrar($filtro=array(),$maximo = NULL, $inicio = NULL){

      if(!empty($filtro['id_colaborador'])){

        $filtro['id_profissional']=$filtro['id_colaborador'];


      }

      if($filtro['filtro_de']==$filtro['filtro_ate']){

          $this->db->where('PAGAMENTO.data',$filtro['filtro_de']);

      }else{

        if(!empty($filtro['filtro_de'])){

            $this->db->where('PAGAMENTO.data>=',$filtro['filtro_de']);


        }

         if(!empty($filtro['filtro_ate'])){

            $this->db->where('PAGAMENTO.data<=',$filtro['filtro_ate']);

          }
        }

      if(!empty($filtro['id_metodo_pagamento'])){

         $this->db->where('PAGAMENTO.id_metodo_pagamento',$filtro['id_metodo_pagamento']);

     }



        $filtro=array_filter($this->dados($filtro));

        unset($filtro['admin']);

        unset($filtro['id_colaborador']);

        $this->db->select("PAGAMENTO_SERVICO.*,PAGAMENTO.id_cliente");

        $this->db->select("SERVICO.nome AS nome_servico");

        $this->db->select("CLIENTE.nome AS nome_cliente");

          $this->db->select("PAGAMENTO_METODO.nome AS metodo");

          $this->db->select("COLABORADOR.nome AS nome_profissional");

        $this->db->from("PAGAMENTO_SERVICO");

        $this->db->join("SERVICO","SERVICO.id=PAGAMENTO_SERVICO.id_servico","left");

        $this->db->join("PAGAMENTO","PAGAMENTO.id=PAGAMENTO_SERVICO.id_pagamento","left");

        $this->db->join("COLABORADOR","COLABORADOR.id=PAGAMENTO_SERVICO.id_profissional","left");

        $this->db->join("CLIENTE","CLIENTE.id=PAGAMENTO.id_cliente","left");

        $this->db->join("PAGAMENTO_METODO","PAGAMENTO_METODO.id=PAGAMENTO.id_metodo_pagamento","left");

        $this->db->where($filtro);

        $this->db->where('PAGAMENTO_SERVICO.exclusao is null');

        $this->banco->usuario("PAGAMENTO_SERVICO");

        $query = $this->db->get("", $maximo, $inicio);

        return $query->result_array();

    }

    function ver($id) {

        $this->db->from("PAGAMENTO_SERVICO");

        $this->db->where('PAGAMENTO_SERVICO.id', $id);

        $this->db->where('PAGAMENTO_SERVICO.exclusao is null');

        $this->banco->usuario("PAGAMENTO_SERVICO");

        $query = $this->db->get();

        return $query->row_array();
    }

    function excluir($id) {

        $dados = array();

        $this->db->where('PAGAMENTO_SERVICO.id', $id);

        $this->banco->usuario("PAGAMENTO_SERVICO");

        $dados['exclusao']=date("Y-m-d");

        $this->db->update("PAGAMENTO_SERVICO",$dados);

    }

    function deletar($id) {

        $this->db->where('PAGAMENTO_SERVICO.id', $id);

        $this->db->where('PAGAMENTO_SERVICO.exclusao not null');

        $this->banco->usuario("PAGAMENTO_SERVICO");

        $this->db->delete("PAGAMENTO_SERVICO");

    }

    function contarTotal($filtro=false) {

        $this->db->select('*');

        $this->db->select('PAGAMENTO_SERVICO.id as id');

        $this->db->from("PAGAMENTO_SERVICO");

        $this->db->where('PAGAMENTO_SERVICO.exclusao is null');

        if(!empty($filtro['id_colaborador'])){

          $filtro['id_profissional']=$filtro['id_colaborador'];


        }


        if(!empty($filtro)){

            $filtro = array_filter($this->dados($filtro));

            $this->db->like($filtro);

        }

        $this->banco->usuario("PAGAMENTO_SERVICO");

        return $this->db->get()->num_rows();

    }


    function valorTotal($filtro=false) {

        $this->db->select_sum('PAGAMENTO_SERVICO.valor');

        $this->db->from("PAGAMENTO_SERVICO");

        $this->db->where('PAGAMENTO_SERVICO.exclusao is null');


        if(!empty($filtro['id_colaborador'])){

          $filtro['id_profissional']=$filtro['id_colaborador'];


        }
        if($filtro['filtro_de']==$filtro['filtro_ate']){

            $this->db->where('PAGAMENTO.data',$filtro['filtro_de']);

        }else{

          if(!empty($filtro['filtro_de'])){

              $this->db->where('PAGAMENTO.data>=',$filtro['filtro_de']);


          }

           if(!empty($filtro['filtro_ate'])){

              $this->db->where('PAGAMENTO.data<=',$filtro['filtro_ate']);

            }
          }

        if(!empty($filtro['id_metodo_pagamento'])){

           $this->db->where('PAGAMENTO.id_metodo_pagamento',$filtro['id_metodo_pagamento']);

       }






        if(!empty($filtro)){

            $filtro = array_filter($this->dados($filtro));

            unset($filtro['admin']);


            $this->db->like($filtro);

        }

        $this->db->join("PAGAMENTO","PAGAMENTO.id=PAGAMENTO_SERVICO.id_pagamento","left");

        $this->banco->usuario("PAGAMENTO_SERVICO");

        return $this->db->get()->result_array();

    }
}
