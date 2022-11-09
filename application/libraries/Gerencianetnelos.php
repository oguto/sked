<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter PDF Library
 *
 * Generate PDF's in your CodeIgniter applications.
 *
 * @package			CodeIgniter
 * @subpackage		Libraries
 * @category		Libraries
 * @author			Yudha Pratama
 * @license			None
 * @link			https://github.com/shinryu99/ci-mpdf
 */

//require_once(dirname(__FILE__) . '/vendor/Gerencianet.php');


require dirname(__FILE__) .'/vendor/autoload.php';

use Gerencianet\Exception\GerencianetException;
use Gerencianet\Gerencianet;

class Gerencianetnelos 
{ 	

	private $clientId;

	private $apiKey;

	public $options ;

	protected function ci()
	{
		return get_instance();
	}

	

	 public function __construct() {

        $this->ci()->load->model('boleto/Boletoadminmodel');

        $login = $this->ci()->Boletoadminmodel->verAtivo();

        $this->ci()->load->library("session");

        $this->setCliente($login['login']);

        $this->setChave($login['senha']);

    }
	

	public function setChave($key) {
        $this->apiKey = $key;
    }

    public function setCliente($clientId) {
        $this->clientId =  $clientId;
    }


    private function autorizar() {

    	$login= array();

        $login['client_id'] = $this->clientId;

        $login['client_secret'] = $this->apiKey;

        if(ENVIRONMENT=="production"){

			$login['sandbox'] = false;

		}

		elseif (ENVIRONMENT=="development") {

			$login['sandbox'] = true;
			
		}

        return $login;

    }



    private function arrayToString($array){

    	$dados ="";

    	foreach ($array as $key => $value) {

            $dados = $dados.$key."=".$value;
          
         }

         return $dados;

    }

    function formatarDados($dados){

    	$ocr = array("(",")","-",".","/");
    	$subst = array("","","","","");

    	return str_replace($ocr,$subst,$dados);
    }
	

	//CARNÊ

	function gerarCarne($dados){	

		try {
		    $api = new Gerencianet($this->autorizar());

		    $carnet = $api->createCarnet([], $dados);

		    return $carnet['data']; 


		} catch (GerencianetException $e) {

		   print_r($e->errorDescription);

		} catch (Exception $e) {

		    print_r($e->getMessage());
		}

	}

	function editarCarne($body){		

		try {
		    $api = new Gerencianet($this->autorizar());

		    $carnet = $api->createCarnet([], $body);

		    return $carnet['data']; 


		} catch (GerencianetException $e) {

		   print_r($e->errorDescription);

		} catch (Exception $e) {

		    print_r($e->getMessage());
		}

	}

	function excluirCarne($id){

		$params = ['id' => $id];		

		try {
		    $api = new Gerencianet($this->autorizar());

		    $carnet = $api->cancelCarnet($params,[]);

		    return $carnet['data']; 


		} catch (GerencianetException $e) {

		   print_r($e->errorDescription);

		} catch (Exception $e) {

		    print_r($e->getMessage());
		}

	}

	function verCarne($id){		

		$params = ['id' => $id];		

		try {
		    $api = new Gerencianet($this->autorizar());

		    $carnet = $api->detailCarnet($params,[]);

		    return $carnet['data']; 


		} catch (GerencianetException $e) {

		   print_r($e->errorDescription);

		} catch (Exception $e) {

		    print_r($e->getMessage());
		}

	}

	function verParcela($id){

		$params = ['id' => $id];		

		try {
		    $api = new Gerencianet($this->autorizar());

		    $boleto = $api->detailCharge($params, []);

		    return $boleto; 


		} catch (GerencianetException $e) {

		   print_r($e->errorDescription);

		} catch (Exception $e) {

		    print_r($e->getMessage());
		}
	}

	function editarParcela($id_carne,$data){

		$params = ['id' => $id_carne,'parcel' => 1];

		$body = [
			'expire_at' =>$data
		];		

		try {
		    $api = new Gerencianet($this->autorizar());

		    $boleto = $api->updateParcel($params, $body);

		    return $boleto; 


		} catch (GerencianetException $e) {

		   print_r($e->errorDescription);

		} catch (Exception $e) {

		    print_r($e->getMessage());
		}
	}

