<?php

class Produto extends MY_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('paginacaonelos');

        $this->load->model('produto/ProdutoModel');

        $this->load->model('admin/AcessoLoginModel');

        $this->AcessoLoginModel->redirecionar();
    }

    public function index(){

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Produto",'visualizar'=>1));

        $this->banco->conetarBanco() ;

        $config['action'] = site_url('Produto/listar');

        $config['dadosProduto'] = $this->ProdutoModel->dados();

        $config['listaProduto'] = $this->ProdutoModel->listar();

        $this->load->view("produto/home",$config);

        $this->banco->desconetarBanco();

    }

    public function abas($id = null,$active,$titulo = null){

        $abas=array();

        $abas[] =array(
            'class'=>'Produto',
            'url'=>site_url('/Produto/ver/'.$id),
            'titulo'=>'PRODUTO',
            'icone'=>''
        );

        return abas($abas,$active,$titulo);
    }

    public function combos($dados=array()){

        $combos = array();

        return $combos;
    }


    public function listar($order="asc") {

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Produto",'visualizar'=>1));

        $this->banco->conetarBanco() ;

        $dados = $this->input->post();

        if($order){

          $dados['ordem']=$order;

        }

        if(empty($dados)){

            $dados=recuperarFiltro('filtro_Produto');
        }

        salvarFiltro('filtro_Produto',$dados);

        $config= $this->combos();

        $config['action'] = site_url('Produto/listar/'.$order);

        $config['console'] = $this->load->view("layout/console","",true);

        $config['dadosProduto'] = $this->ProdutoModel->dados($dados);

        $inicio = (!$this->uri->segment("4")) ? 0 : $this->uri->segment("4");

        $paginacao=configPaginacao(MAXIMOPAGINA,'#telaPrincipal');

        $paginacao['base_url'] = site_url('Produto/listar/'.$order.'/');

        $paginacao['total_rows'] =   $this->ProdutoModel->contarTotal($dados);

        $config['total'] =  $paginacao['total_rows'];

        $config['modal'] = "false";

        $config['ordem'] = $order;

        $this->paginacaonelos->initialize($paginacao);

        $config['paginacao'] = $this->paginacaonelos->create_links();

        $config['listaProduto'] = $this->ProdutoModel->filtrar($dados,MAXIMOPAGINA,$inicio);

        $this->load->view("produto/listar_produto",$config);

        $this->banco->desconetarBanco();

    }

    public function incluir($modal="false"){

        $titulo=" Cadastro de Produto";

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Produto",'incluir'=>1));

        $this->banco->conetarBanco() ;

        $dados= $this->ProdutoModel->dados($this->input->post());

        $buscar= $this->ProdutoModel->filtrar($dados);

        if($this->input->post()==true){

            if(empty($buscar)){

                $this->banco->abrirTransacao();

                $id_Produto = $this->ProdutoModel->incluir($dados);

                if ($this->banco->verificarTransacao() === FALSE) {

                    $this->session->set_flashdata('erro', 'Não foi possível realizar o cadastro da Produto!');

                }else{

                    $this->banco->confirmarTransacao();

                    if(!empty($id_Produto)){

                        $this->session->set_flashdata('sucesso', 'Cadastro da Produto realizado com sucesso');

                    }
                }

            }else{

                $this->session->set_flashdata('erro', 'Já há um cadastro de Produto com os mesmos dados');
            }


        }

        $config= $this->combos();

        $dadosProduto = $this->ProdutoModel->dados();

        $config['abas']=$this->abas('','', $titulo);

        $config['action'] = site_url('Produto/incluir/'.$modal);

        $config['destino'] = site_url('Produto/listar/'.$modal);

        $config['modal'] = $modal;

        if($modal=="true"){

            $config['target'] = ".vermodal";

        }else{

            $config['target'] = "#telaPrincipal";

        }

        $config['dadosProduto'] =  $dadosProduto;

        $this->load->view("produto/form_produto",$config);

        $this->banco->desconetarBanco();

    }

    public function editar($modal="false",$id) {

        $titulo="Editar Produto ";

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Produto",'editar'=>1));

        $this->banco->conetarBanco() ;

        $dados = $this->input->post();

        if($dados==true){

            $this->banco->abrirTransacao();

            $this->ProdutoModel->editar($dados);

            if ($this->banco->verificarTransacao() === FALSE) {

             $this->session->set_flashdata('erro', 'Falha ao atualizar cadastro da Produto!');

             } else {

                $this->banco->confirmarTransacao();

                $this->session->set_flashdata('sucesso', 'Atualização do cadastro da Produto realizada com sucesso!');

            }


        }

        $config= $this->combos();

        $config['abas']=$this->abas('','', $titulo);

        $config['destino'] = site_url('Produto/listar/'.$modal);

        $config['modal'] = $modal;

        if($modal=="true"){

            $config['target'] = ".vermodal";

        }else{

            $config['target'] = "#telaPrincipal";

        }

        $config['action'] = site_url('Produto/editar/'.$modal.'/'.$id);

        $config['dadosProduto'] = $this->ProdutoModel->ver($id);

        $this->load->view("produto/form_produto",$config);

        $this->banco->desconetarBanco();

    }

    public function ver($id_Produto) {

        $titulo=" Visualizar";

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Produto",'visualizar'=>1));

        $this->banco->conetarBanco() ;

        $config= $this->combos();

        $config['dadosProduto'] = $this->ProdutoModel->ver($id_Produto);

        $config['abas'] = $this->abas($id_Produto,'Produto', $titulo);

        $config['console'] = $this->load->view("layout/console","",true);

        $this->load->view("produto/ver_produto",$config);

        $this->banco->desconetarBanco();

    }

    public function excluir($modal="false",$id) {

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Produto",'excluir'=>1));

        $this->banco->conetarBanco();

        $this->banco->abrirTransacao();

        $this->ProdutoModel->excluir($id);

        if ($this->banco->verificarTransacao() === FALSE) {

            $this->session->set_flashdata('erro', 'Erro ao realizar exclusão da Produto!');

        } else {

            $this->banco->confirmarTransacao();

            $this->session->set_flashdata('sucesso', 'Sucesso ao realizar exclusão da Produto!');


        }

        redirect('Produto/listar/'.$modal);

        $this->banco->desconetarBanco();
    }

    public function excluirEmMassa() {

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Produto",'excluir'=>1));

        $this->banco->conetarBanco();

        $this->banco->abrirTransacao();

        $dados= $this->input->post();

        foreach ($dados['selecionado'] as $id) {

            $this->ProdutoModel->excluir($id);
        }

        if($this->banco->verificarTransacao() === FALSE) {

           $this->banco->cancelarTransacao();

           $this->session->set_flashdata('erro', 'Não foi possível excluir !');

       } else {

        $this->banco->confirmarTransacao();

        $this->session->set_flashdata('sucesso', 'Sucesso ao excluir pessoas! ');


        }

        $this->banco->desconetarBanco();

        redirect('Produto/listar/false');
    }

    public function relatorio() {

        $dados = $this->input->post();

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Produto",'visualizar'=>1));

          salvarFiltro('filtro_Produto',$dados);

          $titulo=" &#xf12e; Gerar Relatório/ produto";

          $config= $this->combos();

          $this->load->library("Pdf");

          $this->AcessoLoginModel->redirecionar();

          $this->banco->conetarBanco() ;

          $config['abas']=$this->abas('','', $titulo);

          $config['dadosProduto'] = $this->ProdutoModel->dados($dados);

          if($dados){

            $config['listaProduto']=$this->ProdutoModel->filtrar($dados);

            $config['total']=$this->ProdutoModel->contarTotal($dados);

            $config['colunas']=10;

            $pdf= new Pdf('','', 0,0, 2,2,2,2);

            $pdf->loadView("produto/relatorio_produto",$config,"rel_produto");
          }else{

          $config['action'] = site_url('Produto/relatorio');

          $this->load->view("produto/form_rel_produto",$config);


        }
          $this->banco->desconetarBanco();


    }





}
