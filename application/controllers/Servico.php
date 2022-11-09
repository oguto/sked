<?php

class Servico extends MY_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('paginacaonelos');

        $this->load->model('servico/ServicoModel');

        $this->load->model('admin/AcessoLoginModel');

        $this->AcessoLoginModel->redirecionar();
    }

    public function index(){

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Servico",'visualizar'=>1));

        $this->banco->conetarBanco() ;

        $config['action'] = site_url('Servico/listar');

        $config['dadosServico'] = $this->ServicoModel->dados();

        $config['listaServico'] = $this->ServicoModel->listar();

        $this->load->view("servico/home",$config);

        $this->banco->desconetarBanco();

    }

    public function abas($id = null,$active,$titulo = null){

        $abas=array();

        $abas[] =array(
            'class'=>'Servico',
            'url'=>site_url('/Servico/ver/'.$id),
            'titulo'=>'SERVICO',
            'icone'=>''
        );

        return abas($abas,$active,$titulo);
    }

    public function combos($dados=array()){

        $combos = array();

        return $combos;
    }

    public function listar($ordem="asc") {

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Servico",'visualizar'=>1));

        $this->banco->conetarBanco() ;

        $dados = $this->input->post();

        if(empty($dados)){

            $dados=recuperarFiltro('filtro_Servico');
        }

        if(!empty($ordem)){

          $dados['ordem']=$ordem;

        }

        salvarFiltro('filtro_Servico',$dados);

        $config= $this->combos();

        $config['action'] = site_url('Servico/listar/'.$ordem);

        $config['console'] = $this->load->view("layout/console","",true);

        $config['dadosServico'] = $this->ServicoModel->dados($dados);

        $inicio = (!$this->uri->segment("4")) ? 0 : $this->uri->segment("4");

        $paginacao=configPaginacao(MAXIMOPAGINA,'#telaPrincipal');

        $paginacao['base_url'] = site_url('Servico/listar/'.$ordem.'/');

        $paginacao['total_rows'] =   $this->ServicoModel->contarTotal($dados);

        $config['total'] =  $paginacao['total_rows'];

        $this->paginacaonelos->initialize($paginacao);

        $config['paginacao'] = $this->paginacaonelos->create_links();

        $config['modal'] = "false";

        $config['ordem'] = $ordem;

        $config['listaServico'] = $this->ServicoModel->filtrar($dados,MAXIMOPAGINA,$inicio);

        $this->load->view("servico/listar_servico",$config);

        $this->banco->desconetarBanco();

    }

    public function incluir($modal="false"){

        $titulo="Cadastrar Procedimento ";

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Servico",'incluir'=>1));

        $this->banco->conetarBanco() ;

        $dados= $this->ServicoModel->dados($this->input->post());

        $buscar= $this->ServicoModel->filtrar($dados);

        if($this->input->post()==true){

            if(empty($buscar)){

                $this->banco->abrirTransacao();

                $id_Servico = $this->ServicoModel->incluir($dados);

                if ($this->banco->verificarTransacao() === FALSE) {

                    $this->session->set_flashdata('erro', 'Não foi possível realizar o cadastro da Servico!');

                }else{

                    $this->banco->confirmarTransacao();

                    if(!empty($id_Servico)){

                        $this->session->set_flashdata('sucesso', 'Cadastro da Servico realizado com sucesso');

                    }
                }

            }else{

                $this->session->set_flashdata('erro', 'Já há um cadastro de Servico com os mesmos dados');
            }


        }

        $config= $this->combos();

        $dadosServico = $this->ServicoModel->dados();

        $config['abas']=$this->abas('','', $titulo);

        $config['action'] = site_url('Servico/incluir/'.$modal);

        $config['destino'] = site_url('Servico/listar/'.$modal);

        $config['modal'] = $modal;

        if($modal=="true"){

            $config['target'] = ".vermodal";

        }else{

            $config['target'] = "#telaPrincipal";

        }

        $config['dadosServico'] =  $dadosServico;

        $this->load->view("servico/form_servico",$config);

        $this->banco->desconetarBanco();

    }

    public function editar($modal="false",$id) {

        $titulo="Editar Procedimento";

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Servico",'editar'=>1));

        $this->banco->conetarBanco() ;

        $dados = $this->input->post();

        if($dados==true){

            $this->banco->abrirTransacao();

            $this->ServicoModel->editar($dados);

            if ($this->banco->verificarTransacao() === FALSE) {

             $this->session->set_flashdata('erro', 'Falha ao atualizar cadastro da Servico!');

             } else {

                $this->banco->confirmarTransacao();

                $this->session->set_flashdata('sucesso', 'Atualização do cadastro da Servico realizada com sucesso!');

            }


        }

        $config= $this->combos();

        $config['abas']=$this->abas('','', $titulo);

        $config['destino'] = site_url('Servico/listar/'.$modal);

        $config['modal'] = $modal;

        if($modal=="true"){

            $config['target'] = ".vermodal";

        }else{

            $config['target'] = "#telaPrincipal";

        }

        $config['action'] = site_url('Servico/editar/'.$modal.'/'.$id);

        $config['dadosServico'] = $this->ServicoModel->ver($id);

        $this->load->view("servico/form_servico",$config);

        $this->banco->desconetarBanco();

    }

    public function ver($id_Servico) {

        $titulo=" Visualizar";

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Servico",'visualizar'=>1));

        $this->banco->conetarBanco() ;

        $config= $this->combos();

        $config['dadosServico'] = $this->ServicoModel->ver($id_Servico);

        $config['abas'] = $this->abas($id_Servico,'Servico', $titulo);

        $config['console'] = $this->load->view("layout/console","",true);

        $this->load->view("servico/ver_servico",$config);

        $this->banco->desconetarBanco();

    }

    public function excluir($modal="false",$id) {

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Servico",'excluir'=>1));

        $this->banco->conetarBanco();

        $this->banco->abrirTransacao();

        $this->ServicoModel->excluir($id);

        if ($this->banco->verificarTransacao() === FALSE) {

            $this->session->set_flashdata('erro', 'Erro ao realizar exclusão da Servico!');

        } else {

            $this->banco->confirmarTransacao();

            $this->session->set_flashdata('sucesso', 'Sucesso ao realizar exclusão da Servico!');


        }

        redirect('Servico/listar/'.$modal);

        $this->banco->desconetarBanco();
    }

    public function excluirEmMassa() {

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Servico",'excluir'=>1));

        $this->banco->conetarBanco();

        $this->banco->abrirTransacao();

        $dados= $this->input->post();

        foreach ($dados['selecionado'] as $id) {

            $this->ServicoModel->excluir($id);
        }

        if($this->banco->verificarTransacao() === FALSE) {

           $this->banco->cancelarTransacao();

           $this->session->set_flashdata('erro', 'Não foi possível excluir !');

       } else {

        $this->banco->confirmarTransacao();

        $this->session->set_flashdata('sucesso', 'Sucesso ao excluir pessoas! ');


        }

        $this->banco->desconetarBanco();

        redirect('Servico/listar/false');
    }

    public function relatorio() {

        $dados = $this->input->post();

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Servico",'visualizar'=>1));

          salvarFiltro('filtro_Servico',$dados);

          $titulo=" &#xf12e; Gerar Relatório/ servico";

          $config= $this->combos();

          $this->load->library("Pdf");

          $this->AcessoLoginModel->redirecionar();

          $this->banco->conetarBanco() ;

          $config['abas']=$this->abas('','', $titulo);

          $config['dadosServico'] = $this->ServicoModel->dados($dados);

          if($dados){

            $config['listaServico']=$this->ServicoModel->filtrar($dados);

            $config['total']=$this->ServicoModel->contarTotal($dados);

            $config['colunas']=10;

            $pdf= new Pdf('','', 0,0, 2,2,2,2);

            $pdf->loadView("servico/relatorio_servico",$config,"rel_servico");
          }else{

          $config['action'] = site_url('Servico/relatorio');

          $this->load->view("servico/form_rel_servico",$config);


        }
          $this->banco->desconetarBanco();


    }

    public function verCombo($id_Servico) {

        $this->banco->conetarBanco() ;

        $dadosServico = $this->ServicoModel->ver($id_Servico);

        $this->banco->desconetarBanco();

        echo json_encode($dadosServico);

    }


}
