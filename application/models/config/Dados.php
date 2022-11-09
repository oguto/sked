<?php

class Dados extends CI_Model {

    function analisar($dados) {

         if(isset($dados)){

             return $dados;
         } 
    }

    function autoCompletar($array=array()){

        foreach ($array as $key => $value) {

             if($array[$key]==null){

                 $array[$key]= "<i>Não informado!</i>";

             }

        }

        return $array;
    }

    function dataBr($data) {

        $dateH = explode(" ", $data); 

        $date = explode("-", $dateH[0]); 

        if (is_null($data)) {

            $dateFormt=null;

        }else{

            $dateFormt = $date[2] . "/" . $date[1] . "/" . $date[0];
        }
        
        return $dateFormt;
    }

    function dataUs($data) {

        $dateH = explode(" ", $data);

        $date = explode("/", $dateH[0]);  

        if (is_null($data)) {

            $dateFormt=null;
        }
        else{

            $dateFormt = $date[2] . "-" . $date[1] . "-" . $date[0];
        }

        return $dateFormt;
    }

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


    
    
   

}
