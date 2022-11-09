<?php

class ControleAcesso extends MY_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('paginacaonelos');

        $this->load->model('{PASTA_SISTEMA}admin/AcessoLoginModel');

        $this->load->model('/controle/ControleAcessoModel');



    }

    public function index(){

        $this->AcessoLoginModel->redirecionar();

        $this->banco->conetarBanco() ;

        $config['action'] = site_url('ControleAcesso/listar');

        $config['dadosControleAcesso'] = $this->ControleAcessoModel->dados();

        $config['listaControleAcesso'] = $this->ControleAcessoModel->listar();

        $this->load->view("controle/home",$config);

        $this->banco->desconetarBanco();

    }

    public function abas($id = null,$active,$titulo = null){

        $abas=array();

        $abas[] =array(
            'class'=>'ControleAcesso',
            'url'=>site_url('/ControleAcesso/ver/'.$id),
            'titulo'=>'ACESSO',
            'icone'=>''
        );

        return abas($abas,$active,$titulo);
    }

    public function combos($dados=array()){

        $combos = array();

        return $combos;
    }


    public function incluir($content = NULL) {

        $titulo="&#xf17f; Incluir Usuário";

        $this->AcessoLoginModel->redirecionar();

        $this->banco->conetarBanco() ;

        $dados=$this->input->post();

        if($this->input->post()==true){

            $this->banco->abrirTransacao();

            $dados['senha'] =senha($dados['senha']);

            $id_user= $this->UsuarioModel->incluir($dados);

            $this->ControleAcessoModel->deletaPorUsuario($id_user);

            if(!empty($dados['acess_cadatrar'])){

                foreach ($dados['acess_cadatrar'] as  $key => $value) {

                    $array = array();

                    $array['modulo'] = $key;

                    $array['incluir'] = $value;

                    $array['id_grupo'] = $id_user;

                    $this->ControleAcessoModel->incluir($array);
                }
            }
            if(!empty($dados['acess_visualizar'])){
                foreach ($dados['acess_visualizar'] as $key => $value) {

                    $array = array();

                    $array['modulo'] = $key;

                    $array['visualizar'] = $value;

                    $array['id_grupo'] = $id_user;

                    $this->ControleAcessoModel->incluir($array);
                }
            }
            if(!empty($dados['acess_editar'])){
                foreach ($dados['acess_editar'] as $key => $value) {

                    $array = array();

                    $array['modulo'] = $key;

                    $array['editar'] = $value;

                    $array['id_grupo'] = $id_user;

                    $this->ControleAcessoModel->incluir($array);
                }
            }
            if(!empty($dados['acess_excluir'])){
                foreach ($dados['acess_excluir'] as $key => $value) {

                    $array = array();

                    $array['modulo'] = $key;

                    $array['excluir'] = $value;

                    $array['id_grupo'] = $id_user;

                    $this->ControleAcessoModel->incluir($array);
                }
            }

            if ($this->banco->verificarTransacao() === FALSE) {

              $this->session->set_flashdata('erro', 'Não foi possível realizar o cadastro de usuário!');

            } else {

                $this->banco->confirmarTransacao();

                if(!empty($id_user)){

                    $this->session->set_flashdata('sucesso', 'Cadastro de usuário realizado com sucesso');

                }

            }

        }

        $config['usuario']= $this->AcessoLoginModel->dados();

        $config['grupo']= $this->AcessoLoginModel->dados();

        $config['acesso']= $this->ControleAcessoModel;

        $config['action'] = site_url('ControleAcesso/incluir');

        $config['urlList'] = site_url('ControleAcesso/incluir');

        $config['abas'] = $this->abas("","user",$titulo);

        $config['controleAdmin']=$this->load->view('admin/form_controle_acesso',$config,true);

        $config['controleAgenda']=$this->load->view('agenda/form_controle_acesso',$config,true);

        $config['controleCliente']=$this->load->view('cliente/form_controle_acesso',$config,true);

        $config['controleColaborador']=$this->load->view('colaborador/form_controle_acesso',$config,true);

        $config['controlePagamento']=$this->load->view('pagamento/form_controle_acesso',$config,true);

        $config['controleProduto']=$this->load->view('produto/form_controle_acesso',$config,true);

        $config['controleServico']=$this->load->view('servico/form_controle_acesso',$config,true);

        $config['controleTansacao']=$this->load->view('tansacao/form_controle_acesso',$config,true);



        $config['console'] = $this->load->view("layout/console","",true);

        $this->load->view("controle/form_controle_acesso",$config);
    }


    public function editar($id){


        $titulo="&#xf17f; Editar Usuário";

        $this->AcessoLoginModel->redirecionar();

        $this->banco->conetarBanco() ;

        $dados=$this->input->post();

        if($this->input->post()==true){

            $this->banco->abrirTransacao();

            $this->ControleAcessoModel->deletaPorGrupo($dados['id']);

            if(!empty($dados['acess_cadatrar'])){

                foreach ($dados['acess_cadatrar'] as  $key => $value) {

                    $array = array();

                    $array['modulo'] = $key;

                    $array['incluir'] = 1;

                    $array['id_grupo'] = $id;

                    $this->ControleAcessoModel->incluir($array);
                }
            }
            if(!empty($dados['acess_visualizar'])){
                foreach ($dados['acess_visualizar'] as $key => $value) {

                    $array = array();

                    $array['modulo'] = $key;

                    $array['visualizar'] = 1;

                    $array['id_grupo'] = $id;

                    $this->ControleAcessoModel->incluir($array);
                }
            }
            if(!empty($dados['acess_editar'])){
                foreach ($dados['acess_editar'] as $key => $value) {

                    $array = array();

                    $array['modulo'] = $key;

                    $array['editar'] = 1;

                    $array['id_grupo'] = $id;

                    $this->ControleAcessoModel->incluir($array);
                }
            }
            if(!empty($dados['acess_excluir'])){
                foreach ($dados['acess_excluir'] as $key => $value) {

                    $array = array();

                    $array['modulo'] = $key;

                    $array['excluir'] = 1;

                    $array['id_grupo'] = $id;

                    $this->ControleAcessoModel->incluir($array);
                }
            }

            if ($this->banco->verificarTransacao() === FALSE) {

                $this->session->set_flashdata('erro', 'Não foi possível editar o cadastro de usuário!');

            } else {

                $this->banco->confirmarTransacao();

                $this->session->set_flashdata('sucesso', 'Cadastro de usuário alterado com sucesso');


            }

        }


        $config['acesso']= $this->ControleAcessoModel;

        $config['id']= $id;

        $config['grupo']= $this->AcessoLoginModel->dados(array('id'=>$id));

        $config['action'] = site_url('ControleAcesso/editar/'.$id);

        $config['urlList'] = site_url('ControleAcesso/editar/'.$id);

        $config['abas'] = $this->abas("","user","&#xf17f; Usuário");

        $config['controleAdmin']=$this->load->view('admin/form_controle_acesso',$config,true);

    $config['controleAgenda']=$this->load->view('agenda/form_controle_acesso',$config,true);

    $config['controleCliente']=$this->load->view('cliente/form_controle_acesso',$config,true);

    $config['controleColaborador']=$this->load->view('colaborador/form_controle_acesso',$config,true);

    $config['controlePagamento']=$this->load->view('pagamento/form_controle_acesso',$config,true);

    $config['controleProduto']=$this->load->view('produto/form_controle_acesso',$config,true);

    $config['controleServico']=$this->load->view('servico/form_controle_acesso',$config,true);

    $config['controleTansacao']=$this->load->view('tansacao/form_controle_acesso',$config,true);



        $config['console'] = $this->load->view("layout/console","",true);

        $this->load->view("controle/form_controle_acesso",$config);

    }


}
