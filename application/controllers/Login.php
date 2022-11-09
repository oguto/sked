<?php

class Login extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->model('admin/AcessoLoginModel');

        $this->load->model('pessoa/Pessoausuario');

    }

    public function enviarEmail($dados){

        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.sparkpostmail.com',
            'smtp_port' => 587,
            'smtp_user' => 'SMTP_Injection',
            'smtp_pass' => 'db09f466695800acd9d83e71f336bfe04abe65a9',
            'mailtype'  => 'html',
            'charset'   => 'utf-8'
        );

        $this->load->library('email', $config);

        $this->email->set_newline("\r\n");

        $this->email->from('naoresponda@appmail.nelos.com.br', 'Sistema Sked');

        $data = array(
             'conteudo'=> $dados['conteudo'],
              'botao'=> $dados['botao'],
                 );

        $this->email->to($dados['email']);  // replace it with receiver mail id

        $this->email->subject($dados['assunto']); // replace it with relevant subject

        $body = $this->load->view('email/layout.php',$data,TRUE);

        $this->email->message($body);

        $this->email->send();

    }

    public function index() {

        $this->banco->conetarBanco();

        $dados=$this->input->post();

        if($dados==true){

            $login=$this->AcessoLoginModel->logar($dados);

            if(!empty($login)){

               $this->session->set_userdata('login',$login);

               $this->session->set_userdata('usuario',$login);

               redirect("home");

            }else{

                $this->session->set_flashdata('erro', 'Email ou senha incorretos!');

                redirect("login");
            }


        }else{

            $config['console'] = $this->load->view("layout/console","",true);

            $info['content'] = $this->load->view("layout/login/form", $config, TRUE);

            $this->load->view("layout/login/login", $info);
        }
         $this->banco->desconetarBanco();

    }

    public function redefinir() {

        $dados=$this->input->post();

        if($dados==true){

            $resultado = $this->AcessoLoginModel->recuperar($dados);

            if(!empty($resultado)){


                $codigo = "escola-";

                $codigo = $codigo .$resultado['id'];

                $codigo = base64_encode($codigo.'-'.date("dmY"));

                $conteudo = "<b>".$resultado['nome']."</b>, você recebeu esse email por ter usado a funcionalidade <br>''Esqueci Minha Senha'' no Sistema Sked.<br> ";

                $conteudo .="<b>Clique no botão abaixo para redefinir a sua senha!</b>";

                $envio =  array('assunto' =>'Redefinição de Senha' ,
                            'email' =>$resultado['email'],
                            'conteudo' => $conteudo,
                            'botao' =>array('link' =>site_url('login/alterarSenha').'/'.$codigo,
                                            'titulo' =>'Redefinir senha')
                            );

                $this->enviarEmail($envio);

                $this->session->set_flashdata('sucesso', 'Um email para alteração de senha foi enviado para <b>'. $resultado['email'].'</b> !');

                redirect("login");



            }else{

                $this->session->set_flashdata('erro', 'Nenhum dado foi encontrado!');

                redirect("login/redefinir");
            }


        }else{


            $config['console'] = $this->load->view("layout/console","",true);

            $info['content'] = $this->load->view("layout/login/form_r_senha", $config, TRUE);

            $this->load->view("layout/login/login", $info);
        }

    }



      public function sair() {

        $this->session->unset_userdata('login');

        redirect("home");


    }


     public function alterarSenha($token=null){


         $dados=$this->input->post();

         $info = array();

        if($dados==true){

            if($dados['senha1']==$dados['senha2']){

                if(!empty($dados['user_token'])){

                    $codigo = base64_decode($dados['user_token']);

                    $codigo = explode("-", $codigo);

                    $alterarSenha['id']=$codigo[1];

                    $alterarSenha['senha']=senha($dados['senha1']);

                    $this->AcessoLoginModel->editarSenha($alterarSenha);

                     $this->session->set_flashdata('sucesso', 'Senha alterada com sucesso!');

                    redirect('login');

                }



            }else{

               $config['token'] = $dados['user_token'];

               $config['console'] = $this->load->view("layout/console","",true);

                $this->session->set_flashdata('erro', 'As senhas digitadas são diferentes!');

               redirect('login/alterarSenha/'.$dados['user_token']);

            }


        }else{


            if($token){

                $codigo = base64_decode($token);

                $codigo = explode("-", $codigo);

                if($codigo[2]==date('dmY')){

                    if($codigo[0]=="escola"){


                           $config['token'] = $token;

                           $config['console'] = $this->load->view("layout/console","",true);

                           $info['content'] = $this->load->view("layout/login/editar_senha",$config,TRUE);


                    }else{


                        $this->session->set_flashdata('erro', 'Operação Inválida!');

                        redirect("login");



                    }



                }else{




                $this->session->set_flashdata('erro', 'A validade do email de redefinição de senha expirou. <br/><b>Solicite a redefinição de senha novamente! </b>');

                redirect("login");

                }



            }


        }






        $this->load->view("layout/login/login", $info);

    }


    public function gerarSenha(){

        print_r(senha("Aplicativo2021"));
    }








}
