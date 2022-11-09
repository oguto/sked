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




class Domhtml 
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

        


    }

    function buscarTags($html,$tag){

    	$dom = new DOMDocument;

		$dom->loadHTML($html);

		$chave = $dom->getElementsByTagName($tag);		

		for ($i = 0; $i < $chave->length; $i ++){

		    $node = $chave->item($i);


		    print_r($node->getAttribute());

		   }


    }

    function inserirID($html,$tag){

    	$inicio = null;

    	$fim = null;

    	$dom = new DOMDocument;

		$dom->loadHTML($html);

		$chave = $dom->getElementsByTagName($tag);

		$td= $dom->getElementsByTagName("li");

		$ul = $dom->createElement('ul');

		$ul->setAttribute("class", "capitulos");

		$dom->appendChild($ul);

		for ($i = 0; $i < $td->length; $i ++){

		    $tdTag = $td->item($i);

		   	$isLink =$tdTag->getElementsByTagName("a");

		   	if($isLink->length==0){		   		

		   		$num = explode("a" ,$tdTag->nodeValue);	

		   		$tdTag->setAttribute("class", "capAtivo");   		

		   		$inicio = trim($num[0]);

		   		$fim = trim($num[1]);

		   	}		   

		}


		for ($i = 0; $i < $chave->length; $i ++){

		    if($inicio<=$fim){

		    	$p = $chave->item($i);

			    $li = $dom->createElement('li');

			    $ul->appendChild($li);

			    $a = $dom->createElement('a',$inicio);

			    $a->setAttribute("href", "#capitulo_".$inicio);

			    $p->setAttribute("class", "capitulo");

			    $p->setAttribute("id", "capitulo_".$inicio);

			    $li->appendChild($a);
			}

		    $inicio++;


		}

		


		

		$html=$dom->saveHTML();

		return $html;


    }

   


    	
}
