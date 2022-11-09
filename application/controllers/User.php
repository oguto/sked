<?php

class User extends MY_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->model('admin/Usuario');

        $this->load->model('admin/Usuariomodel');

        $this->load->library('paginacaonelos');


    }

    function abasUser($id_aluno=null,$active,$titulo=null){

       $abasUser=array();

       $abasUser[] =array(
        'class'=>'user',
        'url'=>site_url('/aluno/ver/'.$id_aluno),
        'titulo'=>'Informações de ministerio',
        'icone'=>'&#xf2e6;'
        );

          return abas($abasUser,$active,$titulo);
    }

    function index($content = NULL) {

        $config['abas'] = $this->abasUser("","user","&#xf17f; Minha Conta");

        $config['usuario']= $this->Usuario->ver();

        $config['console'] = $this->load->view("layout/console","",true);
      
        $this->load->view("usuario/ver",$config);
    } 

    function listar($content = NULL) {

        $config['usuario']= $this->Usuariomodel->dados();

        $config['abas'] = $this->abasUser("","user","&#xf17f; Minha Conta");

        $config['listarUsuario']= $this->Usuariomodel->listar();

        $config['console'] = $this->load->view("layout/console","",true);

        $paginacao=configPaginacao(MAXIMOPAGINA,'#telaPrincipal');

        $paginacao['base_url'] = site_url('ministerio/listar');

        $paginacao['total_rows'] =  10;

        $this->paginacaonelos->initialize($paginacao);

        $config['paginacao'] = $this->paginacaonelos->create_links();
      
        $this->load->view("usuario/listar",$config);
    }   

    public function modificarSenha() {       

        $this->Usuario->redirecionar();

        $this->banco->conetarBanco() ;

        $dados= $this->input->post();

        if($dados['senha']==$dados['confirm_senha']){

            unset($dados['confirm_senha']);

            $dados['senha']=senha($dados['senha']);

            if($dados){
                    $this->banco->abrirTransacao();

                     $this->Usuario->editar($dados);

                    if ($this->banco->verificarTransacao() === FALSE) {

                        $this->session->set_flashdata('erro',"Alteração de senha falhou!");


                    } else {

                        $this->banco->confirmarTransacao();

                        $this->session->set_flashdata('sucesso',"Sucesso ao alterar senha!");

                    }

                  
                   

            }else{

                $this->banco->desconetarBanco();
            }

        }else{

            $this->session->set_flashdata('sucesso',"As senhas digitadas não são iquais!");
        }

        redirect('user');

    } 


    public function validarFile($file){

       
        $_UP['extensoes'] = array('image/jpeg', 'image/jpg', 'image/gif','image/png');

        $_UP['tamanho'] = 51200; // 50KB

        $tipo = $file['imglogo']['type'];

        if (array_search($tipo, $_UP['extensoes']) === false) {

            $this->session->set_flashdata('erro',"Por favor, envie arquivos com as seguintes extensões: jpg, png ou gif");

             redirect('user');

            exit;
        }

        if ($_UP['tamanho'] < $file['imglogo']['size']) {

           $this->session->set_flashdata('erro',"O arquivo enviado é muito grande, envie arquivos de até 50KB.");

            redirect('user');

            exit;
        }



    }




    public function modificarLogo() {       

        $this->Usuario->redirecionar();

        $this->banco->conetarBanco() ;  

        if($_FILES['imglogo']){

            $this->validarFile($_FILES);

            $admin = $this->Usuario->verId();

            $extensao = explode('.', $_FILES['imglogo']['name']);

            $extensao = strtolower($extensao[1]);          

            $uploadfile = 'includes/logo/'.$admin.'.'.$extensao;

            
            if (move_uploaded_file($_FILES['imglogo']['tmp_name'], $uploadfile)) {

                    $dados['id']= $admin;

                    $dados['logo']= $admin.'.'.$extensao;               
                
                    $this->banco->abrirTransacao();

                    $this->Usuario->editar($dados);

                    if ($this->banco->verificarTransacao() === FALSE) {

                        $this->session->set_flashdata('erro'," upload falhou!");


                    } else {

                        $this->banco->confirmarTransacao();

                        $this->session->set_flashdata('sucesso',"Sucesso ao fazer upload!");

                    }

                    $this->banco->desconetarBanco();
                    
                
            } else {


                $this->session->set_flashdata('erro',"Nenhuma imagem foi enviada");
                
            }


        }

        redirect('user');

    }


    public function push(){

        $token = array('dJl7L0o-4RY:APA91bFswoqokblwNqfhsgCurS2JoWStM8dMtwj26vibvx3V8oK3a13Xkjjj76J1rInTuveCh8WQ3xD0rt7eWPRhDxGqNTQChMvG-j8dvCDcZLBfNWONrTsS1l9HE3T2h8EXMNhSeSjo');



        msgPushMovimento("Gabriel saiu da escola",$token,'atv');
    } 


     public function qr(){

         $this->load->library('ciqrcode');

        $params['data'] ="codigo do aluno";
        $params['level'] = 'H';
        $params['size'] = 10;
        $params['savename'] = FCPATH.'tes.png';
        $this->ciqrcode->generate($params);

        echo '<img src="'.base_url().'tes.png" />';
    } 




   

}
