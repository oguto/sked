<?php


    function removerTexto($frase,$texto){

         $resultado= str_replace($frase," ",$texto);

         return $resultado;


    }


    function analisar($dados) {

         if(isset($dados)){

             return $dados;
         }
    }


     function arrayFoo($key, $arrayList) {

        $array=array();

        if(!empty($arrayList)){

            foreach ($arrayList as $dados) {

                     $array[]=$dados[$key];
            }

        }

        return $array;
    }

     function arrayCombo($keyId,$keyDescriao, $arrayList,$frase=null) {

         $array=array();

        if(!empty($frase)){

             $array=array(''=>$frase);
        }

        foreach ($arrayList as $dados) {

                 $array[$dados[$keyId]]=$dados[$keyDescriao];
        }


         return $array;
    }

    function arrayComboBiDesc($keyId,$keyDescriao,$separador, $keyDescriao2, $arrayList,$frase=null) {

        $array=array();

        if(empty($frase)){

             $array=array(''=>"Selecione...");


        }else{

             $array=array(''=>$frase);


        }


        foreach ($arrayList as $dados) {

                 $array[$dados[$keyId]]=$dados[$keyDescriao].$separador.$dados[$keyDescriao2];
        }


         return $array;
    }

    function jsonCombo($keyId,$keyDescriao, $arrayList,$frase=null) {

        $jsonArray=array();

        if(!empty($frase)){


             $jsonArray=array('0'=>$frase);

        }


        foreach ($arrayList as $dados) {

                 $jsonArray[$dados[$keyId]]=$dados[$keyDescriao];
        }


         return json_encode($jsonArray);
    }


     function jsonComboByDesc($keyId,$keyDescriao,$separador,$keyDescriao2, $arrayList,$frase=null) {

        $jsonArray=array();

        if(empty($frase)){

             $jsonArray=array('0'=>"Selecione...");


        }else{

             $jsonArray=array('0'=>$frase);

        }


        foreach ($arrayList as $dados) {

                 $jsonArray[$dados[$keyId]]=$dados[$keyDescriao].$separador.$dados[$keyDescriao2];
        }


         return json_encode($jsonArray);
    }




    function salvarFiltro($nome, $array){

         $filtro= array($nome=>$array);

         $CI =& get_instance();

         $CI->load->library('session');

         $CI->session->set_flashdata($filtro);
    }

     function recuperarFiltro($nome){

        $CI =& get_instance();

        $CI->load->library('session');

        if($CI->session->flashdata($nome)){

            return $CI->session->flashdata($nome);


        }else{

            return array();

        }


    }

    function configPaginacao($porPagina,$target,$class=NULL){

    $classPaginacao = "loadTarget";

    if($class!=NULL){

        $classPaginacao=$class;
    }

    $paginacao= array();

    $paginacao['per_page'] = $porPagina;

    $paginacao['attributes'] = array('data-target'=>$target,'class'=>$classPaginacao);

    $paginacao['first_link'] = '&lsaquo; Primeiro';

    $paginacao['next_link'] = '&gt;';

    $paginacao['prev_link'] =  '&lt;';

    $paginacao['last_link'] = 'Último &rsaquo;';

    return $paginacao;


    }

    function configPaginacaoModal($porPagina,$target){

    $paginacao= array();

    $paginacao['per_page'] = $porPagina;

    $paginacao['attributes'] = array('data-target'=>$target,'class'=>'abrirPagina');

    $paginacao['first_link'] = '&lsaquo; Primeiro';

    $paginacao['next_link'] = '&gt;';

    $paginacao['prev_link'] =  '&lt;';

    $paginacao['last_link'] = 'Último &rsaquo;';

    return $paginacao;


    }



    function arrayTabela($tabela,$arrayDados) {

       $array = array();

       unset($arrayDados['admin']);

        foreach ($arrayDados as $key => $value) {

             $array[$tabela.".".$key]=$value;

        }

        $array = array_filter($array);

        $array[$tabela.'.exclusao'] = null;

        return $array;
     }


    function arrayRelacao(){

    }


    function autoCompletar($array=array()){

        foreach ($array as $key => $value) {

             if($array[$key]==null){

                 $array[$key] = "<i>Não informado!</i>";

             }

        }

        return $array;
    }

    function dataBR($data) {

        $dateH = explode(" ", $data);

        $date = explode("-", $dateH[0]);

        if (empty($data)) {

            $dateFormt=null;

        }else{

            if( $date[0]=="0000"){

                $dateFormt=null;



            }else{
            $dateFormt = $date[2] . "/" . $date[1] . "/" . $date[0];
            }
        }

        if(!empty($dateH[1])){

            if( $date[0]!="0000"){

                $dateFormt =$dateFormt." ".$dateH[1];
             }

        }

        return $dateFormt;
    }


    function dataHTML5($data) {

        $dateH = explode(" ", $data);

        if (empty($data)) {

            $dateFormt=null;

        }else{

            $dateFormt = $dateH[0] . "T" . $dateH[1];
        }

        return $dateFormt;
    }

    function dataHTML5ParaUS($data) {

        $dateH = explode("T", $data);

        if (empty($data)) {

            $dateFormt=null;

        }else{

            $dateFormt = $dateH[0];
        }

        return $dateFormt;
    }

    function dataDiaMes($data) {

        $dateH = explode(" ", $data);

        $date = explode("-", $dateH[0]);

        if (empty($data)) {

            $dateFormt=null;

        }else{

            $dateFormt = $date[2] . "/" . $date[1];
        }

        return $dateFormt;
    }

    function dataUS($data) {

        $dateH = explode(" ", $data);

        $date = explode("/", $dateH[0]);

        if (empty($data)) {

            $dateFormt=null;
        }
        else{

            $dateFormt = $date[2] . "-" . $date[1] . "-" . $date[0];
        }

        return $dateFormt;
    }

    function corHoras($data) {

        $dateH = explode(" ", $data);

        if (empty($data)) {

            $dateFormt=null;
        }
        else{

            $dateFormt = $dateH[0] . "  <i style='color: #4CAF50;'>".$dateH[1]."</i>";
        }

        return $dateFormt;
    }

    function totalHoras($data1,$data2=null) {

        if(!empty($data2)){

            $datatime1 = new DateTime($data1);
            $datatime2 = new DateTime($data2);

            $objHoras = date_diff($datatime1, $datatime2);


            $horas= str_pad($objHoras->h , 2 , '0' , STR_PAD_LEFT).":".
                    str_pad($objHoras->i , 2 , '0' , STR_PAD_LEFT);




            return $horas;
        }
    }

    #009688

    function horas($horas) {

        $hora = explode(":", $horas);

        $horasFormt = $hora[0] . ":" . $hora[1];

        if (is_null($horas)) {

            $horasFormt=null;

        }else{

            $horasFormt = $hora[0] . ":" . $hora[1];

        }

        return $horasFormt;
    }

    function minHora($minutos)
        {
        $hora = str_pad(floor($minutos/60), 2, '0', STR_PAD_LEFT);
        $resto = str_pad($minutos%60, 2, '0', STR_PAD_LEFT);
        return $hora.':'.$resto;
        }

    function arrayHoras($de, $ate) {

      $array = array();

      while ($de <= $ate) {

        $minutos = $de*60;

        $array[]=minHora($minutos);

        $de = $de+0.5;
      }



   return $array;
}


    function data($data) {

        $dateH = explode(" ", $data);

        if (is_null($data)) {

            $dateFormt=null;
        }
        else{

            $dateFormt =$dateH[0];
        }

        return $dateFormt;
    }

    function nomeProprio($nome){

        $nome =  mb_strtolower($nome, 'UTF-8');

        return ucwords($nome);


    }

    function diasemana($data){  // Traz o dia da semana para qualquer data informada
        $expData =explode("-",$data);
        $ano = $expData['0'];
        $mes = $expData['1'];
        $dia = $expData['2'];
        $diasemana = date("w",mktime(0,0,0,$mes,$dia,$ano));
        return $diasemana +1;

    }

    function mes($id,$url=null){

        $mes = array();

        $mes[1]="Janeiro";

        $mes[2]="Fevereiro";

        $mes[3]="Março";

        $mes[4]="Abril";

        $mes[5]="Maio";

        $mes[6]="Junho";

        $mes[7]="Julho";

        $mes[8]="Agosto";

        $mes[9]="Setembro";

        $mes[10]="Outubro";

        $mes[11]="Novembro";

        $mes[12]="Dezembro";

        $atual = $mes[$id];

        $next="";

        $prev="";

        if($id>=2){

            $idPrev =$id-1;

            $prev ="<a data-href='".$url.$idPrev."' class='abrirPagina' data-target='#vermodal' >&#xf107;</a>";


        }

        if($id<=11){

            $idNext =$id+1;

             $next ="<a data-href='".$url.$idNext."' class='abrirPagina' data-target='#vermodal' > &#xf10a;</a>";


        }

        if(!empty($url)){

            return  $prev .$atual. $next;

        }else{

            return  $atual;

        }

    }


    function verMes($id){

        $mes = array();

        $mesCombo = array();

        $mes[1]="Janeiro";

        $mes[2]="Fevereiro";

        $mes[3]="Março";

        $mes[4]="Abril";

        $mes[5]="Maio";

        $mes[6]="Junho";

        $mes[7]="Julho";

        $mes[8]="Agosto";

        $mes[9]="Setembro";

        $mes[10]="Outubro";

        $mes[11]="Novembro";

        $mes[12]="Dezembro";

        return $mes[$id];


    }


    function comboHoras($de,$ate){

        $horas= arrayHoras($de,$ate);

        $horasCombo = array();

        foreach ($horas as $key => $value) {

           $horasCombo[$key]=array('id'=>$key,'horas'=>$value);
        }

        return $horasCombo;


    }

    function comboDia(){

        $mes = array();

        $mesCombo = array();

        $mes[1]="Domingo";

        $mes[2]="Segunda";

        $mes[3]="Terça";

        $mes[4]="Quarta";

        $mes[5]="Quinta";

        $mes[6]="Sexta";

        $mes[7]="Sábado";

        foreach ($mes as $key => $value) {

           $mesCombo[$key]=array('id'=>$key,'dia'=>$value);
        }

        return $mesCombo;


    }


    function comboMes(){

        $mes = array();

        $mesCombo = array();

        $mes[1]="Janeiro";

        $mes[2]="Fevereiro";

        $mes[3]="Março";

        $mes[4]="Abril";

        $mes[5]="Maio";

        $mes[6]="Junho";

        $mes[7]="Julho";

        $mes[8]="Agosto";

        $mes[9]="Setembro";

        $mes[10]="Outubro";

        $mes[11]="Novembro";

        $mes[12]="Dezembro";

        foreach ($mes as $key => $value) {

           $mesCombo[$key]=array('id'=>$key,'mes'=>$value);
        }

        return $mesCombo;


    }


    function comboTipoPessoa(){

        $mes = array();

        $mesCombo = array();

        $mes[1]="Contato";

        $mes[2]="Membro Ativo";

        $mes[3]="Membro Inativo";

        $mes[4]="Membro Falecido";

        foreach ($mes as $key => $value) {

           $mesCombo[$key]=array('id'=>$key,'tipo'=>$value);
        }

        return $mesCombo;


    }

    function comboCampoTipo(){

        $mes = array();

        $mesCombo = array();

        $mes[1]="Imagem";

        $mes[2]="Texto";

        $mes[3]="Número";

        foreach ($mes as $key => $value) {

           $mesCombo[$key]=array('id'=>$key,'tipo'=>$value);
        }

        return $mesCombo;


    }


    function comboTipoFinanceiro(){

        $user = array();

        $userCombo = array();

        $user[1]="Entrada";

        $user[2]="Saída";

        foreach ($user as $key => $value) {

           $mesCombo[$key]=array('id'=>$key,'tipo'=>$value);
        }

        return $mesCombo;


    }

    function comboStatus(){

        $user = array();

        $userCombo = array();

        $user[1]="Ativo";

        $user[2]="Inativo";

        foreach ($user as $key => $value) {

           $mesCombo[$key]=array('id'=>$key,'status'=>$value);
        }

        return $mesCombo;


    }


    function comboFloat(){

        $xfloat = array();

        $comboFloat = array();

        $xfloat[1]="Sim";

        $xfloat[2]="Não";

        foreach ($xfloat as $key => $value) {

           $comboFloat[$key]=array('id'=>$key,'nome'=>$value);
        }

        return $comboFloat;


    }

    /*

    array(
    'active'=>'',
    'class'=>'',
    'url'=>'',
    'titulo'=>'',
    'icone'=>''
    )

    */

    function voltar($atributos){

        $voltar=" <div class=voltar>

            <a ".$atributos." ><b>&#xf108;</b> Voltar</a>

        </div>";


        return  $voltar;
    }

    function abas($array, $activeClass=null,$tituloSemAba=null){

       $abas="<ul class='nav nav-tabs'>";


       if(empty($tituloSemAba)){

        foreach ($array as $key) {

            if($key['class']==$activeClass){

                $active="class=active";

                $key['url']="#";
            }
            else{
              $active=null;
            }

           $abas=$abas."
           <li ".$active.">

                    <a data-href='".$key['url']."' data-toggle='tab' title='".$key['titulo']."' data-placement='bottom'
                    class='abrirPagina' data-target='#vermodal'>".$key['icone']."</a></li>";

        }
    }else{

        $abas=$abas."<li><h3>".$tituloSemAba."</h3></li>";
    }
        return $abas."</ul>";

}

