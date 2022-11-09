
<form id="addPessoa" data-action="<?php echo $action?>" data-target="#telaPrincipal" modal="ok" aba="" class="filtro nelos-formulario filtroForm" method="post" >
  <p>
    <button class="btn btn-default btnFiltro" type="button" data-toggle="collapse" data-target="#filtro" aria-expanded="false" aria-controls="collapseExample">
    &#xf2f5;   Filtro
    </button>
  </p>
  <div class="collapse " id="filtro">
    <div class="filtroResponsivo">
      
                            <p class='col-sm-4'>
                            <label for='email'>Email</label>
                            <?php $atributos = array(
                            'name' => 'email',
                            'id' => 'email',
                            'value' => $dadosAdmin['email']);
                            echo form_input($atributos);
                            ?>
                            </p>
                            
      
                            <p class='col-sm-4'>
                            <label for='nome'>Nome</label>
                            <?php $atributos = array(
                            'name' => 'nome',
                            'id' => 'nome',
                            'value' => $dadosAdmin['nome']);
                            echo form_input($atributos);
                            ?>
                            </p>
                            
      
                         <p class='col-sm-4'>
                         <label for='data'>Data</label>
                       <?php $atributos = array(
                          'name' => 'data',
                          'id' => 'data',
                          'value' => $dadosAdmin['data'],
                          'type'=>'date',
                          'required'=>'required');
                          echo form_input($atributos);
                          ?>
                            </p>
      <p class="col-sm-2">
        <button type='submit' class="btn btn-primary">
          &#xf2f5; buscar
        </button>
      </p>
    </div>
  </div>
</form>
<div class="tab-conteudo row col-sm-12 ">
  <?php echo  $console; ?>

  <table class="table AcaoEmMassa" data-url="<?php echo site_url('Admin/excluirEmMassa/');?>" data-msg="Deseja mesmo excluir os itens selecionados?"  data-target="#telaPrincipal">
    <thead>
      <tr>
       <th width="50" ><input type="checkbox" value="" name="" id="marcarTodos"></th>
       <th colspan="2">

         <i><?php echo "<b>Cadastros: </b>".$total;?></i>

         <?php echo botaoAjuda('Admin'); ?>
         <a data-href="<?php echo site_url('Admin/incluir/'.$modal);?>"  class="abrirPagina btn btn-info "  <?php if($modal=="false"){echo 'data-toggle="modal"';}?>  data-target="#vermodal" title="Incluir ">
           &#xf12f;<sup>&#xf217;</sup>  Novo
         </a>

         <?php echo $paginacao; ?>
       </th>
     </tr>
   </thead>
   <tbody>
    <?php if(!empty($listaAdmin)):?>
      <?php foreach ($listaAdmin as $dadosAdmin):?>
       <tr >
        <td class="row">
          <input type="checkbox" value=" <?php echo $dadosAdmin['id']; ?>" name="selecionado[]">
        </td>
        <td>
          <ul class=listar>

            <li><b>Email:</b> <?php  echo $dadosAdmin['email']; ?></li>
            <li><b>Nome:</b> <?php  echo $dadosAdmin['nome']; ?></li>
            <li><b>Senha:</b> <?php  echo $dadosAdmin['senha']; ?></li>
            <li><b>Data:</b> <?php  echo dataBR($dadosAdmin['data']); ?></li>
            <li  style="width: 100%; ">
              <p>
                <a class="btn btn-primary" data-toggle="collapse" href="#collapse_<?php echo  $dadosAdmin['id']; ?>" role="button" aria-expanded="false" aria-controls="collapse_<?php echo $dadosAdmin['id']; ?>" style="font-size: 12px; margin-top: 10px; margin-left: 0px;
                ">
                &#xf1ca; Mais
              </a>
            </p>
            <div class="collapse" id="collapse_<?php echo  $dadosAdmin['id']; ?>" style="width: 100%; ">
              <div class="card card-body">
                <ul style="padding: 0px;">

                  <li><b>Email:</b> <?php  echo $dadosAdmin['email']; ?></li>
                  <li><b>Nome:</b> <?php  echo $dadosAdmin['nome']; ?></li>
                  <li><b>Senha:</b> <?php  echo $dadosAdmin['senha']; ?></li>
                  <li><b>Data:</b> <?php  echo dataBR($dadosAdmin['data']); ?></li>
                  </ul>

              </div>
            </div>
          </li>
        </ul>
      </td>
      <td>
        <div class="nelos-dropdown dropdown" style="float:right">
          <a href="#" class="dropdown-toggle btn  nelos-dropdown-btn"  data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="false">
            <p style="font-size:30px;"> &#xf20e;</p>
          </a>
          <ul class="dropdown-menu dropdown-menu-right ">
            <li>
              <a data-href="<?php echo site_url('Admin/ver/'.$dadosAdmin['id']);?>" class="abrirPagina" <?php if($modal=="false"){echo 'data-toggle="modal"';}?> data-target="#vermodal" >&#xf189; Visualizar</a>
            </li>

            <li>
              <a data-href="<?php echo site_url('Admin/editar/'.$modal.'/'.$dadosAdmin['id']);?>" class="abrirPagina" <?php if($modal=="false"){echo 'data-toggle="modal"';}?> data-target="#vermodal" >&#xf2bf; Editar</a>
            </li>

            <li>
              <a data-href="<?php echo site_url('Admin/excluir/'.$modal.'/'.$dadosAdmin['id']);?>" class="excluirPadrao" data-msg="Deseja excluir ?" data-target="#telaPrincipal" >&#xf1eb; Excluir</a>
            </li>
          </ul>
        </div>
      </td>
      <tr >
      <?php endforeach;?>


      <tr >
        <td colspan="3">
          <a data-href="<?php echo site_url("Admin/incluir/".$modal); ?>" class="abrirPagina btn  btn-info"  <?php if($modal=="false"){echo 'data-toggle="modal"';}?> data-target="#vermodal"  style="float:right">
             &#xf12f;<sup>&#xf217;</sup> Novo
         </a>
         <a data-href="<?php echo site_url('Admin/relatorio');?>"  class="abrirPagina btn btn-primary " <?php if($modal=="false"){echo 'data-toggle="modal"';}?> data-target="#vermodal" >
            &#xf12e;  Relatório
        </a>
         <?php echo $paginacao; ?>
       </td>
     </tr >
     <?php else:?>
      <tr>
        <td colspan="3">
          <div class="alert alert-danger" style="float: left; width:100%">
            Nenhum registro encontrado!
          </div>
        </td>
        <tr >
        <?php endif;?>
      </tbody>
    </table>

  </div>
