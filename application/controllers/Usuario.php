<?php

class Usuario extends MY_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('paginacaonelos');

        $this->load->model('usuario/UsuarioModel');

        $this->load->model('admin/AcessoLoginModel');

        $this->load->model('grupo/GrupoModel');


        }

    public function index(){

        $this->AcessoLoginModel->redirecionar();

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Usuario",'visualizar'=>1));

        $this->banco->conetarBanco() ;

        $config['action'] = site_url('Usuario/listar');

        $config['dadosUsuario'] = $this->UsuarioModel->dados();

        $config['listaUsuario'] = $this->UsuarioModel->listar();

        $this->load->view("usuario/home",$config);

        $this->banco->desconetarBanco();

    }

    public function abas($id = null,$active,$titulo = null){

        $abas=array();

        $abas[] =array(
            'class'=>'Usuario',
            'url'=>site_url('/Usuario/ver/'.$id),
            'titulo'=>'USUário',
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


    public function listar() {

        $this->AcessoLoginModel->redirecionar();

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Usuario",'visualizar'=>1));

        $this->banco->conetarBanco() ;

        $dados = $this->input->post();

        if(empty($dados)){

            $dados=recuperarFiltro('filtro_Usuario');
        }

        salvarFiltro('filtro_Usuario',$dados);

        $config= $this->combos();

        $config['action'] = site_url('Usuario/listar');

        $config['console'] = $this->load->view("layout/console","",true);

        $config['dadosUsuario'] = $this->UsuarioModel->dados($dados);

        $inicio = (!$this->uri->segment("3")) ? 0 : $this->uri->segment("3");

        $paginacao=configPaginacao(MAXIMOPAGINA,'#telaPrincipal');

        $paginacao['base_url'] = site_url('Usuario/listar');

        $paginacao['total_rows'] =   $this->UsuarioModel->contarTotal($dados);

        $config['total'] =  $paginacao['total_rows'];

        $this->paginacaonelos->initialize($paginacao);

        $config['paginacao'] = $this->paginacaonelos->create_links();

        $config['listaUsuario'] = $this->UsuarioModel->filtrar($dados,MAXIMOPAGINA,$inicio);

        $this->load->view("usuario/listar_usuario",$config);

        $this->banco->desconetarBanco();

    }

    public function incluir(){

        $titulo="&#xf344; Cadastro ";

        $this->AcessoLoginModel->redirecionar();

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Usuario",'incluir'=>1));

        $this->banco->conetarBanco() ;

        $dados= $this->UsuarioModel->dados($this->input->post());

        $buscar= $this->UsuarioModel->filtrar($dados);

        if($this->input->post()==true){

            if(empty($buscar)){

                $this->banco->abrirTransacao();

                $id_Usuario = $this->UsuarioModel->incluir($dados);

                if ($this->banco->verificarTransacao() === FALSE) {

                    $this->session->set_flashdata('erro', 'Não foi possível realizar o cadastro da Usuario!');

                }else{

                    $this->banco->confirmarTransacao();

                    if(!empty($id_Usuario)){

                        $this->session->set_flashdata('sucesso', 'Cadastro da Usuario realizado com sucesso');

                    }
                }

            }else{

                $this->session->set_flashdata('erro', 'Já há um cadastro de Usuario com os mesmos dados');
            }


        }

        $config= $this->combos();

        $dadosUsuario = $this->UsuarioModel->dados();

        $config['abas']=$this->abas('','', $titulo);

        $config['action'] = site_url('Usuario/incluir');

        $config['destino'] = site_url('Usuario/listar/');

        $config['target'] = "#telaPrincipal";

        $config['modal'] = "false";

        $config['dadosUsuario'] =  $dadosUsuario;

        $this->load->view("usuario/form_usuario",$config);

        $this->banco->desconetarBanco();

    }

    public function editar($id) {

        $titulo=" Editar Login";

        $this->AcessoLoginModel->redirecionar();

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Usuario",'editar'=>1));

        $this->banco->conetarBanco() ;

        $dados = $this->input->post();

        if($dados==true){

            $this->banco->abrirTransacao();

            if(!empty($dados['senha'])){

            $dados['senha']=senha($dados['senha']);
          }

            $this->UsuarioModel->editar($dados);

            if ($this->banco->verificarTransacao() === FALSE) {

             $this->session->set_flashdata('erro', 'Falha ao atualizar cadastro da Usuario!');

             } else {

                $this->banco->confirmarTransacao();

                $this->session->set_flashdata('sucesso', 'Atualização do cadastro da Usuario realizada com sucesso!');

            }


        }

        $config= $this->combos();

        $config['abas']=$this->abas('','', $titulo);

        $config['console'] = $this->load->view("layout/console","",true);


        $config['action'] = site_url('Usuario/editar/'.$id);

        $config['destino'] = site_url('Usuario/editar/'.$id);

        $config['target'] = "#telaPrincipal";

        $config['modal'] = "true";

        $config['dadosUsuario'] =  $this->UsuarioModel->dados($this->UsuarioModel->ver($id));

       $this->load->view("usuario/form_usuario",$config);

        $this->banco->desconetarBanco();

    }

    public function ver($id_Usuario) {

        $titulo=" Visualizar";

        $this->AcessoLoginModel->redirecionar();

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Usuario",'visualizar'=>1));

        $this->banco->conetarBanco() ;

        $config= $this->combos();

        $config['dadosUsuario'] = $this->UsuarioModel->ver($id_Usuario);

        $config['abas'] = $this->abas($id_Usuario,'Usuario', $titulo);

        $config['console'] = $this->load->view("layout/console","",true);

        $this->load->view("usuario/ver_usuario",$config);

        $this->banco->desconetarBanco();

    }

    public function excluir($id) {

        $this->AcessoLoginModel->redirecionar();

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Usuario",'excluir'=>1));

        $this->banco->conetarBanco();

        $this->banco->abrirTransacao();

        $this->UsuarioModel->excluir($id);

        if ($this->banco->verificarTransacao() === FALSE) {

            $this->session->set_flashdata('erro', 'Erro ao realizar exclusão da Usuario!');

        } else {

            $this->banco->confirmarTransacao();

            $this->session->set_flashdata('sucesso', 'Sucesso ao realizar exclusão da Usuario!');


        }

        redirect('Usuario/listar');

        $this->banco->desconetarBanco();
    }

    public function excluirEmMassa() {

        $this->AcessoLoginModel->redirecionar();

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Usuario",'excluir'=>1));

        $this->banco->conetarBanco();

        $this->banco->abrirTransacao();

        $dados= $this->input->post();

        foreach ($dados['selecionado'] as $id) {

            $this->UsuarioModel->excluir($id);
        }

        if($this->banco->verificarTransacao() === FALSE) {

           $this->banco->cancelarTransacao();

           $this->session->set_flashdata('erro', 'Não foi possível excluir !');

       } else {

        $this->banco->confirmarTransacao();

        $this->session->set_flashdata('sucesso', 'Sucesso ao excluir pessoas! ');


        }

        $this->banco->desconetarBanco();

        redirect('Usuario/listar');
    }

    public function relatorio() {

        $dados = $this->input->post();

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Usuario",'visualizar'=>1));

        if(empty($dados)){

            $dados=recuperarFiltro('filtro_Usuario');
        }

        salvarFiltro('filtro_Usuario',$dados);

        $titulo=" relatorio usuario";

        $config= $this->combos();

        $this->load->library("Pdf");

        $this->AcessoLoginModel->redirecionar();

        $this->banco->conetarBanco() ;

        $config['list']=$this->UsuarioModel->filtrar($dados);

        $config['total']=$this->UsuarioModel->contarTotal($dados);

        $pdf= new Pdf('','', 0,0, 2,2,2,2);

        $pdf->AddPage('L');

        $pdf->load_view("usuario/relatorio_usuario",$config,"rel_usuario");

        $this->banco->desconetarBanco();

    }





}
