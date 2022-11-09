<?php

class Pagamento extends MY_Controller {

    public function __construct(){

        parent::__construct();

        $this->load->library('paginacaonelos');

        $this->load->model('pagamento/PagamentoModel');

        $this->load->model('admin/AcessoLoginModel');

        $this->load->model('colaborador/ColaboradorModel');

        $this->load->model('cliente/ClienteModel');

        $this->load->model('tansacao/TansacaoModel');

        $this->load->model('tansacao/TansacaoTipoModel');

        $this->load->model('pagamento/PagamentoMetodoModel');

        $this->load->model('pagamento/PagamentoServicoModel');

        $this->load->model('agenda/AgendaModel');

        $this->load->model('servico/ServicoModel');

        $this->AcessoLoginModel->redirecionar();
    }

    public function index(){

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Pagamento",'visualizar'=>1));

        $this->banco->conetarBanco() ;

        $config['action'] = site_url('Pagamento/listar');

        $config['dadosPagamento'] = $this->PagamentoModel->dados();

        $config['listaPagamento'] = $this->PagamentoModel->listar();

        $config['moduloPagamento'] = $this->listar("false",false);

        $config['moduloTransacao'] = $this->listarTrasacao("false",false);

        $this->load->view("pagamento/home",$config);

        $this->banco->desconetarBanco();

    }

    public function abas($id = null,$active,$titulo = null){

        $abas=array();

        $abas[] =array(
            'class'=>'Pagamento',
            'url'=>site_url('/Pagamento/ver/'.$id),
            'titulo'=>'PAGAMENTO',
            'icone'=>''
        );

        return abas($abas,$active,$titulo);
    }

    public function combos($dados=array()){

        $combos = array();

        $combos['objColaborador'] =$this->ColaboradorModel;

        $combos['comboColaborador'] = arrayCombo("id","nome",$combos['objColaborador']->listar(),"Profissional...");

        $combos['objCliente'] =$this->ClienteModel;

        $combos['objPagamento'] =$this->PagamentoModel;

        $combos['objPagamentoServico'] =$this->PagamentoServicoModel;

        $combos['comboCliente'] = arrayCombo("id","nome",$combos['objCliente']->listar(),"Selecione...");

        $combos['objPagamentoMetodo'] =$this->PagamentoMetodoModel;

        $combos['comboPagamentoMetodo'] = arrayCombo("id","nome",$combos['objPagamentoMetodo']->listar(),"Método de Pagamento...");

        $combos['objServico'] =$this->ServicoModel;

        $combos['comboServico'] = arrayCombo("id","nome",$combos['objServico']->listar(),"Procedimento...");

        $combos['objTansacaoTipo'] =$this->TansacaoTipoModel;

        $combos['comboTansacaoTipo'] = arrayCombo("id","nome",$combos['objTansacaoTipo']->listar(),"");

        $combos['objTansacao'] =$this->TansacaoModel;

        return $combos;
    }

    public function listarTrasacao($modal="false",$mostrar=true) {

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

        if($mostrar){

            $this->load->view("tansacao/listar_tansacao",$config);

        }else{


        return $this->load->view("tansacao/listar_tansacao",$config,true);

        }


        $this->banco->desconetarBanco();

    }

    public function listar($modal="false",$mostrar=true) {

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Pagamento",'visualizar'=>1));

        $this->banco->conetarBanco() ;



        $dados = $this->input->post();



        if(empty($dados)){

          $dados['filtro_de'] =date("Y")."-01-01";

          $dados['filtro_ate'] =date("Y-m-d");

          //  $dados=recuperarFiltro('filtro_Pagamento');




        }

        if(!empty($dados['id_colaborador'])){

          $dados['id_profissional']=$dados['id_colaborador'];


        }

        salvarFiltro('filtro_Pagamento',$dados);

        $config= $this->combos();

        $config['action'] = site_url('Pagamento/listar/'.$modal);

        $config['console'] = $this->load->view("layout/console","",true);

        $config['dadosPagamento'] = $this->PagamentoModel->dadosFiltro($dados);

        $config['dadosPagamentoServ'] = $this->PagamentoServicoModel->dados($dados);

        $inicio = (!$this->uri->segment("4")) ? 0 : $this->uri->segment("4");

        $paginacao=configPaginacao(MAXIMOPAGINA,'#telaPrincipal');

        $paginacao['base_url'] = site_url('Pagamento/listar/'.$modal.'/');

        $paginacao['total_rows'] =   $this->PagamentoServicoModel->contarTotal($dados);

        $config['total'] =  $paginacao['total_rows'];

        $this->paginacaonelos->initialize($paginacao);

        $config['paginacao'] = $this->paginacaonelos->create_links();

        $config['modal'] = $modal;

        $config['listaPagamento'] = $this->PagamentoServicoModel->filtrar($dados,MAXIMOPAGINA,$inicio);

        if($mostrar){

            $this->load->view("pagamento/listar_pagamento",$config);

        }else{


        return $this->load->view("pagamento/listar_pagamento",$config,true);

        }

        $this->banco->desconetarBanco();

    }

