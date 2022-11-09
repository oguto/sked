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

   echo site_url('Colaborador/listar/'.$ordem);?>"
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
    <option value="<?php echo site_url('colaborador/listar'); ?>" selected>Lista de Colaboradores</option>
    <option value="<?php echo site_url('Cliente/listar'); ?>" >Lista de Clientes</option>
    <option value="<?php echo site_url('Produto/listar'); ?>" >Lista de Produtos</option>
    <option value="<?php echo site_url('Servico/listar'); ?>" >Lista de Procedimentos</option>

  </select>

</div>
<div class="col-sm-4">
  <a data-href="<?php echo site_url('Colaborador/incluir/'.$modal);?>"
      class="abrirPagina btn btn-info btnLayout"
       <?php if($modal=="false"){echo 'data-toggle="modal"';}?>
       style="float:right"
       data-target="#vermodal"
       title="Incluir ">
    <i class="fas fa-plus"></i>
  </a>
</div>

<form id="addPessoa" data-action="<?php echo $action?>" data-target=".conteudo" modal="ok" aba="" class="filtro nelos-formulario filtroForm" method="post" >



  <div class="collapse " id="filtro">
    <div class="filtroResponsivo">



                                  <div class='col-sm-12'>
                                  <?php $atributos = array(
                                  'name' => 'nome',
                                  'placeholder' => 'Nome',
                                  'id' => 'nome',
                                  'value' => $dadosColaborador['nome']);
                                  echo form_input($atributos);
                                  ?>
                                  <br>
                                </div>

                            <div class='col-sm-5'>

                            <?php $atributos = array(
                            'name' => 'email',
                              'placeholder' => 'Email',
                            'id' => 'email',
                            'value' => $dadosColaborador['email']);
                            echo form_input($atributos);
                            ?>
                          </div>





                            <div class='col-sm-5'>
                            <?php $atributos = array(
                            'name' => 'cpf',
                              'placeholder' => 'CPF',
                            'id' => 'cpf',
                            'value' => $dadosColaborador['cpf']);
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

  <table class="table AcaoEmMassa" data-url="<?php echo site_url('Colaborador/excluirEmMassa/');?>" data-msg="Deseja mesmo excluir os itens selecionados?"  data-target="#telaPrincipal">
    <thead>
      <tr>
       <th width="50" ><input type="checkbox" value="" name="" id="marcarTodos"></th>
       <th>Código</th>
       <th>Nome</th>
       <th>Telefone</th>
       <th>Aniversário</th>
       <th>Sexo</th>
        <th></th>
     </tr>
   </thead>
   <tbody>
    <?php if(!empty($listaColaborador)):?>
      <?php foreach ($listaColaborador as $dadosColaborador):?>
       <tr >
        <td class="row">
          <input type="checkbox" value=" <?php echo $dadosColaborador['id']; ?>" name="selecionado[]">
        </td>

          <td><?php  echo $dadosColaborador['id']; ?></td>
          <td> <?php  echo $dadosColaborador['nome']; ?></td>
          <td> <?php  echo $dadosColaborador['telefone']; ?></td>
          <td><?php  echo dataBR($dadosColaborador['nascimento']); ?></td>
          <td><?php  echo $dadosColaborador['email']; ?></td>

      <td>
        <div class="nelos-dropdown dropdown" style="float:right">
          <a href="#" class="dropdown-toggle btn  nelos-dropdown-btn"  data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="false">
            <p style="font-size:30px;"> &#xf20e;</p>
          </a>
          <ul class="dropdown-menu dropdown-menu-right ">
            <li>
              <a data-href="<?php echo site_url('Colaborador/ver/'.$dadosColaborador['id']);?>" class="abrirPagina" <?php if($modal=="false"){echo 'data-toggle="modal"';}?> data-target="#vermodal" >&#xf189; Visualizar</a>
            </li>

            <li>
              <a data-href="<?php echo site_url('Colaborador/editar/'.$modal.'/'.$dadosColaborador['id']);?>" class="abrirPagina" <?php if($modal=="false"){echo 'data-toggle="modal"';}?> data-target="#vermodal" >&#xf2bf; Editar</a>
            </li>

            <li>
              <a data-href="<?php echo site_url('Usuario/editar/'.$dadosColaborador['id_usuario']);?>" class="abrirPagina" <?php if($modal=="false"){echo 'data-toggle="modal"';}?> data-target="#vermodal" >&#xf2bf; Editar Login</a>
            </li>

            <li>
              <a data-href="<?php echo site_url('Colaborador/excluir/'.$modal.'/'.$dadosColaborador['id']);?>" class="excluirPadrao" data-msg="Deseja excluir ?" data-target="#telaPrincipal" >&#xf1eb; Excluir</a>
            </li>
          </ul>
        </div>
      </td>
      <tr >
      <?php endforeach;?>


      <tr >
        <td colspan="8">

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
