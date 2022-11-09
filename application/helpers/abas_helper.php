<?php



  function abasAluno($id_aluno=null,$active,$titulo=null){

       $abasAluno=array();

       $abasAluno[] =array(
        'class'=>'aluno',
        'url'=>site_url('/aluno/ver/'.$id_aluno),
        'titulo'=>'Dados do aluno',
        'icone'=>'Dados do Aluno'
        );
       $abasAluno[] =array(
        'class'=>'financeiro',
        'url'=>site_url('/financeiro/verPorAluno/'.$id_aluno),
        'titulo'=>'Financeiro',
        'icone'=>'Financeiro'
        );

        $abasAluno[] =array(
        'class'=>'frequencia',
        'url'=>site_url('frequencia/listarFaltas/'.$id_aluno),
        'titulo'=>'Faltas',
        'icone'=>'Faltas'
        );

        $abasAlunoDD[] =array(
        'class'=>'boletim',
        'url'=>site_url('/aluno/ver/'.$id_aluno),
        'titulo'=>'Informações de ministerio',
        'icone'=>'Boletim'
        );



          return abas($abasAluno,$active,$titulo);
    }
