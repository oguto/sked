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




class Asaas 
{ 

	private $apiKey;

	private $url;

	private $url_carne;

	public $options ;

	protected function ci()
	{
		return get_instance();
	}

	

	public function __construct() {

        $this->ci()->load->model('boleto/Boletoadminmodel');

        $login = $this->ci()->Boletoadminmodel->verAtivo();

        $urlTeste = 'https://sandbox.asaas.com/api/v3/';

        $this->setKey($login['senha']);

        if(ENVIRONMENT=="production"){

			$this->url = $login['url'];

			if($login['url']==$urlTeste){

				$this->url_carne = "https://sandbox.asaas.com/ins/paymentBook/";

			}else{

				$this->url_carne = "https://www.asaas.com/ins/paymentBook/";

			}

			

		}

		elseif (ENVIRONMENT=="development") {

			$this->url = 'https://sandbox.asaas.com/api/v3/';

			$this->url_carne = "https://sandbox.asaas.com/ins/paymentBook/";

			
		}


    }

     function dadosNotificacoes($status=true) {
        
        if($status==true){

        	$array['emailEnabledForProvider'] =false;

        	$array['smsEnabledForProvider'] =false;

	        $array['emailEnabledForCustomer'] =true ;

	        $array['smsEnabledForCustomer'] =true ; 

        }else if($status==false){
        	
        	$array['emailEnabledForProvider'] =false;

        	$array['smsEnabledForProvider'] =false;

        	$array['emailEnabledForCustomer'] =false ;

	        $array['smsEnabledForCustomer'] =false ; 

        }    

        return $array;
    }

   




	public function setKey($key) {
        $this->apiKey = $key;
    }

    private function arrayToString($array){

    	$dados ="";

    	foreach ($array as $key => $value) {

            $dados = $dados.$key."=".$value;
          
         }

         return $dados;

    }

    function formataCpf($cpf){

		$dados = array(".","/","_","-");

		return str_replace($dados,"", $cpf);

	}

   
	function post_asaas($tipo, $dados){

		$urlpost = $this->url.$tipo;

		$headers = array('Content-Type: application/json','access_token:'.$this->apiKey);

		$ch = curl_init();

		curl_setopt( $ch, CURLOPT_URL, $urlpost );

		curl_setopt( $ch, CURLOPT_POST, true );

		curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);

		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

		curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode($dados));

		$result = curl_exec($ch);

		return  json_decode($result,TRUE);

	}	

	function get_asaas($tipo, $filtro){

	 	$filtro= $this->arrayToString($filtro);		

		$urlget = $this->url.$tipo.'?'.$filtro;

		$headers = array('Content-Type: application/json','access_token:'.$this->apiKey);

		$ch = curl_init();

		curl_setopt( $ch, CURLOPT_URL, $urlget );

		curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);

		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

		$result = curl_exec($ch);

		return  json_decode($result,TRUE);

	}


	function listarNotificacoes($id_cliente){

		$urlget = $this->url."customers/".$id_cliente."/notifications";

		$headers = array('Content-Type: application/json','access_token:'.$this->apiKey);

		$ch = curl_init();

		curl_setopt( $ch, CURLOPT_URL, $urlget );

		curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);

		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

		$result = curl_exec($ch);

		return  json_decode($result,TRUE);

	}

	function desativarNotificacoes($id_cliente){

		$notificacoes = $this->listarNotificacoes($id_cliente);

		$notificacoes = $notificacoes['data'];

		foreach($notificacoes as $dadosNotificacoes){

			if($dadosNotificacoes['event']=="PAYMENT_RECEIVED"){

				$this->post_asaas("notifications/".$dadosNotificacoes['id'],$this->dadosNotificacoes(false));

			}else if($dadosNotificacoes['event']=="PAYMENT_CREATED"){

				$this->post_asaas("notifications/".$dadosNotificacoes['id'],$this->dadosNotificacoes(false));

			}else if($dadosNotificacoes['event']=="PAYMENT_UPDATED"){

				$this->post_asaas("notifications/".$dadosNotificacoes['id'],$this->dadosNotificacoes(false));

			}

			else{

				$this->post_asaas("notifications/".$dadosNotificacoes['id'],$this->dadosNotificacoes());


			}



		}

	}


	function delete_asaas($tipo, $id){

		$urlget = $this->url.$tipo.'/'.$id;

		$headers = array('Content-Type: application/json','access_token:'.$this->apiKey);

		$ch = curl_init();

		curl_setopt( $ch, CURLOPT_URL, $urlget );

		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

		curl_setopt($ch, CURLOPT_HEADER, FALSE);

		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

		curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);

		return  json_decode($result,TRUE);

	}

	function dadosCliente($dados){

		$dadosArray = array('name'=>$dados['nome'],
					   'email'=>$dados['email'],
					   'cpfCnpj'=>$this->formataCpf($dados['cpf']),
					   'externalReference'=>$dados['id'],
					   'mobilePhone'=>$dados['cel'],
					   'phone'=>$dados['tel']);

		return $dadosArray;
	}

	function dadosBoletoNelos($dados){

		$dadosArray = array('name'=>$dados['nome'],
					   'email'=>$dados['email'],
					   'cpfCnpj'=>$this->formataCpf($dados['cpf']),
					   'externalReference'=>$dados['id'],
					   'mobilePhone'=>$dados['cel'],
					   'phone'=>$dados['tel']);

		return $dadosArray;
	}

	function dadosBoleto($dados){

		$dadosArray = array( 'dueDate'=>$dados['dia_vencimento'],
	                    'externalReference'=>$dados['id_fatura'],
	                    'description'=>$dados['descricao'],
	                    'value'=>$dados['valor'],
	                    'billingType'=>"BOLETO");

		return $dadosArray;
	}

	function dadosCobrancaParcelada($dados){

		$dadosArray = array('dueDate'=>$dados['dia_vencimento'],
	                    	'description'=>$dados['descricao'],
	                    	'installmentValue'=>$dados['valor'],
	                    	'installmentCount'=>$dados['parcelas'],
	                    	'billingType'=>"BOLETO");

		return $dadosArray;
	}
	 				

	function criarCliente($dados){

		$dados = $this->dadosCliente($dados);

		$buscarCliente = $this->verCliente($dados['externalReference']);

		if(empty($buscarCliente['totalCount'])){

			$cliente = $this->post_asaas("customers", $dados);

			$this->desativarNotificacoes($cliente['id']);	

			return $cliente;

		}else{

			$dadosAsaas = $buscarCliente['data'];

			$dadosAsaas = $dadosAsaas['0'];

			$cliente = $this->post_asaas("customers/".$dadosAsaas['id'], $dados);	

			$this->desativarNotificacoes($cliente['id']);		

			return $cliente;
		}



	}

	function verCliente($id){

		if(!empty($id)){

			$dados = array('externalReference'=>$id);

			return $this->get_asaas("customers", $dados);

		}else{

			return array();
		}

	}

	function verCobrancaParcelada($id){

		if(!empty($id)){

			$dados = array('installment'=>$id);

			$cobrancas = $this->get_asaas("payments", $dados);

			return $cobrancas['data'];
		}else{

			return array();
		}

	}

	function verCobranca($id){

		if(!empty($id)){

			$dados = array('externalReference'=>$id);

			$cobrancas = $this->get_asaas("payments", $dados);

			$array = $cobrancas['data'];

			if(!empty($array)){

				return $array[0];


			}else{

				return false;


			}
		}else{

			return array();
		}	

	}

	function incluirIdNelos($id,$id_fatura){

		$dados = array('externalReference'=>$id_fatura);

		$cobranca = $this->post_asaas("payments/".$id, $dados);		

	}


	function listarAssinaturas($id){

		if(!empty($id)){

			$dados = array('customer'=>$id);

			return $this->get_asaas("subscriptions", $dados);
		}else{

			return array();
		}

	}

	function gerarCobrancaParcelada($dadosCliente,$cobranca){

		$dadosArray = array();

		$cliente = $this->criarCliente($dadosCliente);

		$cobranca = $this->dadosCobrancaParcelada($cobranca);

		$cobranca['customer'] = $cliente['id'];

		log_message('error', json_encode($cobranca));

		$cobrancaGerada = $this->post_asaas("payments", $cobranca);

		log_message('error', json_encode($cobrancaGerada));
		
		$dadosArray['id_carne']= $cobrancaGerada['installment'];

		$dadosArray['url']= $this->url_carne.$cobrancaGerada['installment'];		

		$dadosArray['dados'] =  $this->verCobrancaParcelada($cobrancaGerada['installment']);

		return $dadosArray;

	}

	function editarCobrancaParcelada($id,$dados){

		$result = $this->post_asaas("payments/".$id,$dados);


		return $result;


	}

	function gerarBoleto($dadosCliente,$cobranca){

		$dadosArray = array();

		$cliente = $this->criarCliente($dadosCliente);

		$cobranca = $this->dadosBoleto($cobranca);

		$cobranca['customer']=$cliente['id'];				

		$cobrancaGerada= $this->post_asaas("payments", $cobranca);

		$dadosArray['id_boleto']= $cobrancaGerada['id'];

		$dadosArray['id_fatura']= $cobrancaGerada['externalReference'];

		$dadosArray['id_documento']= $cobrancaGerada['invoiceNumber'];		

		$dadosArray['url_boleto']= $cobrancaGerada['bankSlipUrl'];

		$dadosArray['valor_liquido']= $cobrancaGerada['netValue'];

		$dadosArray['valor_bruto']= $cobrancaGerada['value'];

		$dadosArray['valor_corrigido']= $cobrancaGerada['originalValue'];

		return $dadosArray;

	}

	function deletarBoleto($id){

		$boleto = $this->verCobranca($id);

		if(!empty($boleto)){

			return $this->delete_asaas("payments", $boleto['id']);
		}		

	}

	//NELOS

	function atualizarFaturaNelos($dadosPagamento){

		$this->ci()->load->model('financeiro/Faturamodel');

		$dados = array( 'data_pagamento' => $dadosPagamento['clientPaymentDate'],
                        'valor_pago'=>$dadosPagamento['value']+$dadosPagamento['interestValue'],
                        'valor_bruto'=>$dadosPagamento['value']+$dadosPagamento['interestValue'],
                        'valor_liquido'=>$dadosPagamento['netValue'],
                        'id'=>$dadosPagamento['externalReference'] );

		$this->ci()->Faturamodel->editarExterno($dados);


	}

	
}
