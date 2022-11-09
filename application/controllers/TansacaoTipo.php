<?php

class TansacaoTipo extends MY_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('paginacaonelos');

        $this->load->model('tansacao/TansacaoTipoModel');

        $this->load->model('admin/AcessoLoginModel');

        $this->AcessoLoginModel->redirecionar();
    }

    public function index(){

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"TansacaoTipo",'visualizar'=>1));

        $this->banco->conetarBanco() ;

        $config['action'] = site_url('TansacaoTipo/listar');

        $config['dadosTansacaoTipo'] = $this->TansacaoTipoModel->dados();

        $config['listaTansacaoTipo'] = $this->TansacaoTipoModel->listar();

        $this->load->view("tansacao/home",$config);

        $this->banco->desconetarBanco();

    }

    public function abas($id = null,$active,$titulo = null){

        $abas=array();

        $abas[] =array(
            'class'=>'TansacaoTipo',
            'url'=>site_url('/TansacaoTipo/ver/'.$id),
            'titulo'=>'TIPO',
            'icone'=>''
        );

        return abas($abas,$active,$titulo);
    }

    public function combos($dados=array()){

        $combos = array();

        return $combos;
    }


    public function listar($modal="false") {

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"TansacaoTipo",'visualizar'=>1));

        $this->banco->conetarBanco() ;

        $dados = $this->input->post();

        if(empty($dados)){

            $dados=recuperarFiltro('filtro_TansacaoTipo');
        }

        salvarFiltro('filtro_TansacaoTipo',$dados);

        $config= $this->combos();

        $config['action'] = site_url('TansacaoTipo/listar/'.$modal);

        $config['console'] = $this->load->view("layout/console","",true);

        $config['dadosTansacaoTipo'] = $this->TansacaoTipoModel->dados($dados);

        $inicio = (!$this->uri->segment("4")) ? 0 : $this->uri->segment("4");

        $paginacao=configPaginacao(MAXIMOPAGINA,'#telaPrincipal');

        $paginacao['base_url'] = site_url('TansacaoTipo/listar/'.$modal.'/');

        $paginacao['total_rows'] =   $this->TansacaoTipoModel->contarTotal($dados);

        $config['total'] =  $paginacao['total_rows'];

        $this->paginacaonelos->initialize($paginacao);

        $config['paginacao'] = $this->paginacaonelos->create_links();

        $config['modal'] = $modal;

        $config['listaTansacaoTipo'] = $this->TansacaoTipoModel->filtrar($dados,MAXIMOPAGINA,$inicio);

        $this->load->view("tansacao/listar_tansacao_tipo",$config);

        $this->banco->desconetarBanco();

    }

    public function incluir($modal="false"){

        $titulo="Cadastro de Tipo de Transação ";

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"TansacaoTipo",'incluir'=>1));

        $this->banco->conetarBanco() ;

        $dados= $this->TansacaoTipoModel->dados($this->input->post());

        $buscar= $this->TansacaoTipoModel->filtrar($dados);

        if($this->input->post()==true){

            if(empty($buscar)){

                $this->banco->abrirTransacao();

                $id_TansacaoTipo = $this->TansacaoTipoModel->incluir($dados);

                if ($this->banco->verificarTransacao() === FALSE) {

                    $this->session->set_flashdata('erro', 'Não foi possível realizar o cadastro da TansacaoTipo!');

                }else{

                    $this->banco->confirmarTransacao();

                    if(!empty($id_TansacaoTipo)){

                        $this->session->set_flashdata('sucesso', 'Cadastro da TansacaoTipo realizado com sucesso');

                    }
                }

            }else{

                $this->session->set_flashdata('erro', 'Já há um cadastro de TansacaoTipo com os mesmos dados');
            }


        }

        $config= $this->combos();

        $dadosTansacaoTipo = $this->TansacaoTipoModel->dados();

        $config['abas']=$this->abas('','', $titulo);

        $config['action'] = site_url('TansacaoTipo/incluir/'.$modal);

        $config['destino'] = site_url('TansacaoTipo/listar/'.$modal);

        $config['modal'] = $modal;

        if($modal=="true"){

            $config['target'] = ".vermodal";

        }else{

            $config['target'] = "#telaPrincipal";

        }

        $config['dadosTansacaoTipo'] =  $dadosTansacaoTipo;

        $this->load->view("tansacao/form_tansacao_tipo",$config);

        $this->banco->desconetarBanco();

    }

    public function editar($modal="false",$id) {

        $titulo="Editar de Tipo de Transação ";

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"TansacaoTipo",'editar'=>1));

        $this->banco->conetarBanco() ;

        $dados = $this->input->post();

        if($dados==true){

            $this->banco->abrirTransacao();

            $this->TansacaoTipoModel->editar($dados);

            if ($this->banco->verificarTransacao() === FALSE) {

             $this->session->set_flashdata('erro', 'Falha ao atualizar cadastro da TansacaoTipo!');

             } else {

                $this->banco->confirmarTransacao();

                $this->session->set_flashdata('sucesso', 'Atualização do cadastro da TansacaoTipo realizada com sucesso!');

            }


        }

        $config= $this->combos();

        $config['abas']=$this->abas('','', $titulo);

        $config['destino'] = site_url('TansacaoTipo/listar/'.$modal);

        $config['modal'] = $modal;

        if($modal=="true"){

            $config['target'] = ".vermodal";

        }else{

            $config['target'] = "#telaPrincipal";

        }

        $config['action'] = site_url('TansacaoTipo/editar/'.$modal.'/'.$id);

        $config['dadosTansacaoTipo'] = $this->TansacaoTipoModel->ver($id);

        $this->load->view("tansacao/form_tansacao_tipo",$config);

        $this->banco->desconetarBanco();

    }

    public function ver($id_TansacaoTipo) {

        $titulo=" Visualizar";

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"TansacaoTipo",'visualizar'=>1));

        $this->banco->conetarBanco() ;

        $config= $this->combos();

        $config['dadosTansacaoTipo'] = $this->TansacaoTipoModel->ver($id_TansacaoTipo);

        $config['abas'] = $this->abas($id_TansacaoTipo,'TansacaoTipo', $titulo);

        $config['console'] = $this->load->view("layout/console","",true);

        $this->load->view("tansacao/ver_tansacao_tipo",$config);

        $this->banco->desconetarBanco();

    }

    public function excluir($modal="false",$id) {

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"TansacaoTipo",'excluir'=>1));

        $this->banco->conetarBanco();

        $this->banco->abrirTransacao();

        $this->TansacaoTipoModel->excluir($id);

        if ($this->banco->verificarTransacao() === FALSE) {

            $this->session->set_flashdata('erro', 'Erro ao realizar exclusão da TansacaoTipo!');

        } else {

            $this->banco->confirmarTransacao();

            $this->session->set_flashdata('sucesso', 'Sucesso ao realizar exclusão da TansacaoTipo!');


        }

        redirect('TansacaoTipo/listar/'.$modal);

        $this->banco->desconetarBanco();
    }

    public function excluirEmMassa() {

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"TansacaoTipo",'excluir'=>1));

        $this->banco->conetarBanco();

        $this->banco->abrirTransacao();

        $dados= $this->input->post();

        foreach ($dados['selecionado'] as $id) {

            $this->TansacaoTipoModel->excluir($id);
        }

        if($this->banco->verificarTransacao() === FALSE) {

           $this->banco->cancelarTransacao();

           $this->session->set_flashdata('erro', 'Não foi possível excluir !');

       } else {

        $this->banco->confirmarTransacao();

        $this->session->set_flashdata('sucesso', 'Sucesso ao excluir pessoas! ');


        }

        $this->banco->desconetarBanco();

        redirect('TansacaoTipo/listar/false');
    }

    public function relatorio() {

        $dados = $this->input->post();

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"TansacaoTipo",'visualizar'=>1));

          salvarFiltro('filtro_TansacaoTipo',$dados);

          $titulo=" &#xf12e; Gerar Relatório/ tansacao_tipo";

          $config= $this->combos();

          $this->load->library("Pdf");

          $this->AcessoLoginModel->redirecionar();

          $this->banco->conetarBanco() ;

          $config['abas']=$this->abas('','', $titulo);

          $config['dadosTansacaoTipo'] = $this->TansacaoTipoModel->dados($dados);

          if($dados){

            $config['listaTansacaoTipo']=$this->TansacaoTipoModel->filtrar($dados);

            $config['total']=$this->TansacaoTipoModel->contarTotal($dados);

            $config['colunas']=10;

            $pdf= new Pdf('','', 0,0, 2,2,2,2);

            $pdf->loadView("tansacao/relatorio_tansacao_tipo",$config,"rel_tansacao_tipo");
          }else{

          $config['action'] = site_url('TansacaoTipo/relatorio');

          $this->load->view("tansacao/form_rel_tansacao_tipo",$config);


        }
          $this->banco->desconetarBanco();


    }





}
