<?php

class Grupo extends MY_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('paginacaonelos');

        $this->load->model('grupo/GrupoModel');

        $this->load->model('usuario/AcessoLoginModel');        

        $this->AcessoLoginModel->redirecionar();
    }

    public function index(){       

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Grupo",'visualizar'=>1));

        $this->banco->conetarBanco() ;        

        $config['action'] = site_url('Grupo/listar');

        $config['dadosGrupo'] = $this->GrupoModel->dados();

        $config['listaGrupo'] = $this->GrupoModel->listar();

        $this->load->view("grupo/home",$config);

        $this->banco->desconetarBanco();

    }

    public function abas($id = null,$active,$titulo = null){

        $abas=array();

        $abas[] =array(
            'class'=>'Grupo',
            'url'=>site_url('/Grupo/ver/'.$id),
            'titulo'=>'GRUPO',
            'icone'=>''
        );

        return abas($abas,$active,$titulo);
    }

    public function combos($dados=array()){

        $combos = array();

        return $combos;
    }


    public function listar() {

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Grupo",'visualizar'=>1));

        $this->banco->conetarBanco() ;

        $dados = $this->input->post();

        if(empty($dados)){

            $dados=recuperarFiltro('filtro_Grupo');
        }  

        salvarFiltro('filtro_Grupo',$dados);       

        $config= $this->combos();

        $config['action'] = site_url('Grupo/listar');

        $config['console'] = $this->load->view("layout/console","",true);

        $config['dadosGrupo'] = $this->GrupoModel->dados($dados);

        $inicio = (!$this->uri->segment("3")) ? 0 : $this->uri->segment("3");

        $paginacao=configPaginacao(MAXIMOPAGINA,'#telaPrincipal');

        $paginacao['base_url'] = site_url('Grupo/listar');

        $paginacao['total_rows'] =   $this->GrupoModel->contarTotal($dados);

        $config['total'] =  $paginacao['total_rows'];

        $this->paginacaonelos->initialize($paginacao);

        $config['paginacao'] = $this->paginacaonelos->create_links();

        $config['listaGrupo'] = $this->GrupoModel->filtrar($dados,MAXIMOPAGINA,$inicio);

        $this->load->view("grupo/listar_grupo",$config);

        $this->banco->desconetarBanco();

    } 

    public function incluir(){

        $titulo="&#xf344; Cadastro ";

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Grupo",'incluir'=>1));

        $this->banco->conetarBanco() ;      

        $dados= $this->GrupoModel->dados($this->input->post());

        $buscar= $this->GrupoModel->filtrar($dados);

        if($this->input->post()==true){           

            if(empty($buscar)){

                $this->banco->abrirTransacao();

                $id_Grupo = $this->GrupoModel->incluir($dados);

                if ($this->banco->verificarTransacao() === FALSE) {

                    $this->session->set_flashdata('erro', 'Não foi possível realizar o cadastro da Grupo!');

                }else{

                    $this->banco->confirmarTransacao();

                    if(!empty($id_Grupo)){

                        $this->session->set_flashdata('sucesso', 'Cadastro da Grupo realizado com sucesso');          

                    }
                }

            }else{

                $this->session->set_flashdata('erro', 'Já há um cadastro de Grupo com os mesmos dados');
            }


        }

        $config= $this->combos();

        $dadosGrupo = $this->GrupoModel->dados();

        $config['abas']=$this->abas('','', $titulo);

        $config['action'] = site_url('Grupo/incluir');

        $config['destino'] = site_url('Grupo/listar/');

        $config['target'] = "#telaPrincipal";

        $config['modal'] = "false";

        $config['dadosGrupo'] =  $dadosGrupo;       

        $this->load->view("grupo/form_grupo",$config);

        $this->banco->desconetarBanco();

    }

    public function editar($id) {

        $titulo="Editar ";

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Grupo",'editar'=>1));

        $this->banco->conetarBanco() ;

        $dados = $this->input->post();

        if($dados==true){

            $this->banco->abrirTransacao();

            $this->GrupoModel->editar($dados);       

            if ($this->banco->verificarTransacao() === FALSE) {

             $this->session->set_flashdata('erro', 'Falha ao atualizar cadastro da Grupo!');

             } else {

                $this->banco->confirmarTransacao();

                $this->session->set_flashdata('sucesso', 'Atualização do cadastro da Grupo realizada com sucesso!');

            }


        }

        $config= $this->combos();

        $config['abas']=$this->abas('','', $titulo);

        $config['action'] = site_url('Grupo/editar/'.$id);

        $config['destino'] = site_url('Grupo/listar/');

        $config['target'] = "#telaPrincipal";

        $config['modal'] = "false";

        $config['dadosGrupo'] = $this->GrupoModel->ver($id);

        $this->load->view("grupo/form_grupo",$config);

        $this->banco->desconetarBanco();

    }

    public function ver($id_Grupo) {

        $titulo=" Visualizar";

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Grupo",'visualizar'=>1));

        $this->banco->conetarBanco() ;

        $config= $this->combos();

        $config['dadosGrupo'] = $this->GrupoModel->ver($id_Grupo);

        $config['abas'] = $this->abas($id_Grupo,'Grupo', $titulo);

        $config['console'] = $this->load->view("layout/console","",true);

        $this->load->view("grupo/ver_grupo",$config);

        $this->banco->desconetarBanco();

    }

    public function excluir($id) {

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Grupo",'excluir'=>1));

        $this->banco->conetarBanco(); 

        $this->banco->abrirTransacao();

        $this->GrupoModel->excluir($id);

        if ($this->banco->verificarTransacao() === FALSE) {

            $this->session->set_flashdata('erro', 'Erro ao realizar exclusão da Grupo!');

        } else {

            $this->banco->confirmarTransacao();

            $this->session->set_flashdata('sucesso', 'Sucesso ao realizar exclusão da Grupo!');


        }

        redirect('Grupo/listar');      

        $this->banco->desconetarBanco();
    }

    public function excluirEmMassa() {

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Grupo",'excluir'=>1));

        $this->banco->conetarBanco();

        $this->banco->abrirTransacao();

        $dados= $this->input->post();

        foreach ($dados['selecionado'] as $id) {

            $this->GrupoModel->excluir($id);
        }

        if($this->banco->verificarTransacao() === FALSE) {

           $this->banco->cancelarTransacao();

           $this->session->set_flashdata('erro', 'Não foi possível excluir !');

       } else {

        $this->banco->confirmarTransacao();

        $this->session->set_flashdata('sucesso', 'Sucesso ao excluir pessoas! ');


        }

        $this->banco->desconetarBanco();

        redirect('Grupo/listar');
    }

    public function relatorio() {

        $dados = $this->input->post();

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Grupo",'visualizar'=>1));

        if(empty($dados)){

            $dados=recuperarFiltro('filtro_Grupo');
        }  

        salvarFiltro('filtro_Grupo',$dados);   

        $titulo=" relatorio grupo";

        $config= $this->combos();

        $this->load->library("Pdf");

        $this->AcessoLoginModel->redirecionar();

        $this->banco->conetarBanco() ;

        $config['list']=$this->GrupoModel->filtrar($dados);

        $config['total']=$this->GrupoModel->contarTotal($dados);

        $pdf= new Pdf('','', 0,0, 2,2,2,2);

        $pdf->AddPage('L');    

        $pdf->load_view("grupo/relatorio_grupo",$config,"rel_grupo");

        $this->banco->desconetarBanco();

    }





}
