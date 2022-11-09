<?php

class Cliente extends MY_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('paginacaonelos');

        $this->load->model('cliente/ClienteModel');

        $this->load->model('admin/AcessoLoginModel');

        $this->AcessoLoginModel->redirecionar();
    }

    public function index(){

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Cliente",'visualizar'=>1));

        $this->banco->conetarBanco() ;

        $config['action'] = site_url('Cliente/listar');

        $config['dadosCliente'] = $this->ClienteModel->dados();

        $config['listaCliente'] = $this->ClienteModel->listar();

        $this->load->view("cliente/home",$config);

        $this->banco->desconetarBanco();

    }

    public function abas($id = null,$active,$titulo = null){

        $abas=array();

        $abas[] =array(
            'class'=>'Cliente',
            'url'=>site_url('/Cliente/ver/'.$id),
            'titulo'=>'CLIENTE',
            'icone'=>''
        );

        return abas($abas,$active,$titulo);
    }

    public function combos($dados=array()){

        $combos = array();

        return $combos;
    }


    public function listar($ordem="asc") {

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Cliente",'visualizar'=>1));

        $this->banco->conetarBanco() ;

        $dados = $this->input->post();

        if(!empty($ordem)){

          $dados['ordem']=$ordem;

        }

        if(empty($dados)){

            $dados=recuperarFiltro('filtro_Cliente');
        }

        salvarFiltro('filtro_Cliente',$dados);

        $config= $this->combos();

        $config['action'] = site_url('Cliente/listar/');

        $config['console'] = $this->load->view("layout/console","",true);

        $config['dadosCliente'] = $this->ClienteModel->dados($dados);

        $inicio = (!$this->uri->segment("4")) ? 0 : $this->uri->segment("4");

        $paginacao=configPaginacao(MAXIMOPAGINA,'#telaPrincipal');

        $paginacao['base_url'] = site_url('Cliente/listar/');

        $paginacao['total_rows'] =   $this->ClienteModel->contarTotal($dados);

        $config['total'] =  $paginacao['total_rows'];

        $this->paginacaonelos->initialize($paginacao);

        $config['paginacao'] = $this->paginacaonelos->create_links();

        $config['modal'] = "false";

        $config['ordem'] = $ordem;

        $config['listaCliente'] = $this->ClienteModel->filtrar($dados,MAXIMOPAGINA,$inicio);

        $this->load->view("cliente/listar_cliente",$config);

        $this->banco->desconetarBanco();

    }

    public function incluir($modal="false",$agendar="false"){

        $titulo=" Cadastrar Cliente ";

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Cliente",'incluir'=>1));

        $this->banco->conetarBanco() ;

        $dados= $this->ClienteModel->dados($this->input->post());

        $buscar= $this->ClienteModel->filtrar($dados);

        if($this->input->post()==true){

            if(empty($buscar)){

                $this->banco->abrirTransacao();

                $id_Cliente = $this->ClienteModel->incluir($dados);

                if ($this->banco->verificarTransacao() === FALSE) {

                    $this->session->set_flashdata('erro', 'Não foi possível realizar o cadastro da Cliente!');

                }else{

                    $this->banco->confirmarTransacao();

                    if(!empty($id_Cliente)){

                        $this->session->set_flashdata('sucesso', 'Cadastro da Cliente realizado com sucesso');

                    }
                }

            }else{

                $this->session->set_flashdata('erro', 'Já há um cadastro de Cliente com os mesmos dados');
            }


        }

        $config= $this->combos();

        $dadosCliente = $this->ClienteModel->dados();

        $config['abas']=$this->abas('','', $titulo);

        $config['action'] = site_url('Cliente/incluir/'.$modal);



        if($agendar=="true"){

          $config['destino'] = site_url('Agenda/incluir/'.$modal);

        }else{

          $config['destino'] = site_url('Cliente/listar/'.$modal);
        }

        $config['modal'] = $modal;

        if($modal=="true"){

            $config['target'] = ".vermodal";

        }else{

            $config['target'] = "#telaPrincipal";

        }

        $config['dadosCliente'] =  $dadosCliente;

        $this->load->view("cliente/form_cliente",$config);

        $this->banco->desconetarBanco();

    }

    public function editar($modal="false",$id) {

        $titulo="Editar Cadastro de Cliente ";

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Cliente",'editar'=>1));

        $this->banco->conetarBanco() ;

        $dados = $this->input->post();

        if($dados==true){

            $this->banco->abrirTransacao();

            $this->ClienteModel->editar($dados);

            if ($this->banco->verificarTransacao() === FALSE) {

             $this->session->set_flashdata('erro', 'Falha ao atualizar cadastro da Cliente!');

             } else {

                $this->banco->confirmarTransacao();

                $this->session->set_flashdata('sucesso', 'Atualização do cadastro da Cliente realizada com sucesso!');

            }


        }

        $config= $this->combos();

        $config['abas']=$this->abas('','', $titulo);

        $config['destino'] = site_url('Cliente/listar/'.$modal);

        $config['modal'] = $modal;

        if($modal=="true"){

            $config['target'] = ".vermodal";

        }else{

            $config['target'] = "#telaPrincipal";

        }

        $config['action'] = site_url('Cliente/editar/'.$modal.'/'.$id);

        $config['dadosCliente'] = $this->ClienteModel->ver($id);

        $this->load->view("cliente/form_cliente",$config);

        $this->banco->desconetarBanco();

    }

    public function ver($id_Cliente) {

        $titulo=" Visualizar";

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Cliente",'visualizar'=>1));

        $this->banco->conetarBanco() ;

        $config= $this->combos();

        $config['dadosCliente'] = $this->ClienteModel->ver($id_Cliente);

        $config['abas'] = $this->abas($id_Cliente,'Cliente', $titulo);

        $config['console'] = $this->load->view("layout/console","",true);

        $this->load->view("cliente/ver_cliente",$config);

        $this->banco->desconetarBanco();

    }

    public function excluir($modal="false",$id) {

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Cliente",'excluir'=>1));

        $this->banco->conetarBanco();

        $this->banco->abrirTransacao();

        $this->ClienteModel->excluir($id);

        if ($this->banco->verificarTransacao() === FALSE) {

            $this->session->set_flashdata('erro', 'Erro ao realizar exclusão da Cliente!');

        } else {

            $this->banco->confirmarTransacao();

            $this->session->set_flashdata('sucesso', 'Sucesso ao realizar exclusão da Cliente!');


        }

        redirect('Cliente/listar/'.$modal);

        $this->banco->desconetarBanco();
    }

    public function excluirEmMassa() {

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Cliente",'excluir'=>1));

        $this->banco->conetarBanco();

        $this->banco->abrirTransacao();

        $dados= $this->input->post();

        foreach ($dados['selecionado'] as $id) {

            $this->ClienteModel->excluir($id);
        }

        if($this->banco->verificarTransacao() === FALSE) {

           $this->banco->cancelarTransacao();

           $this->session->set_flashdata('erro', 'Não foi possível excluir !');

       } else {

        $this->banco->confirmarTransacao();

        $this->session->set_flashdata('sucesso', 'Sucesso ao excluir pessoas! ');


        }

        $this->banco->desconetarBanco();

        redirect('Cliente/listar/false');
    }

    public function relatorio() {

        $dados = $this->input->post();

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Cliente",'visualizar'=>1));

          salvarFiltro('filtro_Cliente',$dados);

          $titulo=" &#xf12e; Gerar Relatório/ cliente";

          $config= $this->combos();

          $this->load->library("Pdf");

          $this->AcessoLoginModel->redirecionar();

          $this->banco->conetarBanco() ;

          $config['abas']=$this->abas('','', $titulo);

          $config['dadosCliente'] = $this->ClienteModel->dados($dados);

          if($dados){

            $config['listaCliente']=$this->ClienteModel->filtrar($dados);

            $config['total']=$this->ClienteModel->contarTotal($dados);

            $config['colunas']=10;

            $pdf= new Pdf('','', 0,0, 2,2,2,2);

            $pdf->loadView("cliente/relatorio_cliente",$config,"rel_cliente");
          }else{

          $config['action'] = site_url('Cliente/relatorio');

          $this->load->view("cliente/form_rel_cliente",$config);


        }
          $this->banco->desconetarBanco();


    }





}
