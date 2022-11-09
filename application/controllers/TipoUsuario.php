<?php

class TipoUsuario extends MY_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('paginacaonelos');

        $this->load->model('tipo/TipoUsuarioModel');

        $this->load->model('admin/AcessoLoginModel');        

        }

    public function index(){

        $this->AcessoLoginModel->redirecionar();

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"TipoUsuario",'visualizar'=>1));

        $this->banco->conetarBanco() ;        

        $config['action'] = site_url('TipoUsuario/listar');

        $config['dadosTipoUsuario'] = $this->TipoUsuarioModel->dados();

        $config['listaTipoUsuario'] = $this->TipoUsuarioModel->listar();

        $this->load->view("tipo/home",$config);

        $this->banco->desconetarBanco();

    }

    public function abas($id = null,$active,$titulo = null){

        $abas=array();

        $abas[] =array(
            'class'=>'TipoUsuario',
            'url'=>site_url('/TipoUsuario/ver/'.$id),
            'titulo'=>'USUário',
            'icone'=>''
        );

        return abas($abas,$active,$titulo);
    }

    public function combos($dados=array()){

        $combos = array();

        return $combos;
    }


    public function listar() {

        $this->AcessoLoginModel->redirecionar();

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"TipoUsuario",'visualizar'=>1));

        $this->banco->conetarBanco() ;

        $dados = $this->input->post();

        if(empty($dados)){

            $dados=recuperarFiltro('filtro_TipoUsuario');
        }  

        salvarFiltro('filtro_TipoUsuario',$dados);       

        $config= $this->combos();

        $config['action'] = site_url('TipoUsuario/listar');

        $config['console'] = $this->load->view("layout/console","",true);

        $config['dadosTipoUsuario'] = $this->TipoUsuarioModel->dados($dados);

        $inicio = (!$this->uri->segment("3")) ? 0 : $this->uri->segment("3");

        $paginacao=configPaginacao(MAXIMOPAGINA,'#telaPrincipal');

        $paginacao['base_url'] = site_url('TipoUsuario/listar');

        $paginacao['total_rows'] =   $this->TipoUsuarioModel->contarTotal($dados);

        $config['total'] =  $paginacao['total_rows'];

        $this->paginacaonelos->initialize($paginacao);

        $config['paginacao'] = $this->paginacaonelos->create_links();

        $config['listaTipoUsuario'] = $this->TipoUsuarioModel->filtrar($dados,MAXIMOPAGINA,$inicio);

        $this->load->view("tipo/listar_tipo_usuario",$config);

        $this->banco->desconetarBanco();

    } 

    public function incluir(){

        $titulo="&#xf344; Cadastro ";

        $this->AcessoLoginModel->redirecionar();

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"TipoUsuario",'incluir'=>1));

        $this->banco->conetarBanco() ;      

        $dados= $this->TipoUsuarioModel->dados($this->input->post());

        $buscar= $this->TipoUsuarioModel->filtrar($dados);

        if($this->input->post()==true){           

            if(empty($buscar)){

                $this->banco->abrirTransacao();

                $id_TipoUsuario = $this->TipoUsuarioModel->incluir($dados);

                if ($this->banco->verificarTransacao() === FALSE) {

                    $this->session->set_flashdata('erro', 'Não foi possível realizar o cadastro da TipoUsuario!');

                }else{

                    $this->banco->confirmarTransacao();

                    if(!empty($id_TipoUsuario)){

                        $this->session->set_flashdata('sucesso', 'Cadastro da TipoUsuario realizado com sucesso');          

                    }
                }

            }else{

                $this->session->set_flashdata('erro', 'Já há um cadastro de TipoUsuario com os mesmos dados');
            }


        }

        $config= $this->combos();

        $dadosTipoUsuario = $this->TipoUsuarioModel->dados();

        $config['abas']=$this->abas('','', $titulo);

        $config['action'] = site_url('TipoUsuario/incluir');

        $config['destino'] = site_url('TipoUsuario/listar/');

        $config['target'] = "#telaPrincipal";

        $config['modal'] = "false";

        $config['dadosTipoUsuario'] =  $dadosTipoUsuario;       

        $this->load->view("tipo/form_tipo_usuario",$config);

        $this->banco->desconetarBanco();

    }

    public function editar($id) {

        $titulo="&#xf344; Editar Rifa";

        $this->AcessoLoginModel->redirecionar();

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"TipoUsuario",'editar'=>1));

        $this->banco->conetarBanco() ;

        $dados = $this->input->post();

        if($dados==true){

            $this->banco->abrirTransacao();

            $this->TipoUsuarioModel->editar($dados);       

            if ($this->banco->verificarTransacao() === FALSE) {

             $this->session->set_flashdata('erro', 'Falha ao atualizar cadastro da TipoUsuario!');

             } else {

                $this->banco->confirmarTransacao();

                $this->session->set_flashdata('sucesso', 'Atualização do cadastro da TipoUsuario realizada com sucesso!');

            }


        }

        $config= $this->combos();

        $config['abas']=$this->abas('','', $titulo);

        $config['action'] = site_url('TipoUsuario/editar/'.$id);

        $config['destino'] = site_url('TipoUsuario/listar/');

        $config['target'] = "#telaPrincipal";

        $config['modal'] = "false";

        $config['dadosTipoUsuario'] = $this->TipoUsuarioModel->ver($id);

        $this->load->view("tipo/form_tipo_usuario",$config);

        $this->banco->desconetarBanco();

    }

    public function ver($id_TipoUsuario) {

        $titulo=" Visualizar";

        $this->AcessoLoginModel->redirecionar();

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"TipoUsuario",'visualizar'=>1));

        $this->banco->conetarBanco() ;

        $config= $this->combos();

        $config['dadosTipoUsuario'] = $this->TipoUsuarioModel->ver($id_TipoUsuario);

        $config['abas'] = $this->abas($id_TipoUsuario,'TipoUsuario', $titulo);

        $config['console'] = $this->load->view("layout/console","",true);

        $this->load->view("tipo/ver_tipo_usuario",$config);

        $this->banco->desconetarBanco();

    }

    public function excluir($id) {

        $this->AcessoLoginModel->redirecionar();

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"TipoUsuario",'excluir'=>1));

        $this->banco->conetarBanco(); 

        $this->banco->abrirTransacao();

        $this->TipoUsuarioModel->excluir($id);

        if ($this->banco->verificarTransacao() === FALSE) {

            $this->session->set_flashdata('erro', 'Erro ao realizar exclusão da TipoUsuario!');

        } else {

            $this->banco->confirmarTransacao();

            $this->session->set_flashdata('sucesso', 'Sucesso ao realizar exclusão da TipoUsuario!');


        }

        redirect('TipoUsuario/listar');      

        $this->banco->desconetarBanco();
    }

    public function excluirEmMassa() {

        $this->AcessoLoginModel->redirecionar();

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"TipoUsuario",'excluir'=>1));

        $this->banco->conetarBanco();

        $this->banco->abrirTransacao();

        $dados= $this->input->post();

        foreach ($dados['selecionado'] as $id) {

            $this->TipoUsuarioModel->excluir($id);
        }

        if($this->banco->verificarTransacao() === FALSE) {

           $this->banco->cancelarTransacao();

           $this->session->set_flashdata('erro', 'Não foi possível excluir !');

       } else {

        $this->banco->confirmarTransacao();

        $this->session->set_flashdata('sucesso', 'Sucesso ao excluir pessoas! ');


        }

        $this->banco->desconetarBanco();

        redirect('TipoUsuario/listar');
    }

    public function relatorio() {

        $dados = $this->input->post();

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"TipoUsuario",'visualizar'=>1));

        if(empty($dados)){

            $dados=recuperarFiltro('filtro_TipoUsuario');
        }  

        salvarFiltro('filtro_TipoUsuario',$dados);   

        $titulo=" relatorio tipo_usuario";

        $config= $this->combos();

        $this->load->library("Pdf");

        $this->AcessoLoginModel->redirecionar();

        $this->banco->conetarBanco() ;

        $config['list']=$this->TipoUsuarioModel->filtrar($dados);

        $config['total']=$this->TipoUsuarioModel->contarTotal($dados);

        $pdf= new Pdf('','', 0,0, 2,2,2,2);

        $pdf->AddPage('L');    

        $pdf->load_view("tipo/relatorio_tipo_usuario",$config,"rel_tipo_usuario");

        $this->banco->desconetarBanco();

    }





}
