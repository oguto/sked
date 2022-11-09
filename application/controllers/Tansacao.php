<?php

class Tansacao extends MY_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('paginacaonelos');

        $this->load->model('tansacao/TansacaoModel');

        $this->load->model('admin/AcessoLoginModel');

        $this->load->model('tansacao/TansacaoTipoModel');

        $this->AcessoLoginModel->redirecionar();
    }

    public function index(){

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Tansacao",'visualizar'=>1));

        $this->banco->conetarBanco() ;

        $config['action'] = site_url('Tansacao/listar');

        $config['dadosTansacao'] = $this->TansacaoModel->dados();

        $config['listaTansacao'] = $this->TansacaoModel->listar();

        $this->load->view("tansacao/home",$config);

        $this->banco->desconetarBanco();

    }

    public function abas($id = null,$active,$titulo = null){

        $abas=array();

        $abas[] =array(
            'class'=>'Tansacao',
            'url'=>site_url('/Tansacao/ver/'.$id),
            'titulo'=>'TANSACAO',
            'icone'=>''
        );

        return abas($abas,$active,$titulo);
    }

    public function combos($dados=array()){

        $combos = array();

        $combos['objTansacaoTipo'] =$this->TansacaoTipoModel;

        $combos['objTansacao'] =$this->TansacaoModel;

        $combos['comboTansacaoTipo'] = arrayCombo("id","nome",$combos['objTansacaoTipo']->listar(),"Selecione...");

        return $combos;
    }


    public function listar($modal="false") {

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Tansacao",'visualizar'=>1));

        $this->banco->conetarBanco() ;

        $dados = $this->input->post();

        if(empty($dados)){

            $dados=recuperarFiltro('filtro_Tansacao');

            $dados['id_tipo']= $this->TansacaoTipoModel->listar()[0]['id'];
        }

        salvarFiltro('filtro_Tansacao',$dados);

        $config= $this->combos();

        $config['action'] = site_url('Tansacao/listar/'.$modal);

        $config['console'] = $this->load->view("layout/console","",true);

        $config['dadosTansacao'] = $this->TansacaoModel->dadosFiltro($dados);

        $inicio = (!$this->uri->segment("4")) ? 0 : $this->uri->segment("4");

        $paginacao=configPaginacao(MAXIMOPAGINA,'#telaPrincipal');

        $paginacao['base_url'] = site_url('Tansacao/listar/'.$modal.'/');

        $paginacao['total_rows'] =   $this->TansacaoModel->contarTotal($dados);

        $config['total'] =  $paginacao['total_rows'];

        $this->paginacaonelos->initialize($paginacao);

        $config['paginacao'] = $this->paginacaonelos->create_links();

        $config['modal'] = $modal;

        $config['listaTansacao'] = $this->TansacaoModel->filtrar($dados,MAXIMOPAGINA,$inicio);

        $this->load->view("tansacao/listar_tansacao",$config);

        $this->banco->desconetarBanco();

    }

    public function incluir($modal="false"){

        $titulo="&#xf344; Cadastro ";

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Tansacao",'incluir'=>1));

        $this->banco->conetarBanco() ;

        $dados= $this->TansacaoModel->dados($this->input->post());

        $buscar= $this->TansacaoModel->filtrar($dados);

        if($this->input->post()==true){

            if(empty($buscar)){

                $this->banco->abrirTransacao();

                $id_Tansacao = $this->TansacaoModel->incluir($dados);

                if ($this->banco->verificarTransacao() === FALSE) {

                    $this->session->set_flashdata('erro', 'Não foi possível realizar o cadastro da Tansacao!');

                }else{

                    $this->banco->confirmarTransacao();

                    if(!empty($id_Tansacao)){

                        $this->session->set_flashdata('sucesso', 'Cadastro da Tansacao realizado com sucesso');

                    }
                }

            }else{

                $this->session->set_flashdata('erro', 'Já há um cadastro de Tansacao com os mesmos dados');
            }


        }

        $config= $this->combos();

        $dadosTansacao = $this->TansacaoModel->dados();

        $config['abas']=$this->abas('','', $titulo);

        $config['action'] = site_url('Tansacao/incluir/'.$modal);

        $config['destino'] = site_url('Pagamento');

        $config['modal'] = $modal;

        if($modal=="true"){

            $config['target'] = ".vermodal";

        }else{

            $config['target'] = ".corpo";

        }

        $config['dadosTansacao'] =  $dadosTansacao;

        $this->load->view("tansacao/form_tansacao",$config);

        $this->banco->desconetarBanco();

    }

    public function editar($modal="false",$id) {

        $titulo="Editar ";

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Tansacao",'editar'=>1));

        $this->banco->conetarBanco() ;

        $dados = $this->input->post();

        if($dados==true){

            $this->banco->abrirTransacao();

            $this->TansacaoModel->editar($dados);

            if ($this->banco->verificarTransacao() === FALSE) {

             $this->session->set_flashdata('erro', 'Falha ao atualizar cadastro da Tansacao!');

             } else {

                $this->banco->confirmarTransacao();

                $this->session->set_flashdata('sucesso', 'Atualização do cadastro da Tansacao realizada com sucesso!');

            }


        }

        $config= $this->combos();

        $config['abas']=$this->abas('','', $titulo);

        $config['destino'] = site_url('Tansacao/listar/'.$modal);

        $config['modal'] = $modal;

        if($modal=="true"){

            $config['target'] = ".vermodal";

        }else{

            $config['target'] = "#telaPrincipal";

        }

        $config['action'] = site_url('Tansacao/editar/'.$modal.'/'.$id);

        $config['dadosTansacao'] = $this->TansacaoModel->ver($id);

        $this->load->view("tansacao/form_tansacao",$config);

        $this->banco->desconetarBanco();

    }

    public function ver($id_Tansacao) {

        $titulo=" Visualizar";

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Tansacao",'visualizar'=>1));

        $this->banco->conetarBanco() ;

        $config= $this->combos();

        $config['dadosTansacao'] = $this->TansacaoModel->ver($id_Tansacao);

        $config['abas'] = $this->abas($id_Tansacao,'Tansacao', $titulo);

        $config['console'] = $this->load->view("layout/console","",true);

        $this->load->view("tansacao/ver_tansacao",$config);

        $this->banco->desconetarBanco();

    }

    public function excluir($modal="false",$id) {

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Tansacao",'excluir'=>1));

        $this->banco->conetarBanco();

        $this->banco->abrirTransacao();

        $this->TansacaoModel->excluir($id);

        if ($this->banco->verificarTransacao() === FALSE) {

            $this->session->set_flashdata('erro', 'Erro ao realizar exclusão da Tansacao!');

        } else {

            $this->banco->confirmarTransacao();

            $this->session->set_flashdata('sucesso', 'Sucesso ao realizar exclusão da Tansacao!');


        }

        redirect('Tansacao/listar/'.$modal);

        $this->banco->desconetarBanco();
    }

    public function excluirEmMassa() {

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Tansacao",'excluir'=>1));

        $this->banco->conetarBanco();

        $this->banco->abrirTransacao();

        $dados= $this->input->post();

        foreach ($dados['selecionado'] as $id) {

            $this->TansacaoModel->excluir($id);
        }

        if($this->banco->verificarTransacao() === FALSE) {

           $this->banco->cancelarTransacao();

           $this->session->set_flashdata('erro', 'Não foi possível excluir !');

       } else {

        $this->banco->confirmarTransacao();

        $this->session->set_flashdata('sucesso', 'Sucesso ao excluir pessoas! ');


        }

        $this->banco->desconetarBanco();

        redirect('Tansacao/listar/false');
    }

    public function relatorio() {

        $dados = $this->input->post();

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Tansacao",'visualizar'=>1));

          salvarFiltro('filtro_Tansacao',$dados);

          $titulo=" &#xf12e; Gerar Relatório/ tansacao";

          $config= $this->combos();

          $this->load->library("Pdf");

          $this->AcessoLoginModel->redirecionar();

          $this->banco->conetarBanco() ;

          $config['abas']=$this->abas('','', $titulo);

          $config['dadosTansacao'] = $this->TansacaoModel->dados($dados);

          if($dados){

            $config['listaTansacao']=$this->TansacaoModel->filtrar($dados);

            $config['total']=$this->TansacaoModel->contarTotal($dados);

            $config['colunas']=10;

            $pdf= new Pdf('','', 0,0, 2,2,2,2);

            $pdf->loadView("tansacao/relatorio_tansacao",$config,"rel_tansacao");
          }else{

          $config['action'] = site_url('Tansacao/relatorio');

          $this->load->view("tansacao/form_rel_tansacao",$config);


        }
          $this->banco->desconetarBanco();


    }





}
