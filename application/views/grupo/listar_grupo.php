
<form id="addPessoa" data-action="<?php echo $action?>" data-target="#telaPrincipal" modal="ok" aba="" class="filtro nelos-formulario filtroForm" method="post" >


                            <p class='col-sm-10'>
                            <label for='nome'>Nome</label>
                            <?php $atributos = array(
                            'name' => 'nome',
                            'id' => 'nome',
                            'value' => $dadosGrupo['nome']);
                            echo form_input($atributos);
                            ?>
                            </p>

  <p class="col-sm-2">
    <button type='submit' class="btn btn-primary">
      &#xf2f5; buscar
    </button>
  </p>

</form>
<div class="tab-conteudo row col-sm-12 ">
  <?php echo  $console; ?>

  <table class="table AcaoEmMassa" data-url="<?php echo site_url('Grupo/excluirEmMassa/');?>" data-msg="Deseja mesmo excluir os itens selecionados?"  data-target="#telaPrincipal">
    <thead>
      <tr>
       <th width="50" ><input type="checkbox" value="" name="" id="marcarTodos"></th>
       <th colspan="2">

         <i><?php echo "<b>Cadastros: </b>".$total;?></i>

         <?php echo botaoAjuda('Grupo'); ?>
         <a data-href="<?php echo site_url('Grupo/incluir');?>"  class="abrirPagina btn btn-info "  data-toggle="modal" data-target="#vermodal" title="Incluir ">
           &#xf12f;<sup>&#xf217;</sup>  Novo
         </a>


         <?php echo $paginacao; ?>
       </th>
     </tr>
   </thead>
   <tbody>
    <?php if(!empty($listaGrupo)):?>
      <?php foreach ($listaGrupo as $dadosGrupo):?>
       <tr >
        <td class="row">
            <?php if($dadosGrupo['id']>5){?>
          <input type="checkbox" value=" <?php echo $dadosGrupo['id']; ?>" name="selecionado[]">
            <?php }?>
        </td>
        <td>
          <ul class=listar>

            <li> <?php  echo $dadosGrupo['nome'] ?></li>

        </ul>
      </td>
      <td>
        <div class="nelos-dropdown dropdown" style="float:right">
          <a href="#" class="dropdown-toggle btn  nelos-dropdown-btn"  data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="false">
            <p style="font-size:30px;"> &#xf20e;</p>
          </a>
          <ul class="dropdown-menu dropdown-menu-right ">

            <li>
              <a data-href="<?php echo site_url('ControleAcesso/editar/'.$dadosGrupo['id']);?>" class="abrirPagina" data-toggle="modal" data-target="#vermodal" >&#xf2bf; Controle de Acesso</a>
            </li>
            <hr>

            <?php if($dadosGrupo['id']>5){?>


            <li>
              <a data-href="<?php echo site_url('Grupo/editar/'.$dadosGrupo['id']);?>" class="abrirPagina" data-toggle="modal" data-target="#vermodal" >&#xf2bf; Editar</a>
            </li>

            <li>
              <a data-href="<?php echo site_url('Grupo/excluir/'.$dadosGrupo['id']);?>" class="excluirPadrao" data-msg="Deseja excluir ?" data-target="#telaPrincipal" >&#xf1eb; Excluir</a>
            </li>

          <?php }?>
          </ul>
        </div>
      </td>
      <tr >
      <?php endforeach;?>


      <tr >
        <td colspan="3">
          <a data-href="<?php echo site_url("Grupo/incluir/"); ?>" class="abrirPagina btn  btn-info"  data-toggle="modal" data-target="#vermodal"  style="float:right">
            <p data-toggle="tooltip" data-placement="right" title="" >
             &#xf12f;<sup>&#xf217;</sup> Novo
           </p>
         </a>
         <?php echo $paginacao; ?>
       </td>
     </tr >
     <?php else:?>
      <tr>
        <td colspan="3">
          <div class="alert alert-danger" style="float: left; width:100%">
            Nenhum cadastrado encontrado!
          </div>
        </td>
        <tr >
        <?php endif;?>
      </tbody>
    </table>

  </div>
