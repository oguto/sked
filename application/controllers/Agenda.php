<?php

class Agenda extends MY_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('paginacaonelos');

        $this->load->model('agenda/AgendaModel');

        $this->load->model('admin/AcessoLoginModel');

        $this->load->model('cliente/ClienteModel');

        $this->load->model('colaborador/ColaboradorModel');

        $this->load->model('servico/ServicoModel');

        $this->AcessoLoginModel->redirecionar();
    }

    public function index(){

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Agenda",'visualizar'=>1));

        $this->banco->conetarBanco() ;

        $dados =  array();

        if(empty($dados['data'])){
          $dados['data'] =date("Y-m-d");
        }


        $config['action'] = site_url('Agenda/listar');

        $config['dadosAgenda'] = $this->AgendaModel->dados($dados);

        $config['listaAgenda'] = $this->AgendaModel->filtrar($dados);

        $this->load->view("agenda/home",$config);

        $this->banco->desconetarBanco();

    }

    public function abas($id = null,$active,$titulo = null){

        $abas=array();

        $abas[] =array(
            'class'=>'Agenda',
            'url'=>site_url('/Agenda/ver/'.$id),
            'titulo'=>'AGENDA',
            'icone'=>''
        );

        return abas($abas,$active,$titulo);
    }

    public function combos($dados=array()){

        $combos = array();

        $combos['objCliente'] =$this->ClienteModel;

        $combos['objAgenda'] =$this->AgendaModel;

        $combos['comboCliente'] = arrayCombo("id","nome",$combos['objCliente']->listar(),"Cliente...");

        $combos['objColaborador'] =$this->ColaboradorModel;

        $combos['comboColaborador'] = arrayCombo("id","nome",$combos['objColaborador']->listar(),"Selecione...");

        $combos['objServico'] =$this->ServicoModel;

        $combos['comboServico'] = arrayCombo("id","nome",$combos['objServico']->listar(),"Serviço...");

        return $combos;
    }

    public function listar($modal="false") {

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Agenda",'visualizar'=>1));

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

        $this->load->view("agenda/listar_agenda",$config);

        $this->banco->desconetarBanco();

    }

    public function incluir($modal="false"){

        $titulo="Novo Agendamento";

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Agenda",'incluir'=>1));

        $this->banco->conetarBanco() ;

        $dados= $this->AgendaModel->dados($this->input->post());

        $buscar= $this->AgendaModel->filtrar($dados);

        if($this->input->post()==true){

            if(empty($buscar)){

                $this->banco->abrirTransacao();

                $id_Agenda = $this->AgendaModel->incluir($dados);

                if ($this->banco->verificarTransacao() === FALSE) {

                    $this->session->set_flashdata('erro', 'Não foi possível realizar o cadastro da Agenda!');

                }else{

                    $this->banco->confirmarTransacao();

                    if(!empty($id_Agenda)){

                        $this->session->set_flashdata('sucesso', 'Cadastro da Agenda realizado com sucesso');

                    }
                }

            }else{

                $this->session->set_flashdata('erro', 'Já há um cadastro de Agenda com os mesmos dados');
            }


        }

        $config= $this->combos();

        $dadosAgenda = $this->AgendaModel->dados();

        $config['abas']=$this->abas('','', $titulo);

        $config['action'] = site_url('Agenda/incluir/'.$modal);

        $config['destino'] = site_url('Agenda/listar/'.$modal);

        $config['modal'] = $modal;

        if($modal=="true"){

            $config['target'] = ".vermodal";

        }else{

            $config['target'] = ".conteudo";

        }

        $config['dadosAgenda'] =  $dadosAgenda;

        $this->load->view("agenda/form_agenda",$config);

        $this->banco->desconetarBanco();

    }

    public function editar($modal="false",$id) {

        $titulo="Editar Agendamento ";

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Agenda",'editar'=>1));

        $this->banco->conetarBanco() ;

        $dados = $this->input->post();

        if($dados==true){

            $this->banco->abrirTransacao();

            $this->AgendaModel->editar($dados);

            if ($this->banco->verificarTransacao() === FALSE) {

             $this->session->set_flashdata('erro', 'Falha ao atualizar cadastro da Agenda!');

             } else {

                $this->banco->confirmarTransacao();

                $this->session->set_flashdata('sucesso', 'Atualização do cadastro da Agenda realizada com sucesso!');

            }


        }

        $config= $this->combos();

        $config['abas']=$this->abas('','', $titulo);

        $config['destino'] = site_url('Agenda/listar/'.$modal);

        $config['modal'] = $modal;

        if($modal=="true"){

            $config['target'] = ".vermodal";

        }else{

            $config['target'] = ".conteudo";

        }

        $config['action'] = site_url('Agenda/editar/'.$modal.'/'.$id);

        $config['dadosAgenda'] = $this->AgendaModel->ver($id);

        $this->load->view("agenda/form_agenda",$config);

        $this->banco->desconetarBanco();

    }

    public function ver($id_Agenda) {

        $titulo=" Visualizar";

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Agenda",'visualizar'=>1));

        $this->banco->conetarBanco() ;

        $config= $this->combos();

        $config['dadosAgenda'] = $this->AgendaModel->ver($id_Agenda);

        $config['abas'] = $this->abas($id_Agenda,'Agenda', $titulo);

        $config['console'] = $this->load->view("layout/console","",true);

        $this->load->view("agenda/ver_agenda",$config);

        $this->banco->desconetarBanco();

    }

    public function excluir($modal="false",$id) {

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Agenda",'excluir'=>1));

        $this->banco->conetarBanco();

        $this->banco->abrirTransacao();

        $this->AgendaModel->excluir($id);

        if ($this->banco->verificarTransacao() === FALSE) {

            $this->session->set_flashdata('erro', 'Erro ao realizar exclusão da Agenda!');

        } else {

            $this->banco->confirmarTransacao();

            $this->session->set_flashdata('sucesso', 'Sucesso ao realizar exclusão da Agenda!');


        }

        redirect('Agenda/listar/'.$modal);

        $this->banco->desconetarBanco();
    }

    public function excluirEmMassa() {

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Agenda",'excluir'=>1));

        $this->banco->conetarBanco();

        $this->banco->abrirTransacao();

        $dados= $this->input->post();

        foreach ($dados['selecionado'] as $id) {

            $this->AgendaModel->excluir($id);
        }

        if($this->banco->verificarTransacao() === FALSE) {

           $this->banco->cancelarTransacao();

           $this->session->set_flashdata('erro', 'Não foi possível excluir !');

       } else {

        $this->banco->confirmarTransacao();

        $this->session->set_flashdata('sucesso', 'Sucesso ao excluir pessoas! ');


        }

        $this->banco->desconetarBanco();

        redirect('Agenda/listar/false');
    }

    public function relatorio() {

        $dados = $this->input->post();

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Agenda",'visualizar'=>1));

          salvarFiltro('filtro_Agenda',$dados);

          $titulo=" &#xf12e; Gerar Relatório/ agenda";

          $config= $this->combos();

          $this->load->library("Pdf");

          $this->AcessoLoginModel->redirecionar();

          $this->banco->conetarBanco() ;

          $config['abas']=$this->abas('','', $titulo);

          $config['dadosAgenda'] = $this->AgendaModel->dados($dados);

          if($dados){

            $config['listaAgenda']=$this->AgendaModel->filtrar($dados);

            $config['total']=$this->AgendaModel->contarTotal($dados);

            $config['colunas']=10;

            $pdf= new Pdf('','', 0,0, 2,2,2,2);

            $pdf->loadView("agenda/relatorio_agenda",$config,"rel_agenda");
          }else{

          $config['action'] = site_url('Agenda/relatorio');

          $this->load->view("agenda/form_rel_agenda",$config);


        }
          $this->banco->desconetarBanco();


    }





}