    public function incluir($id_agenda=NULL){

        $titulo="Pagamento de Serviços ";

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Pagamento",'incluir'=>1));

        $this->banco->conetarBanco() ;

        $dados= $this->PagamentoModel->dados($this->input->post());

        $buscar= $this->PagamentoModel->filtrar($dados);

        if($this->input->post()==true){

            if(empty($buscar)){


                $this->banco->abrirTransacao();

                $id_Pagamento = $this->PagamentoModel->incluir($dados);

                if ($this->banco->verificarTransacao() === FALSE) {

                    $this->session->set_flashdata('erro', 'Não foi possível realizar o cadastro da Pagamento!');

                }else{


                    if(!empty($id_Pagamento)){


                      $dados = $this->input->post();

                      if(!empty($dados['id_agenda'])){


                        foreach ($dados['id_agenda'] as $key => $value) {

                            $this->AgendaModel->status($value);
                          // code...
                        }


                      }

                      foreach ($dados['id_servico_pag'] as $key => $value) {

                        $valor = $dados['valor_pag'][$key] *(1-($dados['desconto_pag'][$key]/100));

                        $dadosServ= array('id_pagamento' =>$id_Pagamento,
                                          'id_servico' =>$dados['id_servico_pag'][$key],
                                          'id_profissional' =>$dados['id_colaborador_pag'][$key],
                                          'valor' =>$valor,
                                          'desconto' =>$dados['desconto_pag'][$key]);

                        $this->PagamentoServicoModel->incluir($dadosServ);
                        // code...
                      }

                        $this->banco->confirmarTransacao();



                        $this->session->set_flashdata('sucesso', 'Cadastro da Pagamento realizado com sucesso');

                    }
                }

            }else{

                $this->session->set_flashdata('erro', 'Já há um cadastro de Pagamento com os mesmos dados');
            }


        }

        $config= $this->combos();

        $dadosPagamento = $this->PagamentoModel->dados();

        $filtroAgenda= array();

        if($id_agenda){

          $agenda=$this->AgendaModel->ver($id_agenda);

          if(!empty($agenda)){

            $dadosPagamento['id_cliente']=$agenda['id_cliente'];

            $filtro= array('data'=>$agenda['data'],'id_cliente'=>$agenda['id_cliente']);

            $filtroAgenda=$this->AgendaModel->filtrar($filtro);

          }




        }

        $config['abas']=$this->abas('','', $titulo);

        $config['action'] = site_url('Pagamento/incluir/');

        if(!empty($id_agenda)){
          $config['destino'] = site_url('Agenda/listar');

        }else{

          $config['destino'] = site_url('Pagamento/');


        }


        $config['target'] = ".conteudo";

        $config['filtroAgenda'] = $filtroAgenda;

        $config['modal'] = false;

        $config['dadosPagamento'] =  $dadosPagamento;

        $this->load->view("pagamento/form_pagamento",$config);

        $this->banco->desconetarBanco();

    }

    public function editar($modapublicl="false",$id){

        $titulo="Editar ";

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Pagamento",'editar'=>1));

        $this->banco->conetarBanco() ;

        $dados = $this->input->post();

        if($dados==true){

            $this->banco->abrirTransacao();

            $this->PagamentoModel->editar($dados);

            if ($this->banco->verificarTransacao() === FALSE) {

             $this->session->set_flashdata('erro', 'Falha ao atualizar cadastro da Pagamento!');

             } else {

                $this->banco->confirmarTransacao();

                $this->session->set_flashdata('sucesso', 'Atualização do cadastro da Pagamento realizada com sucesso!');

            }


        }

        $config= $this->combos();

        $config['abas']=$this->abas('','', $titulo);

        $config['destino'] = site_url('Pagamento/listar/'.$modal);

        $config['modal'] = false;

        if($modal=="true"){

            $config['target'] = ".vermodal";

        }else{

            $config['target'] = ".conteudoSked";

        }

        $config['action'] = site_url('Pagamento/editar/'.$modal.'/'.$id);

        $config['dadosPagamento'] = $this->PagamentoModel->ver($id);

        $this->load->view("pagamento/form_pagamento_ind",$config);

        $this->banco->desconetarBanco();

    }

