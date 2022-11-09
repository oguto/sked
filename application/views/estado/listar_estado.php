
<form id="addPessoa" data-action="<?php echo $action?>" data-target="#telaPrincipal" modal="ok" aba="" class="filtro nelos-formulario filtroForm" method="post" >

  
                            <p class='col-sm-4'>
                            <label for='nome'>Nome</label>
                            <?php $atributos = array(   
                            'name' => 'nome',
                            'id' => 'nome',
                            'value' => $dadosEstado['nome'],
                            'required'=>'required');
                            echo form_input($atributos);
                            ?>
                            </p>
                            
  
                            <p class='col-sm-4'>
                            <label for='uf'>Uf</label>
                            <?php $atributos = array(   
                            'name' => 'uf',
                            'id' => 'uf',
                            'value' => $dadosEstado['uf'],
                            'required'=>'required');
                            echo form_input($atributos);
                            ?>
                            </p>
                            
  
                            <p class='col-sm-4'>
                            <label for='pais'>Pais</label>
                            <?php $atributos = array(   
                            'name' => 'pais',
                            'id' => 'pais',
                            'value' => $dadosEstado['pais'],
                            'required'=>'required');
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

  <table class="table AcaoEmMassa" data-url="<?php echo site_url('Estado/excluirEmMassa/');?>" data-msg="Deseja mesmo excluir os itens selecionados?"  data-target="#telaPrincipal">
    <thead>
      <tr>
       <th width="50" ><input type="checkbox" value="" name="" id="marcarTodos"></th>
       <th colspan="2">

         <i><?php echo "<b>Cadastros: </b>".$total;?></i>

         <?php echo botaoAjuda('Estado'); ?>
         <a data-href="<?php echo site_url('Estado/incluir');?>"  class="abrirPagina btn btn-info "  data-toggle="modal" data-target="#vermodal" title="Incluir ">
           &#xf12f;<sup>&#xf217;</sup>  Novo
         </a>

          <a href="<?php echo site_url('Estado/relatorio');?>"  class="abrirPagina btn btn-info "  data-toggle="modal" data-target="#vermodal" title="Relatório ">
           &#xf12f;<sup>&#xf217;</sup>  Relatório
         </a>          


         <?php echo $paginacao; ?> 
       </th>        
     </tr>
   </thead>
   <tbody>
    <?php if(!empty($listaEstado)):?>
      <?php foreach ($listaEstado as $dadosEstado):?>
       <tr >
        <td class="row">                      
          <input type="checkbox" value=" <?php echo $dadosEstado['id']; ?>" name="selecionado[]">
        </td>
        <td>
          <ul class=listar>

            <li><b>Nome:</b> <?php  echo $dadosEstado['nome'] ?></li>
            <li><b>Uf:</b> <?php  echo $dadosEstado['uf'] ?></li>
            <li><b>Pais:</b> <?php  echo $dadosEstado['pais'] ?></li>
            <li  style="width: 100%; ">
              <p>
                <a class="btn btn-primary" data-toggle="collapse" href="#collapse_<?php echo  $dadosEstado['id']; ?>" role="button" aria-expanded="false" aria-controls="collapse_<?php echo $dadosEstado['id']; ?>" style="font-size: 12px; margin-top: 10px; margin-left: 0px;
                ">
                &#xf1ca; Mais
              </a>
            </p>
            <div class="collapse" id="collapse_<?php echo  $dadosEstado['id']; ?>" style="width: 100%; ">
              <div class="card card-body">
                <ul style="padding: 0px;">

                  <li><b>Nome:</b> <?php  echo $dadosEstado['nome'] ?></li>
                  <li><b>Uf:</b> <?php  echo $dadosEstado['uf'] ?></li>
                  <li><b>Pais:</b> <?php  echo $dadosEstado['pais'] ?></li>
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
              <a data-href="<?php echo site_url('Estado/ver/'.$dadosEstado['id']);?>" class="abrirPagina" data-toggle="modal" data-target="#vermodal" >&#xf189; Visualizar</a>
            </li>

            <li>
              <a data-href="<?php echo site_url('Estado/editar/'.$dadosEstado['id']);?>" class="abrirPagina" data-toggle="modal" data-target="#vermodal" >&#xf2bf; Editar</a>
            </li>                   

            <li>
              <a data-href="<?php echo site_url('Estado/excluir/'.$dadosEstado['id']);?>" class="excluirPadrao" data-msg="Deseja excluir ?" data-target="#telaPrincipal" >&#xf1eb; Excluir</a>
            </li>                                              
          </ul>
        </div>
      </td>
      <tr >
      <?php endforeach;?>


      <tr >
        <td colspan="3">
          <a data-href="<?php echo site_url("Estado/incluir/"); ?>" class="abrirPagina btn  btn-info"  data-toggle="modal" data-target="#vermodal"  style="float:right">
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

