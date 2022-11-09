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

     echo site_url('Produto/listar/'.$ordem);?>"
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
    <option value="<?php echo site_url('Produto/listar'); ?>" selected>Lista de Produtos</option>
    <option value="<?php echo site_url('Servico/listar'); ?>" >Lista de Procedimentos</option>

  </select>

</div>

<div class="col-sm-4">
  <a data-href="<?php echo site_url('Produto/incluir/'.$modal);?>"
    class="abrirPagina btn btn-info btnLayout"  <?php if($modal=="false"){echo 'data-toggle="modal"';}?>
     data-target="#vermodal" title="Incluir " style="float:right">
      <i class="fas fa-plus"></i>
  </a>
</div>
<form id="addPessoa" data-action="<?php echo $action?>" data-target="#telaPrincipal" modal="ok" aba="" class="filtro nelos-formulario filtroForm" method="post" >

  <div class="collapse " id="filtro">
    <div class="filtroResponsivo">

                            <div class='col-sm-10'>
                            <?php $atributos = array(
                            'name' => 'nome',
                              'placeholder' => 'Produto',
                            'id' => 'nome',
                            'value' => $dadosProduto['nome']);
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

  <table class="table AcaoEmMassa" data-url="<?php echo site_url('Produto/excluirEmMassa/');?>" data-msg="Deseja mesmo excluir os itens selecionados?"  data-target="#telaPrincipal">
    <thead>
      <tr>
       <th width="50" ><input type="checkbox" value="" name="" id="marcarTodos"></th>

       <th>Código</th>
       <th>Nome do Produto</th>
       <th>Preço de Custo</th>
       <th>Preço de venda</th>
       <th>Quantidade</th>
       <th></th>

     </tr>
   </thead>
   <tbody>
    <?php if(!empty($listaProduto)):?>
      <?php foreach ($listaProduto as $dadosProduto):?>
       <tr >
        <td class="row">
          <input type="checkbox" value=" <?php echo $dadosProduto['id']; ?>" name="selecionado[]">
        </td>
        <td>
          <ul class=listar>

            <td><?php  echo $dadosProduto['nome']; ?></td>
            <td><?php  echo $dadosProduto['preco_custo']; ?></td>
            <td><?php  echo $dadosProduto['preco_venda']; ?></td>
            <td><?php  echo $dadosProduto['estoque']; ?></td>

        </ul>
      </td>
      <td>
        <div class="nelos-dropdown dropdown" style="float:right">
          <a href="#" class="dropdown-toggle btn  nelos-dropdown-btn"  data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="false">
            <p style="font-size:30px;"> &#xf20e;</p>
          </a>
          <ul class="dropdown-menu dropdown-menu-right ">
            <li>
              <a data-href="<?php echo site_url('Produto/ver/'.$dadosProduto['id']);?>" class="abrirPagina" <?php if($modal=="false"){echo 'data-toggle="modal"';}?> data-target="#vermodal" >&#xf189; Visualizar</a>
            </li>

            <li>
              <a data-href="<?php echo site_url('Produto/editar/'.$modal.'/'.$dadosProduto['id']);?>" class="abrirPagina" <?php if($modal=="false"){echo 'data-toggle="modal"';}?> data-target="#vermodal" >&#xf2bf; Editar</a>
            </li>

            <li>
              <a data-href="<?php echo site_url('Produto/excluir/'.$modal.'/'.$dadosProduto['id']);?>" class="excluirPadrao" data-msg="Deseja excluir ?" data-target="#telaPrincipal" >&#xf1eb; Excluir</a>
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
