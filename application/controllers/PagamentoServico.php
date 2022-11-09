<?php

class PagamentoServico extends MY_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('paginacaonelos');

        $this->load->model('pagamento/PagamentoServicoModel');

        $this->load->model('admin/AcessoLoginModel');

        $this->load->model('servico/ServicoModel');

        $this->load->model('pagamento/PagamentoModel');

        $this->AcessoLoginModel->redirecionar();
    }

    public function index(){

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"PagamentoServico",'visualizar'=>1));

        $this->banco->conetarBanco() ;

        $config['action'] = site_url('PagamentoServico/listar');

        $config['dadosPagamentoServico'] = $this->PagamentoServicoModel->dados();

        $config['listaPagamentoServico'] = $this->PagamentoServicoModel->listar();

        $this->load->view("pagamento/home",$config);

        $this->banco->desconetarBanco();

    }

    public function abas($id = null,$active,$titulo = null){

        $abas=array();

        $abas[] =array(
            'class'=>'PagamentoServico',
            'url'=>site_url('/PagamentoServico/ver/'.$id),
            'titulo'=>'SERVICO',
            'icone'=>''
        );

        return abas($abas,$active,$titulo);
    }

    public function combos($dados=array()){

        $combos = array();

        $combos['objServico'] =$this->ServicoModel;

        $combos['comboServico'] = arrayCombo("id","id",$combos['objServico']->listar(),"Selecione...");

        $combos['objPagamento'] =$this->PagamentoModel;

        $combos['comboPagamento'] = arrayCombo("id","id",$combos['objPagamento']->listar(),"Selecione...");

        return $combos;
    }


    public function listar($modal="false") {

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"PagamentoServico",'visualizar'=>1));

        $this->banco->conetarBanco() ;

        $dados = $this->input->post();

        if(empty($dados)){

            $dados=recuperarFiltro('filtro_PagamentoServico');
        }

        salvarFiltro('filtro_PagamentoServico',$dados);

        $config= $this->combos();

        $config['action'] = site_url('PagamentoServico/listar/'.$modal);

        $config['console'] = $this->load->view("layout/console","",true);

        $config['dadosPagamentoServico'] = $this->PagamentoServicoModel->dados($dados);

        $inicio = (!$this->uri->segment("4")) ? 0 : $this->uri->segment("4");

        $paginacao=configPaginacao(MAXIMOPAGINA,'#telaPrincipal');

        $paginacao['base_url'] = site_url('PagamentoServico/listar/'.$modal.'/');

        $paginacao['total_rows'] =   $this->PagamentoServicoModel->contarTotal($dados);

        $config['total'] =  $paginacao['total_rows'];

        $this->paginacaonelos->initialize($paginacao);

        $config['paginacao'] = $this->paginacaonelos->create_links();

        $config['modal'] = $modal;

        $config['listaPagamentoServico'] = $this->PagamentoServicoModel->filtrar($dados,MAXIMOPAGINA,$inicio);

        $this->load->view("pagamento/listar_pagamento_servico",$config);

        $this->banco->desconetarBanco();

    }

    public function incluir($modal="false"){

        $titulo="&#xf344; Cadastro ";

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"PagamentoServico",'incluir'=>1));

        $this->banco->conetarBanco() ;

        $dados= $this->PagamentoServicoModel->dados($this->input->post());

        $buscar= $this->PagamentoServicoModel->filtrar($dados);

        if($this->input->post()==true){

            if(empty($buscar)){

                $this->banco->abrirTransacao();

                $id_PagamentoServico = $this->PagamentoServicoModel->incluir($dados);

                if ($this->banco->verificarTransacao() === FALSE) {

                    $this->session->set_flashdata('erro', 'Não foi possível realizar o cadastro da PagamentoServico!');

                }else{

                    $this->banco->confirmarTransacao();

                    if(!empty($id_PagamentoServico)){

                        $this->session->set_flashdata('sucesso', 'Cadastro da PagamentoServico realizado com sucesso');

                    }
                }

            }else{

                $this->session->set_flashdata('erro', 'Já há um cadastro de PagamentoServico com os mesmos dados');
            }


        }

        $config= $this->combos();

        $dadosPagamentoServico = $this->PagamentoServicoModel->dados();

        $config['abas']=$this->abas('','', $titulo);

        $config['action'] = site_url('PagamentoServico/incluir/'.$modal);

        $config['destino'] = site_url('PagamentoServico/listar/'.$modal);

        $config['modal'] = $modal;

        if($modal=="true"){

            $config['target'] = ".vermodal";

        }else{

            $config['target'] = "#telaPrincipal";

        }

        $config['dadosPagamentoServico'] =  $dadosPagamentoServico;

        $this->load->view("pagamento/form_pagamento_servico",$config);

        $this->banco->desconetarBanco();

    }

    public function editar($modal="false",$id) {

        $titulo="Editar ";

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"PagamentoServico",'editar'=>1));

        $this->banco->conetarBanco() ;

        $dados = $this->input->post();

        if($dados==true){

            $this->banco->abrirTransacao();

            $this->PagamentoServicoModel->editar($dados);

            if ($this->banco->verificarTransacao() === FALSE) {

             $this->session->set_flashdata('erro', 'Falha ao atualizar cadastro da PagamentoServico!');

             } else {

                $this->banco->confirmarTransacao();

                $this->session->set_flashdata('sucesso', 'Atualização do cadastro da PagamentoServico realizada com sucesso!');

            }


        }

        $config= $this->combos();

        $config['abas']=$this->abas('','', $titulo);

        $config['destino'] = site_url('Pagamento/listar/'.$modal);

        $config['modal'] = $modal;

        if($modal=="true"){

            $config['target'] = ".vermodal";

        }else{

            $config['target'] = "#pgtSked";

        }

        $config['action'] = site_url('PagamentoServico/editar/'.$modal.'/'.$id);

        $config['dadosPagamentoServico'] = $this->PagamentoServicoModel->ver($id);

        $this->load->view("pagamento/form_pagamento_servico",$config);

        $this->banco->desconetarBanco();

    }

    public function ver($id_PagamentoServico) {

        $titulo=" Visualizar";

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"PagamentoServico",'visualizar'=>1));

        $this->banco->conetarBanco() ;

        $config= $this->combos();

        $config['dadosPagamentoServico'] = $this->PagamentoServicoModel->ver($id_PagamentoServico);

        $config['abas'] = $this->abas($id_PagamentoServico,'PagamentoServico', $titulo);

        $config['console'] = $this->load->view("layout/console","",true);

        $this->load->view("pagamento/ver_pagamento_servico",$config);

        $this->banco->desconetarBanco();

    }

    public function excluir($modal="false",$id) {

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"PagamentoServico",'excluir'=>1));

        $this->banco->conetarBanco();

        $this->banco->abrirTransacao();

        $this->PagamentoServicoModel->excluir($id);

        if ($this->banco->verificarTransacao() === FALSE) {

            $this->session->set_flashdata('erro', 'Erro ao realizar exclusão da PagamentoServico!');

        } else {

            $this->banco->confirmarTransacao();

            $this->session->set_flashdata('sucesso', 'Sucesso ao realizar exclusão da PagamentoServico!');


        }

        redirect('PagamentoServico/listar/'.$modal);

        $this->banco->desconetarBanco();
    }

    public function excluirEmMassa() {

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"PagamentoServico",'excluir'=>1));

        $this->banco->conetarBanco();

        $this->banco->abrirTransacao();

        $dados= $this->input->post();

        foreach ($dados['selecionado'] as $id) {

            $this->PagamentoServicoModel->excluir($id);
        }

        if($this->banco->verificarTransacao() === FALSE) {

           $this->banco->cancelarTransacao();

           $this->session->set_flashdata('erro', 'Não foi possível excluir !');

       } else {

        $this->banco->confirmarTransacao();

        $this->session->set_flashdata('sucesso', 'Sucesso ao excluir pessoas! ');


        }

        $this->banco->desconetarBanco();

        redirect('PagamentoServico/listar/false');
    }

    public function relatorio() {

        $dados = $this->input->post();

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"PagamentoServico",'visualizar'=>1));

          salvarFiltro('filtro_PagamentoServico',$dados);

          $titulo=" &#xf12e; Gerar Relatório/ pagamento_servico";

          $config= $this->combos();

          $this->load->library("Pdf");

          $this->AcessoLoginModel->redirecionar();

          $this->banco->conetarBanco() ;

          $config['abas']=$this->abas('','', $titulo);

          $config['dadosPagamentoServico'] = $this->PagamentoServicoModel->dados($dados);

          if($dados){

            $config['listaPagamentoServico']=$this->PagamentoServicoModel->filtrar($dados);

            $config['total']=$this->PagamentoServicoModel->contarTotal($dados);

            $config['colunas']=10;

            $pdf= new Pdf('','', 0,0, 2,2,2,2);

            $pdf->loadView("pagamento/relatorio_pagamento_servico",$config,"rel_pagamento_servico");
          }else{

          $config['action'] = site_url('PagamentoServico/relatorio');

          $this->load->view("pagamento/form_rel_pagamento_servico",$config);


        }
          $this->banco->desconetarBanco();


    }





}
