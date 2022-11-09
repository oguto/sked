<?php
/**
 * CodeIgniter Boleto
 *
 * @package    CodeIgniter Boleto
 * @author     Natan Felles
 * @link       https://github.com/natanfelles/codeigniter-boleto
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 | -------------------------------------------------------------------
 | PADRÃO
 | -------------------------------------------------------------------
 | TRUE = Usar as configurações desse arquivo
 | FALSE = Não usar as configurações desse arquivo
*/
$config['boleto']['padrao'] = TRUE;

/*
 | -------------------------------------------------------------------
 | BANCO
 | -------------------------------------------------------------------
 | bancoob = Banco Cooperativo do Brasil S/A
 | banespa = Banco do Estado de São Paulo
 | banestes =  Banco do Estado do Espírito Santo
 | bb = Banco do Brasil
 | besc = Banco do Estado de Santa Catarina
 | bradesco = Bradesco
 | cef = Caixa Econômica Federal
 | cef_sigcb = Caixa Econômica Federal SIGCB
 | cef_sinco = Caixa Econômica Federal SINCO
 | hsbc = HSBC Bank Brasil
 | itau = Itaú Unibanco
 | nossacaixa = Banco Nossa Caixa
 | real = Banco Real
 | santander_banespa = Santander Banespa
 | sicredi = Banco Cooperativo Sicredi - BANSICREDI
 | sofisa = Banco Sofisa
 | sudameris = Banco Sudameris
 | unibanco = Unibanco
 */
$config['boleto']['banco'] = 'itau';

/*
 | -------------------------------------------------------------------
 | CEDENTE
 | -------------------------------------------------------------------
 */
$config['boleto']['cedente'] = array(
	'nome'    => '"A. SOARES DA CRUZ FILHO ME',
	'cpf_cnpj'    => '13.005.208/0001-45',
	'agencia' => '1599',
	'conta'  => '19531-8',
	'conta_cedente'  => '987654-5',
	'carteira'  => '109',
	'nosso_numero'  => '12345678',
	'endereco' => 'RUA SENHO DO BOMFIM 141 ZZ SANTA CRUZ SALVADOR-BA 41920-120',
	'cidade' => 'SALVADOR-BAHIA',
	'uf' => 'RS',
);

/*
 | -------------------------------------------------------------------
 | DEMONSTRATIVO
 | -------------------------------------------------------------------
 */
$config['boleto']['demonstrativo'] = array(
	'linha1' => 'Pagamento de serviços agilizeexpress',
	'linha2' => 'Taxa bancária: R$ '.number_format(4.50,1, ',', '').'',
	'linha3' => 'Boleto - http://www.agilizeexpress.com.br',
);

/*
 | -------------------------------------------------------------------
 | INSTRUÇÕES
 | -------------------------------------------------------------------
 */
$config['boleto']['instrucoes'] = array(
	'linha1' => '<br>- Sr. Caixa, cobrar multa de 2% após o vencimento',
	'linha2' => '- Receber até 10 dias após o vencimento',
	'linha3' => '- Em caso de dúvidas entre em contato conosco: contato@agilizeexpress.com.br',
	'linha4' => '- &nbsp; Emitido pelo sistema ".EMPRESA." - www.agilizeexpress.com.br',
);

/*
 | -------------------------------------------------------------------
 | LOCAL DAS IMAGENS
 | -------------------------------------------------------------------
 */
$config['boleto']['imagens'] = 'assets/img/boleto';