function  gerarSenhaCPF($cpf){

        $senha =explode(".", $cpf);

        if($senha){

            return senha($senha[0]);

        }else{


            return  false;


        }



    }

function  gerarSenhaData($data){

        $senha =str_replace("/","",$data);

        if($senha){

            return senha($senha);

        }else{


            return  false;


        }



    }

function  senha($senha){

        $senhaCrip=md5($senha);

        $chave=md5("GutoNelosCodificaSenha");

        $chave=strrev($chave);

        $senhaCrip=$senhaCrip.$chave;

        $senhaCrip=md5($senhaCrip);

        $senhaCrip="JesusEaMinhaRocha".$senhaCrip."JesusMinhaRaZaoDeViver";

        $senhaCrip=md5($senhaCrip);

        return   $senhaCrip;

}

function valorReal($numero)
{
    $numero = number_format($numero, 2, ',', '.');
    return $numero;
}

function botaoAjuda($url){

    $url = site_url('suporte/tutorial')."/".$url;

    $botao ="<p class='col-sm-1'>
                <a datax-href='".$url."'  class='abrirPagina btn btn-default' data-toggle='modal' data-target='#vermodal' >
                            &#xf142; Ajuda
                        </a>
              </p>";

  //return $botao;

   return false;




}



function validarMoeda($num){
    if(empty($num)){

        return "0.00";

    }
    else{

        return $num;


    }
}


function mascara($val, $mask)
{
    $val =str_replace('/', '', $val);
    $val =str_replace('.', '', $val);
    $val =str_replace('-', '', $val);
 $maskared = '';
 $k = 0;
 for($i = 0; $i<=strlen($mask)-1; $i++)
 {
 if($mask[$i] == '#')
 {
 if(isset($val[$k]))
 $maskared .= $val[$k++];
 }
 else
 {
 if(isset($mask[$i]))
 $maskared .= $mask[$i];
 }
 }
 return $maskared;
}

?>