    public function ver($id_Pagamento){

        $titulo=" Visualizar";

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Pagamento",'visualizar'=>1));

        $this->banco->conetarBanco() ;

        $config= $this->combos();

        $config['dadosPagamento'] = $this->PagamentoModel->ver($id_Pagamento);

        $config['abas'] = $this->abas($id_Pagamento,'Pagamento', $titulo);

        $config['console'] = $this->load->view("layout/console","",true);

        $this->load->view("pagamento/ver_pagamento",$config);

        $this->banco->desconetarBanco();

    }

    public function pagamentoAgenda($id_Agenda) {

      $modal=true;

        $titulo=" Gerar Pagamento";

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Agenda",'visualizar'=>1));

        $this->banco->conetarBanco() ;

        $config= $this->combos();

        $agenda =$this->AgendaModel->ver($id_Agenda);

        $dadosPagamento = $this->PagamentoModel->dados($agenda);

        $dadosPagamento['id_colaborador']=$agenda['id_profissional'];

        $config['abas'] = $this->abas($id_Agenda,'Agenda', $titulo);

        $config['console'] = $this->load->view("layout/console","",true);

        $config['dadosPagamento'] =  $dadosPagamento;

        $config['abas']=$this->abas('','', $titulo);

        $config['action'] = site_url('Pagamento/incluir/'.$modal);

        $config['destino'] = site_url('Pagamento');

        $config['modal'] = $modal;

        $config['target'] = ".conteudo";

        $this->load->view("pagamento/form_pagamento",$config);

        $this->banco->desconetarBanco();

    }

    public function excluir($modal="false",$id) {

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Pagamento",'excluir'=>1));

        $this->banco->conetarBanco();

        $this->banco->abrirTransacao();

        $this->PagamentoModel->excluir($id);

        if ($this->banco->verificarTransacao() === FALSE) {

            $this->session->set_flashdata('erro', 'Erro ao realizar exclusão da Pagamento!');

        } else {

            $this->banco->confirmarTransacao();

            $this->session->set_flashdata('sucesso', 'Sucesso ao realizar exclusão da Pagamento!');


        }

        redirect('Pagamento/listar/'.$modal);

        $this->banco->desconetarBanco();
    }

    public function excluirEmMassa() {

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Pagamento",'excluir'=>1));

        $this->banco->conetarBanco();

        $this->banco->abrirTransacao();

        $dados= $this->input->post();

        foreach ($dados['selecionado'] as $id) {

            $this->PagamentoModel->excluir($id);
        }

        if($this->banco->verificarTransacao() === FALSE) {

           $this->banco->cancelarTransacao();

           $this->session->set_flashdata('erro', 'Não foi possível excluir !');

       } else {

        $this->banco->confirmarTransacao();

        $this->session->set_flashdata('sucesso', 'Sucesso ao excluir pessoas! ');


        }

        $this->banco->desconetarBanco();

        redirect('Pagamento/listar/false');
    }

    public function relatorio() {

        $dados = $this->input->post();

        $this->ControleAcessoModel->redirecionar(array("modulo"=>"Pagamento",'visualizar'=>1));

          salvarFiltro('filtro_Pagamento',$dados);

          $titulo=" &#xf12e; Gerar Relatório/ pagamento";

          $config= $this->combos();

          $this->load->library("Pdf");

          $this->AcessoLoginModel->redirecionar();

          $this->banco->conetarBanco() ;

          $config['abas']=$this->abas('','', $titulo);

          $config['dadosPagamento'] = $this->PagamentoModel->dados($dados);

          if($dados){

            $config['listaPagamento']=$this->PagamentoModel->filtrar($dados);

            $config['total']=$this->PagamentoModel->contarTotal($dados);

            $config['colunas']=10;

            $pdf= new Pdf('','', 0,0, 2,2,2,2);

            $pdf->loadView("pagamento/relatorio_pagamento",$config,"rel_pagamento");
          }else{

          $config['action'] = site_url('Pagamento/relatorio');

          $this->load->view("pagamento/form_rel_pagamento",$config);


        }
          $this->banco->desconetarBanco();


    }

    public function adicionarLinha(){

        $dados = $this->input->post();

        $config = $this->combos($dados['id_cliente']);

        $config['action'] = site_url('entrega/incluir/');

        $config['urlComboRota'] = site_url('entrega/gerarComboRota/');

        $config['urlJsonRota'] = site_url('entrega/jsonRota/');

        $config['dadosPagamento'] =  $this->PagamentoModel->dados();

        $config['linha'] =  $dados['linha'];

        $config['id_cliente'] =  $dados['id_cliente'];


       $this->load->view("pagamento/form_linha",$config);


    }


}
