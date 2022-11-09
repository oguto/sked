<?php

class Admin extends MY_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('paginacaonelos');

        $this->load->model('admin/AdminModel');

        $this->load->model('admin/AcessoLoginModel');

        $this->AcessoLoginModel->redirecionar();
    }

    public function index(){

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Admin",'visualizar'=>1));

        $this->banco->conetarBanco() ;

        $config['action'] = site_url('Admin/listar');

        $config['dadosAdmin'] = $this->AdminModel->dados();

        $config['listaAdmin'] = $this->AdminModel->listar();

        $this->load->view("admin/home",$config);

        $this->banco->desconetarBanco();

    }

    public function abas($id = null,$active,$titulo = null){

        $abas=array();

        $abas[] =array(
            'class'=>'Admin',
            'url'=>site_url('/Admin/ver/'.$id),
            'titulo'=>'ADMIN',
            'icone'=>''
        );

        return abas($abas,$active,$titulo);
    }

    public function combos($dados=array()){

        $combos = array();

        return $combos;
    }


    public function listar($modal="false") {

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Admin",'visualizar'=>1));

        $this->banco->conetarBanco() ;

        $dados = $this->input->post();

        if(empty($dados)){

            $dados=recuperarFiltro('filtro_Admin');
        }

        salvarFiltro('filtro_Admin',$dados);

        $config= $this->combos();

        $config['action'] = site_url('Admin/listar/'.$modal);

        $config['console'] = $this->load->view("layout/console","",true);

        $config['dadosAdmin'] = $this->AdminModel->dados($dados);

        $inicio = (!$this->uri->segment("4")) ? 0 : $this->uri->segment("4");

        $paginacao=configPaginacao(MAXIMOPAGINA,'#telaPrincipal');

        $paginacao['base_url'] = site_url('Admin/listar/'.$modal.'/');

        $paginacao['total_rows'] =   $this->AdminModel->contarTotal($dados);

        $config['total'] =  $paginacao['total_rows'];

        $this->paginacaonelos->initialize($paginacao);

        $config['paginacao'] = $this->paginacaonelos->create_links();

        $config['modal'] = $modal;

        $config['listaAdmin'] = $this->AdminModel->filtrar($dados,MAXIMOPAGINA,$inicio);

        $this->load->view("admin/listar_admin",$config);

        $this->banco->desconetarBanco();

    }

    public function incluir($modal="false"){

        $titulo="&#xf344; Cadastro ";

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Admin",'incluir'=>1));

        $this->banco->conetarBanco() ;

        $dados= $this->AdminModel->dados($this->input->post());

        $buscar= $this->AdminModel->filtrar($dados);

        if($this->input->post()==true){

            if(empty($buscar)){

                $this->banco->abrirTransacao();

                $id_Admin = $this->AdminModel->incluir($dados);

                if ($this->banco->verificarTransacao() === FALSE) {

                    $this->session->set_flashdata('erro', 'Não foi possível realizar o cadastro da Admin!');

                }else{

                    $this->banco->confirmarTransacao();

                    if(!empty($id_Admin)){

                        $this->session->set_flashdata('sucesso', 'Cadastro da Admin realizado com sucesso');

                    }
                }

            }else{

                $this->session->set_flashdata('erro', 'Já há um cadastro de Admin com os mesmos dados');
            }


        }

        $config= $this->combos();

        $dadosAdmin = $this->AdminModel->dados();

        $config['abas']=$this->abas('','', $titulo);

        $config['action'] = site_url('Admin/incluir/'.$modal);

        $config['destino'] = site_url('Admin/listar/'.$modal);

        $config['modal'] = $modal;

        if($modal=="true"){

            $config['target'] = ".vermodal";

        }else{

            $config['target'] = "#telaPrincipal";

        }

        $config['dadosAdmin'] =  $dadosAdmin;

        $this->load->view("admin/form_admin",$config);

        $this->banco->desconetarBanco();

    }

    public function editar($modal="false",$id) {

        $titulo="Editar ";

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Admin",'editar'=>1));

        $this->banco->conetarBanco() ;

        $dados = $this->input->post();

        if($dados==true){

            $this->banco->abrirTransacao();

            $this->AdminModel->editar($dados);

            if ($this->banco->verificarTransacao() === FALSE) {

             $this->session->set_flashdata('erro', 'Falha ao atualizar cadastro da Admin!');

             } else {

                $this->banco->confirmarTransacao();

                $this->session->set_flashdata('sucesso', 'Atualização do cadastro da Admin realizada com sucesso!');

            }


        }

        $config= $this->combos();

        $config['abas']=$this->abas('','', $titulo);

        $config['destino'] = site_url('Admin/listar/'.$modal);

        $config['modal'] = $modal;

        if($modal=="true"){

            $config['target'] = ".vermodal";

        }else{

            $config['target'] = "#telaPrincipal";

        }

        $config['action'] = site_url('Admin/editar/'.$modal.'/'.$id);

        $config['dadosAdmin'] = $this->AdminModel->ver($id);

        $this->load->view("admin/form_admin",$config);

        $this->banco->desconetarBanco();

    }

    public function ver($id_Admin) {

        $titulo=" Visualizar";

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Admin",'visualizar'=>1));

        $this->banco->conetarBanco() ;

        $config= $this->combos();

        $config['dadosAdmin'] = $this->AdminModel->ver($id_Admin);

        $config['abas'] = $this->abas($id_Admin,'Admin', $titulo);

        $config['console'] = $this->load->view("layout/console","",true);

        $this->load->view("admin/ver_admin",$config);

        $this->banco->desconetarBanco();

    }

    public function excluir($modal="false",$id) {

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Admin",'excluir'=>1));

        $this->banco->conetarBanco();

        $this->banco->abrirTransacao();

        $this->AdminModel->excluir($id);

        if ($this->banco->verificarTransacao() === FALSE) {

            $this->session->set_flashdata('erro', 'Erro ao realizar exclusão da Admin!');

        } else {

            $this->banco->confirmarTransacao();

            $this->session->set_flashdata('sucesso', 'Sucesso ao realizar exclusão da Admin!');


        }

        redirect('Admin/listar/'.$modal);

        $this->banco->desconetarBanco();
    }

    public function excluirEmMassa() {

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Admin",'excluir'=>1));

        $this->banco->conetarBanco();

        $this->banco->abrirTransacao();

        $dados= $this->input->post();

        foreach ($dados['selecionado'] as $id) {

            $this->AdminModel->excluir($id);
        }

        if($this->banco->verificarTransacao() === FALSE) {

           $this->banco->cancelarTransacao();

           $this->session->set_flashdata('erro', 'Não foi possível excluir !');

       } else {

        $this->banco->confirmarTransacao();

        $this->session->set_flashdata('sucesso', 'Sucesso ao excluir pessoas! ');


        }

        $this->banco->desconetarBanco();

        redirect('Admin/listar/false');
    }

    public function relatorio() {

        $dados = $this->input->post();

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Admin",'visualizar'=>1));

          salvarFiltro('filtro_Admin',$dados);

          $titulo=" &#xf12e; Gerar Relatório/ admin";

          $config= $this->combos();

          $this->load->library("Pdf");

          $this->AcessoLoginModel->redirecionar();

          $this->banco->conetarBanco() ;

          $config['abas']=$this->abas('','', $titulo);

          $config['dadosAdmin'] = $this->AdminModel->dados($dados);

          if($dados){

            $config['listaAdmin']=$this->AdminModel->filtrar($dados);

            $config['total']=$this->AdminModel->contarTotal($dados);

            $config['colunas']=10;

            $pdf= new Pdf('','', 0,0, 2,2,2,2);

            $pdf->loadView("admin/relatorio_admin",$config,"rel_admin");
          }else{

          $config['action'] = site_url('Admin/relatorio');

          $this->load->view("admin/form_rel_admin",$config);


        }
          $this->banco->desconetarBanco();


    }





}
