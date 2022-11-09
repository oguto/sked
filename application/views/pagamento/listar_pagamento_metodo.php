
<div class="tab-conteudo row col-sm-12 ">
  <?php echo  $console; ?>


    <div class="collapse " id="filtro">
      <div class="filtroResponsivo">

                              <div class='col-sm-2'>
                              <?php $atributos = array(
                              'name' => 'id',
                              'placeholder' => 'Código',
                              'id' => 'id',
                              'value' => $dadosPagamento['id']);
                              echo form_input($atributos);
                              ?>
                              </div>
                              <div class='col-sm-8'>
                              <?php $atributos = array(
                              'name' => 'nome',
                              'placeholder' => 'Procedimento',
                              'id' => 'nome',
                              'value' => $dadosPagamento['nome']);
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

  <table class="table AcaoEmMassa" data-url="<?php echo site_url('PagamentoMetodo/excluirEmMassa/');?>" data-msg="Deseja mesmo excluir os itens selecionados?"  data-target="#telaPrincipal">
    <thead>
      <tr>
       <th width="50" ><input type="checkbox" value="" name="" id="marcarTodos"></th>
       <th colspan="2">

         <i><?php echo "<b>Cadastros: </b>".$total;?></i>

         <?php echo botaoAjuda('PagamentoMetodo'); ?>
         <a data-href="<?php echo site_url('PagamentoMetodo/incluir/'.$modal);?>"  class="abrirPagina btn btn-info "  <?php if($modal=="false"){echo 'data-toggle="modal"';}?>  data-target="#vermodal" title="Incluir ">
           &#xf12f;<sup>&#xf217;</sup>  Novo
         </a>

         <?php echo $paginacao; ?>
       </th>
     </tr>
   </thead>
   <tbody>
    <?php if(!empty($listaPagamentoMetodo)):?>
      <?php foreach ($listaPagamentoMetodo as $dadosPagamentoMetodo):?>
       <tr >
        <td class="row">
          <input type="checkbox" value=" <?php echo $dadosPagamentoMetodo['id']; ?>" name="selecionado[]">
        </td>
        <td>
          <ul class=listar>

            <li><?php  echo $dadosPagamentoMetodo['nome']; ?></li>

        </ul>
      </td>
      <td>
        <div class="nelos-dropdown dropdown" style="float:right">
          <a href="#" class="dropdown-toggle btn  nelos-dropdown-btn"  data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="false">
            <p style="font-size:30px;"> &#xf20e;</p>
          </a>
          <ul class="dropdown-menu dropdown-menu-right ">

            <li>
              <a data-href="<?php echo site_url('PagamentoMetodo/editar/'.$modal.'/'.$dadosPagamentoMetodo['id']);?>" class="abrirPagina" <?php if($modal=="false"){echo 'data-toggle="modal"';}?> data-target="#vermodal" >&#xf2bf; Editar</a>
            </li>

            <li>
              <a data-href="<?php echo site_url('PagamentoMetodo/excluir/'.$modal.'/'.$dadosPagamentoMetodo['id']);?>" class="excluirPadrao" data-msg="Deseja excluir ?" data-target=".conteudoSked" >&#xf1eb; Excluir</a>
            </li>
          </ul>
        </div>
      </td>
      <tr >
      <?php endforeach;?>


      <tr >
        <td colspan="3">
          <a data-href="<?php echo site_url("PagamentoMetodo/incluir/".$modal); ?>" class="abrirPagina btn  btn-info"  <?php if($modal=="false"){echo 'data-toggle="modal"';}?> data-target="#vermodal"  style="float:right">
             &#xf12f;<sup>&#xf217;</sup> Novo
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
