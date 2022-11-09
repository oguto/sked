<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Home extends MY_Controller {

    public function __construct() {

        parent::__construct();

          $this->load->library('paginacaonelos');

        $this->load->model('admin/ControleAcessoModel');

        $this->load->model('agenda/AgendaModel');

        $this->load->model('admin/AcessoLoginModel');

        $this->load->model('cliente/ClienteModel');

        $this->load->model('colaborador/ColaboradorModel');

        $this->load->model('servico/ServicoModel');



    }


   function index($content = NULL) {

        $this->AcessoLoginModel->redirecionar();

        $this->banco->conetarBanco() ;


        $prefs = array (
               'start_day'    => 'saturday',
               'month_type'   => 'long',
               'day_type'     => 'short'
             );

        $this->load->library('calendarioagenda', $prefs);

        $config['acesso'] = $this->ControleAcessoModel;

        $config['console'] = $this->load->view("layout/console","",true);

        $this->banco->desconetarBanco();

        $info = array(
            "header" => $this->load->view("layout/header", "", TRUE),
            "menu" => $this->load->view("layout/menu", $config, TRUE),
            "content" =>  $this->principal(TRUE),
            "footer" => $this->load->view("layout/footer", "", TRUE),
            "modal" => $this->load->view("layout/modal", "", TRUE),
            "css" =>$this->load->view("layout/css", "", TRUE),
            "script" =>$this->load->view("layout/script", "", TRUE)
        );

        $this->load->view("layout/container", $info);
    }


    public function combos($dados=array()){

        $combos = array();

        $combos['objCliente'] =$this->ClienteModel;

        $combos['comboCliente'] = arrayCombo("id","nome",$combos['objCliente']->listar(),"Selecione...");

        $combos['objColaborador'] =$this->ColaboradorModel;

          $combos['objAgenda'] =$this->AgendaModel;

        $combos['comboColaborador'] = arrayCombo("id","nome",$combos['objColaborador']->listar(),"Selecione...");

        $combos['objServico'] =$this->ServicoModel;

        $combos['comboServico'] = arrayCombo("id","nome",$combos['objServico']->listar(),"Selecione...");

        return $combos;
    }



    function principal($content=FALSE) {

        $modal="false";

        $this->AcessoLoginModel->redirecionar();

        $this->banco->conetarBanco() ;

        $this->banco->conetarBanco() ;

        $dados = $this->input->post();

        if(empty($dados)){

            $dados=recuperarFiltro('filtro_Agenda');
        }

        if(empty($dados['data'])){
          $dados['data'] =date("Y-m-d");
        }

        salvarFiltro('filtro_Agenda',$dados);

        $config= $this->combos();

        $config['action'] = site_url('Agenda/listar/'.$modal);

        $config['console'] = $this->load->view("layout/console","",true);

        $config['dadosAgenda'] = $this->AgendaModel->dados($dados);

        $inicio = (!$this->uri->segment("4")) ? 0 : $this->uri->segment("4");

        $paginacao=configPaginacao(MAXIMOPAGINA,'#telaPrincipal');

        $paginacao['base_url'] = site_url('Agenda/listar/'.$modal.'/');

        $paginacao['total_rows'] =   $this->AgendaModel->contarTotal($dados);

        $config['total'] =  $paginacao['total_rows'];

        $this->paginacaonelos->initialize($paginacao);

        $config['paginacao'] = $this->paginacaonelos->create_links();

        $config['modal'] = $modal;

        $config['listaAgenda'] = $this->AgendaModel->filtrar($dados,MAXIMOPAGINA,$inicio);


        if($content){

           return $this->load->view("agenda/listar_agenda", $config,TRUE);

        } else{

            $this->load->view("agenda/listar_agenda", $config,FALSE);

        }



        $this->banco->desconetarBanco();
    }

   function frame($content = NULL) {

        $this->load->view("frame");
    }

    function push() {

        print_r(msgPush('teste',array('0'=>'csmP1J-qrho:APA91bF8mjtbxQ0RL8d0Tj_xoBXoEsVwPPT7ha4BHkXDgCAS4458MFRES4l_R9QEhTw4d3cp_midv_ycfOyfnd78LonqYcnNL4Ve4CjjIh3-80DULioBUyggrk38XifQhvMw5IrdScPh')));
    }


    function acessobloqueado(){

         $this->load->view("layout/console","");
    }

}
