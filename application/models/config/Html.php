<?php
    //funções padrão que geram html

class Html extends CI_Model {

function janelaPessoa($active,$id_pessoa){

        $perfil="";

        $agenda="";

        $acoes="";

        if($active=="perfil"){

            $perfil="class='active'";

        }elseif ($active=="agenda") {

            $agenda="class='active'";

        }elseif ($active=="acoes") {

            $acoes="class='active'";

        }

       return "
       <ul class='nav nav-tabs'>
           <li ".$perfil.">
                <a data-href='".site_url('clientepessoa/verCliente/'.$id_pessoa)."' data-toggle='tab' title='Perfil da Pessoa' data-placement='bottom' 
                class='abrirPagina' data-target='#vermodal'>
                    <p >&#xf1c2;</p><br>
                </a>
            </li>

            <li ".$agenda." >
                <a data-href='".site_url('pessoa/listarAgenda/'.$id_pessoa)."' data-toggle='tab' title='Agenda' data-placement='bottom'
                 class='abrirPagina' data-target='#vermodal'>
                    <p >&#xf162; </p><br>
                </a>
            </li>

            <li ".$acoes." >
                <a data-href='".site_url('pessoa/listarAgenda/'.$id_pessoa)."' data-toggle='tab' title='Ações' data-placement='bottom'
                 class='abrirPagina' data-target='#vermodal'>
                    <p >&#xf15a; </p><br>
                </a>
            </li>
        </ul>";



    }

    function janelaEmpresa($active,$id_empresa=null){

        $perfil="";

        $agenda="";

        $acoes="";

        if($active=="perfil"){

            $perfil="class='active'";

        }elseif ($active=="agenda") {

            $agenda="class='active'";

        }elseif ($active=="acoes") {

            $acoes="class='active'";

        }

       return "
       <ul class='nav nav-tabs'>
           <li ".$perfil.">
                <a data-href='".site_url('clienteempresa/verCliente/'.$id_empresa)."' data-toggle='tab' title='Perfil da Empresa' data-placement='bottom' 
                class='abrirPagina' data-target='#vermodal'>
                    <p >&#xf26c;</p><br>
                </a>
            </li>

            <li ".$agenda." >
                <a data-href='".site_url('empresa/listarAgenda/'.$id_empresa)."' data-toggle='tab' title='Agenda' data-placement='bottom'
                 class='abrirPagina' data-target='#vermodal'>
                    <p >&#xf162; </p><br>
                </a>
            </li>

            <li ".$acoes." >
                <a data-href='".site_url('empresa/listarAgenda/'.$id_empresa)."' data-toggle='tab' title='Ações' data-placement='bottom'
                 class='abrirPagina' data-target='#vermodal'>
                    <p >&#xf15a; </p><br>
                </a>
            </li>
        </ul>";



    }
}
