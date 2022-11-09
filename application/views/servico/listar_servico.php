<h2 class="titulo">Listas</h2>
<div class="conteudoSked">
  <div class="col-sm-4">
    <button class="btn btn-default btnFiltro btnLayout" type="button" data-toggle="collapse" data-target="#filtro" aria-expanded="false" aria-controls="collapseExample">
    &#xf2f5;
    </button>
    <a data-href="<?php
    if($ordem=="desc"){

      $ordem="asc";

    }elseif($ordem=="asc"){

      $ordem="desc";

    }

     echo site_url('Servico/listar/'.$ordem);?>"
        class="loadTarget btn btn-default btnFiltro btnLayout"
         data-target=".conteudo" >

         <?php
         if($ordem=="desc"){

           $ordemIco="  <i class='fas fa-sort-alpha-down'></i>";

         }elseif($ordem=="asc"){

           $ordemIco="<i class='fas fa-sort-alpha-up'></i>";

         }

         echo $ordemIco;
         ?>


    </a>


  </div>
<div class="col-sm-4">
  <select class="comboMenu" name="" data-target=".conteudo">
    <option value="<?php echo site_url('colaborador/listar'); ?>" >Lista de Colaboradores</option>
    <option value="<?php echo site_url('Cliente/listar'); ?>" >Lista de Clientes</option>
    <option value="<?php echo site_url('Produto/listar'); ?>" >Lista de Produtos</option>
    <option value="<?php echo site_url('Servico/listar'); ?>" selected>Lista de Procedimentos</option>

  </select>

</div>
<div class="col-sm-4">
  <a data-href="<?php echo site_url('Servico/incluir/'.$modal);?>"  class="abrirPagina btn btn-info btnLayout "  <?php if($modal=="false"){echo 'data-toggle="modal"';}?>  data-target="#vermodal" title="Incluir "
    style="float:right">
      <i class="fas fa-plus"></i>
  </a>
</div>
<form id="addPessoa" data-action="<?php echo $action?>" data-target=".conteudo" modal="ok" aba="" class="filtro nelos-formulario filtroForm" method="post" >

  <div class="collapse " id="filtro">
    <div class="filtroResponsivo">

                            <div class='col-sm-2'>
                            <?php $atributos = array(
                            'name' => 'id',
                            'placeholder' => 'Código',
                            'id' => 'id',
                            'value' => $dadosServico['id']);
                            echo form_input($atributos);
                            ?>
                            </div>
                            <div class='col-sm-8'>
                            <?php $atributos = array(
                            'name' => 'nome',
                            'placeholder' => 'Procedimento',
                            'id' => 'nome',
                            'value' => $dadosServico['nome']);
                            echo form_input($atributos);
                            ?>
                            </div>


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

  <table class="table AcaoEmMassa" data-url="<?php echo site_url('Servico/excluirEmMassa/');?>" data-msg="Deseja mesmo excluir os itens selecionados?"  data-target=".conteudo">
    <thead>
      <tr>
       <th width="50" ><input type="checkbox" value="" name="" id="marcarTodos"></th>

              <th>Código</th>
              <th>Nome do Procedimento</th>
              <th>Valor</th>
              <th>Desconto Máximo</th>
              <th>Atualizado em</th>
              <th></th>
     </tr>
   </thead>
   <tbody>
    <?php if(!empty($listaServico)):?>
      <?php foreach ($listaServico as $dadosServico):?>
       <tr >
        <td class="row">
          <input type="checkbox" value=" <?php echo $dadosServico['id']; ?>" name="selecionado[]">
        </td>
            <td><?php  echo $dadosServico['id']; ?></td>
            <td><?php  echo $dadosServico['nome']; ?></td>
            <td>R$ <?php  echo $dadosServico['preco_venda']; ?></td>
            <td> <?php  echo $dadosServico['desconto']; ?>%</td>
            <td> <?php  echo dataBR($dadosServico['data']); ?>  <?php  echo $dadosServico['horas']; ?></td>

      </td>
      <td>
        <div class="nelos-dropdown dropdown" style="float:right">
          <a href="#" class="dropdown-toggle btn  nelos-dropdown-btn"  data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="false">
            <p style="font-size:30px;"> &#xf20e;</p>
          </a>
          <ul class="dropdown-menu dropdown-menu-right ">
            <li>
              <a data-href="<?php echo site_url('Servico/ver/'.$dadosServico['id']);?>" class="abrirPagina" <?php if($modal=="false"){echo 'data-toggle="modal"';}?> data-target="#vermodal" >&#xf189; Visualizar</a>
            </li>

            <li>
              <a data-href="<?php echo site_url('Servico/editar/'.$modal.'/'.$dadosServico['id']);?>" class="abrirPagina" <?php if($modal=="false"){echo 'data-toggle="modal"';}?> data-target="#vermodal" >&#xf2bf; Editar</a>
            </li>

            <li>
              <a data-href="<?php echo site_url('Servico/excluir/'.$modal.'/'.$dadosServico['id']);?>" class="excluirPadrao" data-msg="Deseja excluir ?" data-target=".conteudo" >&#xf1eb; Excluir</a>
            </li>
          </ul>
        </div>
      </td>
      <tr >
      <?php endforeach;?>


      <tr >
        <td colspan="7">

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
</div>
