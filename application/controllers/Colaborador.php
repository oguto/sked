<?php

class Colaborador extends MY_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('paginacaonelos');

        $this->load->model('colaborador/ColaboradorModel');

        $this->load->model('grupo/GrupoModel');

        $this->load->model('usuario/UsuarioModel');

        $this->load->model('admin/AcessoLoginModel');

        $this->AcessoLoginModel->redirecionar();
    }

    public function index(){

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Colaborador",'visualizar'=>1));

        $this->banco->conetarBanco() ;

        $config['action'] = site_url('Colaborador/listar');

        $config['dadosColaborador'] = $this->ColaboradorModel->dados();

        $config['listaColaborador'] = $this->ColaboradorModel->listar();

        $this->load->view("colaborador/home",$config);

        $this->banco->desconetarBanco();

    }

    public function abas($id = null,$active,$titulo = null){

        $abas=array();

        $abas[] =array(
            'class'=>'Colaborador',
            'url'=>site_url('/Colaborador/ver/'.$id),
            'titulo'=>'COLABORADOR',
            'icone'=>''
        );

        return abas($abas,$active,$titulo);
    }

    public function combos($dados=array()){

        $combos = array();

        $combos['objGrupo'] =$this->GrupoModel;

        $combos['comboGrupo'] = arrayCombo("id","nome",$combos['objGrupo']->listar(),"");



        return $combos;
    }

    public function listar($ordem="asc") {

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Colaborador",'visualizar'=>1));

        $this->banco->conetarBanco() ;

        $dados = $this->input->post();

        if(!empty($ordem)){

          $dados['ordem']=$ordem;

        }


        if(empty($dados)){

            $dados=recuperarFiltro('filtro_Colaborador');
        }


        salvarFiltro('filtro_Colaborador',$dados);

        $config= $this->combos();

        $config['action'] = site_url('Colaborador/listar/');

        $config['console'] = $this->load->view("layout/console","",true);

        $config['dadosColaborador'] = $this->ColaboradorModel->dados($dados);

        $inicio = (!$this->uri->segment("4")) ? 0 : $this->uri->segment("4");

        $paginacao=configPaginacao(MAXIMOPAGINA,'#telaPrincipal');

        $paginacao['base_url'] = site_url('Colaborador/listar/');

        $paginacao['total_rows'] =   $this->ColaboradorModel->contarTotal($dados);

        $config['total'] =  $paginacao['total_rows'];

        $this->paginacaonelos->initialize($paginacao);

        $config['paginacao'] = $this->paginacaonelos->create_links();

        $config['modal'] = "false";

        $config['ordem'] = $ordem;

        $config['listaColaborador'] = $this->ColaboradorModel->filtrar($dados,MAXIMOPAGINA,$inicio);

        $this->load->view("colaborador/listar_colaborador",$config);

        $this->banco->desconetarBanco();

    }

    public function incluir($modal="false"){

        $titulo=" Cadastrar Profissional ";

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Colaborador",'incluir'=>1));

        $this->banco->conetarBanco() ;

        $dados= $this->ColaboradorModel->dados($this->input->post());

        $buscar= $this->ColaboradorModel->filtrar($dados);

        if($this->input->post()==true){

            if(empty($buscar)){

                $this->banco->abrirTransacao();

                $dadosUser=$dados;

                $dadosUser['tipo'] =COLABORADOR;

                $dadosUser['senha'] =senha("col@123");

                $dados['id_usuario']=$this->UsuarioModel->incluir($dadosUser);

                $id_Colaborador = $this->ColaboradorModel->incluir($dados);

                if ($this->banco->verificarTransacao() === FALSE) {

                    $this->session->set_flashdata('erro', 'Não foi possível realizar o cadastro da Colaborador!');

                }else{

                    $this->banco->confirmarTransacao();

                    if(!empty($id_Colaborador)){

                        $this->session->set_flashdata('sucesso', 'Cadastro da Colaborador realizado com sucesso');

                    }
                }

            }else{

                $this->session->set_flashdata('erro', 'Já há um cadastro de Colaborador com os mesmos dados');
            }


        }

        $config= $this->combos();

        $dadosColaborador = $this->ColaboradorModel->dados();

        $config['abas']=$this->abas('','', $titulo);

        $config['action'] = site_url('Colaborador/incluir/'.$modal);

        $config['destino'] = site_url('Colaborador/listar/'.$modal);

        $config['modal'] = $modal;

        if($modal=="true"){

            $config['target'] = ".vermodal";

        }else{

            $config['target'] = "#telaPrincipal";

        }

        $config['dadosColaborador'] =  $dadosColaborador;

        $this->load->view("colaborador/form_colaborador",$config);

        $this->banco->desconetarBanco();

    }

    public function editar($modal="false",$id) {

        $titulo="Editar Cadastro de Profissional";

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Colaborador",'editar'=>1));

        $this->banco->conetarBanco() ;

        $dados = $this->input->post();

        if($dados==true){

            $this->banco->abrirTransacao();

            $this->ColaboradorModel->editar($dados);

            if ($this->banco->verificarTransacao() === FALSE) {

             $this->session->set_flashdata('erro', 'Falha ao atualizar cadastro da Colaborador!');

             } else {

                $this->banco->confirmarTransacao();

                $this->session->set_flashdata('sucesso', 'Atualização do cadastro da Colaborador realizada com sucesso!');

            }


        }

        $config= $this->combos();

        $config['abas']=$this->abas('','', $titulo);

        $config['destino'] = site_url('Colaborador/listar/'.$modal);

        $config['modal'] = $modal;

        if($modal=="true"){

            $config['target'] = ".vermodal";

        }else{

            $config['target'] = "#telaPrincipal";

        }

        $config['action'] = site_url('Colaborador/editar/'.$modal.'/'.$id);

        $config['dadosColaborador'] = $this->ColaboradorModel->ver($id);

        $this->load->view("colaborador/form_colaborador",$config);

        $this->banco->desconetarBanco();

    }

    public function ver($id_Colaborador) {

        $titulo=" Visualizar";

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Colaborador",'visualizar'=>1));

        $this->banco->conetarBanco() ;

        $config= $this->combos();

        $config['dadosColaborador'] = $this->ColaboradorModel->ver($id_Colaborador);

        $config['abas'] = $this->abas($id_Colaborador,'Colaborador', $titulo);

        $config['console'] = $this->load->view("layout/console","",true);

        $this->load->view("colaborador/ver_colaborador",$config);

        $this->banco->desconetarBanco();

    }

    public function excluir($modal="false",$id) {

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Colaborador",'excluir'=>1));

        $this->banco->conetarBanco();

        $this->banco->abrirTransacao();

        $this->ColaboradorModel->excluir($id);

        if ($this->banco->verificarTransacao() === FALSE) {

            $this->session->set_flashdata('erro', 'Erro ao realizar exclusão da Colaborador!');

        } else {

            $this->banco->confirmarTransacao();

            $this->session->set_flashdata('sucesso', 'Sucesso ao realizar exclusão da Colaborador!');


        }

        redirect('Colaborador/listar/'.$modal);

        $this->banco->desconetarBanco();
    }

    public function excluirEmMassa() {

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Colaborador",'excluir'=>1));

        $this->banco->conetarBanco();

        $this->banco->abrirTransacao();

        $dados= $this->input->post();

        foreach ($dados['selecionado'] as $id) {

            $this->ColaboradorModel->excluir($id);
        }

        if($this->banco->verificarTransacao() === FALSE) {

           $this->banco->cancelarTransacao();

           $this->session->set_flashdata('erro', 'Não foi possível excluir !');

       } else {

        $this->banco->confirmarTransacao();

        $this->session->set_flashdata('sucesso', 'Sucesso ao excluir pessoas! ');


        }

        $this->banco->desconetarBanco();

        redirect('Colaborador/listar/false');
    }

    public function relatorio() {

        $dados = $this->input->post();

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Colaborador",'visualizar'=>1));

          salvarFiltro('filtro_Colaborador',$dados);

          $titulo=" &#xf12e; Gerar Relatório/ colaborador";

          $config= $this->combos();

          $this->load->library("Pdf");

          $this->AcessoLoginModel->redirecionar();

          $this->banco->conetarBanco() ;

          $config['abas']=$this->abas('','', $titulo);

          $config['dadosColaborador'] = $this->ColaboradorModel->dados($dados);

          if($dados){

            $config['listaColaborador']=$this->ColaboradorModel->filtrar($dados);

            $config['total']=$this->ColaboradorModel->contarTotal($dados);

            $config['colunas']=10;

            $pdf= new Pdf('','', 0,0, 2,2,2,2);

            $pdf->loadView("colaborador/relatorio_colaborador",$config,"rel_colaborador");
          }else{

          $config['action'] = site_url('Colaborador/relatorio');

          $this->load->view("colaborador/form_rel_colaborador",$config);


        }
          $this->banco->desconetarBanco();


    }

}
