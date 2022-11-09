<?php

class PagamentoMetodo extends MY_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('paginacaonelos');

        $this->load->model('pagamento/PagamentoMetodoModel');

        $this->load->model('admin/AcessoLoginModel');

        $this->AcessoLoginModel->redirecionar();
    }

    public function index(){

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"PagamentoMetodo",'visualizar'=>1));

        $this->banco->conetarBanco() ;

        $config['action'] = site_url('PagamentoMetodo/listar');

        $config['dadosPagamentoMetodo'] = $this->PagamentoMetodoModel->dados();

        $config['listaPagamentoMetodo'] = $this->PagamentoMetodoModel->listar();

        $this->load->view("pagamento/homeConfig",$config);

        $this->banco->desconetarBanco();

    }

    public function abas($id = null,$active,$titulo = null){

        $abas=array();

        $abas[] =array(
            'class'=>'PagamentoMetodo',
            'url'=>site_url('/PagamentoMetodo/ver/'.$id),
            'titulo'=>'METODO',
            'icone'=>''
        );

        return abas($abas,$active,$titulo);
    }

    public function combos($dados=array()){

        $combos = array();

        return $combos;
    }


    public function listar($modal="false") {

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"PagamentoMetodo",'visualizar'=>1));

        $this->banco->conetarBanco() ;

        $dados = $this->input->post();

        if(empty($dados)){

            $dados=recuperarFiltro('filtro_PagamentoMetodo');
        }

        salvarFiltro('filtro_PagamentoMetodo',$dados);

        $config= $this->combos();

        $config['action'] = site_url('PagamentoMetodo/listar/'.$modal);

        $config['console'] = $this->load->view("layout/console","",true);

        $config['dadosPagamentoMetodo'] = $this->PagamentoMetodoModel->dados($dados);

        $inicio = (!$this->uri->segment("4")) ? 0 : $this->uri->segment("4");

        $paginacao=configPaginacao(MAXIMOPAGINA,'#telaPrincipal');

        $paginacao['base_url'] = site_url('PagamentoMetodo/listar/'.$modal.'/');

        $paginacao['total_rows'] =   $this->PagamentoMetodoModel->contarTotal($dados);

        $config['total'] =  $paginacao['total_rows'];

        $this->paginacaonelos->initialize($paginacao);

        $config['paginacao'] = $this->paginacaonelos->create_links();

        $config['modal'] = $modal;

        $config['listaPagamentoMetodo'] = $this->PagamentoMetodoModel->filtrar($dados,MAXIMOPAGINA,$inicio);

        $this->load->view("pagamento/listar_pagamento_metodo",$config);

        $this->banco->desconetarBanco();

    }

    public function incluir($modal="false"){

        $titulo=" Cadastro ";

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"PagamentoMetodo",'incluir'=>1));

        $this->banco->conetarBanco() ;

        $dados= $this->PagamentoMetodoModel->dados($this->input->post());

        $buscar= $this->PagamentoMetodoModel->filtrar($dados);

        if($this->input->post()==true){

            if(empty($buscar)){

                $this->banco->abrirTransacao();

                $id_PagamentoMetodo = $this->PagamentoMetodoModel->incluir($dados);

                if ($this->banco->verificarTransacao() === FALSE) {

                    $this->session->set_flashdata('erro', 'Não foi possível realizar o cadastro da PagamentoMetodo!');

                }else{

                    $this->banco->confirmarTransacao();

                    if(!empty($id_PagamentoMetodo)){

                        $this->session->set_flashdata('sucesso', 'Cadastro da PagamentoMetodo realizado com sucesso');

                    }
                }

            }else{

                $this->session->set_flashdata('erro', 'Já há um cadastro de PagamentoMetodo com os mesmos dados');
            }


        }

        $config= $this->combos();

        $dadosPagamentoMetodo = $this->PagamentoMetodoModel->dados();

        $config['abas']=$this->abas('','', $titulo);

        $config['action'] = site_url('PagamentoMetodo/incluir/'.$modal);

        $config['destino'] = site_url('PagamentoMetodo/listar/'.$modal);

        $config['modal'] = $modal;

        if($modal=="true"){

            $config['target'] = ".vermodal";

        }else{

            $config['target'] = "#telaPrincipal";

        }

        $config['dadosPagamentoMetodo'] =  $dadosPagamentoMetodo;

        $this->load->view("pagamento/form_pagamento_metodo",$config);

        $this->banco->desconetarBanco();

    }

    public function editar($modal="false",$id) {

        $titulo="Editar ";

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"PagamentoMetodo",'editar'=>1));

        $this->banco->conetarBanco() ;

        $dados = $this->input->post();

        if($dados==true){

            $this->banco->abrirTransacao();

            $this->PagamentoMetodoModel->editar($dados);

            if ($this->banco->verificarTransacao() === FALSE) {

             $this->session->set_flashdata('erro', 'Falha ao atualizar cadastro da PagamentoMetodo!');

             } else {

                $this->banco->confirmarTransacao();

                $this->session->set_flashdata('sucesso', 'Atualização do cadastro da PagamentoMetodo realizada com sucesso!');

            }


        }

        $config= $this->combos();

        $config['abas']=$this->abas('','', $titulo);

        $config['destino'] = site_url('PagamentoMetodo/listar/'.$modal);

        $config['modal'] = $modal;

        if($modal=="true"){

            $config['target'] = ".vermodal";

        }else{

            $config['target'] = "#telaPrincipal";

        }

        $config['action'] = site_url('PagamentoMetodo/editar/'.$modal.'/'.$id);

        $config['dadosPagamentoMetodo'] = $this->PagamentoMetodoModel->ver($id);

        $this->load->view("pagamento/form_pagamento_metodo",$config);

        $this->banco->desconetarBanco();

    }

    public function ver($id_PagamentoMetodo) {

        $titulo=" Visualizar";

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"PagamentoMetodo",'visualizar'=>1));

        $this->banco->conetarBanco() ;

        $config= $this->combos();

        $config['dadosPagamentoMetodo'] = $this->PagamentoMetodoModel->ver($id_PagamentoMetodo);

        $config['abas'] = $this->abas($id_PagamentoMetodo,'PagamentoMetodo', $titulo);

        $config['console'] = $this->load->view("layout/console","",true);

        $this->load->view("pagamento/ver_pagamento_metodo",$config);

        $this->banco->desconetarBanco();

    }

    public function excluir($modal="false",$id) {

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"PagamentoMetodo",'excluir'=>1));

        $this->banco->conetarBanco();

        $this->banco->abrirTransacao();

        $this->PagamentoMetodoModel->excluir($id);

        if ($this->banco->verificarTransacao() === FALSE) {

            $this->session->set_flashdata('erro', 'Erro ao realizar exclusão da PagamentoMetodo!');

        } else {

            $this->banco->confirmarTransacao();

            $this->session->set_flashdata('sucesso', 'Sucesso ao realizar exclusão da PagamentoMetodo!');


        }

        redirect('PagamentoMetodo/listar/'.$modal);

        $this->banco->desconetarBanco();
    }

    public function excluirEmMassa() {

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"PagamentoMetodo",'excluir'=>1));

        $this->banco->conetarBanco();

        $this->banco->abrirTransacao();

        $dados= $this->input->post();

        foreach ($dados['selecionado'] as $id) {

            $this->PagamentoMetodoModel->excluir($id);
        }

        if($this->banco->verificarTransacao() === FALSE) {

           $this->banco->cancelarTransacao();

           $this->session->set_flashdata('erro', 'Não foi possível excluir !');

       } else {

        $this->banco->confirmarTransacao();

        $this->session->set_flashdata('sucesso', 'Sucesso ao excluir pessoas! ');


        }

        $this->banco->desconetarBanco();

        redirect('PagamentoMetodo/listar/false');
    }

    public function relatorio() {

        $dados = $this->input->post();

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"PagamentoMetodo",'visualizar'=>1));

          salvarFiltro('filtro_PagamentoMetodo',$dados);

          $titulo=" &#xf12e; Gerar Relatório/ pagamento_metodo";

          $config= $this->combos();

          $this->load->library("Pdf");

          $this->AcessoLoginModel->redirecionar();

          $this->banco->conetarBanco() ;

          $config['abas']=$this->abas('','', $titulo);

          $config['dadosPagamentoMetodo'] = $this->PagamentoMetodoModel->dados($dados);

          if($dados){

            $config['listaPagamentoMetodo']=$this->PagamentoMetodoModel->filtrar($dados);

            $config['total']=$this->PagamentoMetodoModel->contarTotal($dados);

            $config['colunas']=10;

            $pdf= new Pdf('','', 0,0, 2,2,2,2);

            $pdf->loadView("pagamento/relatorio_pagamento_metodo",$config,"rel_pagamento_metodo");
          }else{

          $config['action'] = site_url('PagamentoMetodo/relatorio');

          $this->load->view("pagamento/form_rel_pagamento_metodo",$config);


        }
          $this->banco->desconetarBanco();


    }





}