	//BOLETO

	function editarBoleto($id,$data){

		$params = ['id' => $id];

		$body = [
			'expire_at' =>$data
		];		

		try {
		    $api = new Gerencianet($this->autorizar());

		    $boleto = $api->updateBillet($params, $body);

		    return $boleto; 


		} catch (GerencianetException $e) {

		   print_r($e->errorDescription);

		} catch (Exception $e) {

		    print_r($e->getMessage());
		}
	}

	function verBoleto($id){

		$params = ['id' => $id];		

		try {
		    $api = new Gerencianet($this->autorizar());

		    $boleto = $api->detailCharge($params, []);

		    return $boleto; 


		} catch (GerencianetException $e) {

		   return false;

		} catch (Exception $e) {

		    return false;
		}

	}



	function criarProduto($dados){

		$items = [['name' => $dados['descricao'],'amount' => 1,'value' => intval($dados['valor']) ]];

		$body  =  [
		    'items' => $items
		];

		try {

		    $api = new Gerencianet($this->autorizar());

		    $charge = $api->createCharge([], $body);
		 
		   return $charge['data'];

		} catch (GerencianetException $e) {

		    print_r($e->code);

		    print_r($e->error);

		    print_r($e->errorDescription);

		} catch (Exception $e) {

		    print_r($e->getMessage());

		}



	}

	function gerarBoleto($charge_id,$dados,$dadosPF=array(),$vencimento){

		$params = [
		  'id' => $charge_id
		];
		 

		if(!empty($dadosPF)){

			if(empty($dadosPF['tel'])){

				$dadosPF['telefone']=$dadosPF['cel'];
			}else{

				$dadosPF['telefone']=$dadosPF['tel'];
			}

			$juridical_data = [
			  'corporate_name' => $dados['razao_social'], // nome da razão social
			  'cnpj' => $this->formatarDados($dados['cnpj']) // CNPJ da empresa, com 14 caracteres
			];
		 
			$customer = [
			  'name' => $dadosPF['nome'], // nome do cliente
			  'cpf' => 	$this->formatarDados($dadosPF['cpf']), // cpf do cliente
			  'phone_number' => $this->formatarDados($dadosPF['telefone']), 
			  'juridical_person' => $juridical_data
			];
		}else{

			if(empty($dados['tel'])){

				$dados['telefone']=$dados['cel'];
			}else{

				$dados['telefone']=$dados['tel'];
			}

			$customer = [
			  'name' => $dados['nome'], // nome do cliente
			  'cpf' => 	$this->formatarDados($dados['cpf']),//$dados['cpf'], // cpf do cliente
			  'phone_number' =>$this->formatarDados($dados['telefone']),//$dados['cel']
			];

		}
		 
		$banking_billet = [
		  'expire_at' => $vencimento,
		  'customer' => $customer
		];
		 
		$payment = [
		  'banking_billet' => $banking_billet 
		];
		 
		$body = [
		  'payment' => $payment
		];
		 
		try {

		    $api = new Gerencianet($this->autorizar());

		    $charge = $api->payCharge($params, $body);
		 
		    return $charge;

		} catch (GerencianetException $e) {

			$erro= "Verifique se o cadastro há pelo menos um contato de telefone ou se o CPF ou CNPJ está correto!";
	    
		    $this->ci()->session->set_flashdata('erro',$erro);

		    return false;

		} catch (Exception $e) {

		    $erro= "Verifique se o cadastro há pelo menos um contato de telefone ou se o CPF ou CNPJ está correto!";
	    
		    $this->ci()->session->set_flashdata('erro',$erro);

		    return false;
		}
	}

	function dadosBoleto($dados){

		$array = array();

	    $array['id_boleto'] = $dados['data']['charge_id'];

        $array['barcode'] = $dados['data']['barcode'];

        $array['url_boleto'] = $dados['data']['link'];

        $array['id_plataforma'] = GERENCIANET;

        return $array;

	}
	




	



	
}
