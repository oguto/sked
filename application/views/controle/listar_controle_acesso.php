
<form id="addPessoa" data-action="<?php echo $action?>" data-target="#telaPrincipal" modal="ok" aba="" class="filtro nelos-formulario filtroForm" method="post" >

  
                            <p class='col-sm-4'>
                            <label for='modulo'>Modulo</label>
                            <?php $atributos = array(   
                            'name' => 'modulo',
                            'id' => 'modulo',
                            'value' => $dadosControleAcesso['modulo'],
                            'required'=>'required');
                            echo form_input($atributos);
                            ?>
                            </p>
                            
  
                            <p class='col-sm-4'>
                            <label for='geral'>Geral</label>
                            <?php $atributos = array(   
                            'name' => 'geral',
                            'id' => 'geral',
                            'value' => $dadosControleAcesso['geral'],
                            'required'=>'required');
                            echo form_input($atributos);
                            ?>
                            </p>
                            
  
                            <p class='col-sm-4'>
                            <label for='editar'>Editar</label>
                            <?php $atributos = array(   
                            'name' => 'editar',
                            'id' => 'editar',
                            'value' => $dadosControleAcesso['editar'],
                            'required'=>'required');
                            echo form_input($atributos);
                            ?>
                            </p>
                            
  
                            <p class='col-sm-4'>
                            <label for='visualizar'>Visualizar</label>
                            <?php $atributos = array(   
                            'name' => 'visualizar',
                            'id' => 'visualizar',
                            'value' => $dadosControleAcesso['visualizar'],
                            'required'=>'required');
                            echo form_input($atributos);
                            ?>
                            </p>
                            
  
                            <p class='col-sm-4'>
                            <label for='incluir'>Incluir</label>
                            <?php $atributos = array(   
                            'name' => 'incluir',
                            'id' => 'incluir',
                            'value' => $dadosControleAcesso['incluir'],
                            'required'=>'required');
                            echo form_input($atributos);
                            ?>
                            </p>
                            
  
                            <p class='col-sm-4'>
                            <label for='excluir'>Excluir</label>
                            <?php $atributos = array(   
                            'name' => 'excluir',
                            'id' => 'excluir',
                            'value' => $dadosControleAcesso['excluir'],
                            'required'=>'required');
                            echo form_input($atributos);
                            ?>
                            </p>
                            
  
                            <p class='col-sm-4'>
                            <label for='id_usuario'>Usuário</label>
                            <?php $atributos = array(   
                            'name' => 'id_usuario',
                            'id' => 'id_usuario',
                            'value' => $dadosControleAcesso['id_usuario'],
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

  <table class="table AcaoEmMassa" data-url="<?php echo site_url('ControleAcesso/excluirEmMassa/');?>" data-msg="Deseja mesmo excluir os itens selecionados?"  data-target="#telaPrincipal">
    <thead>
      <tr>
       <th width="50" ><input type="checkbox" value="" name="" id="marcarTodos"></th>
       <th colspan="2">

         <i><?php echo "<b>Cadastros: </b>".$total;?></i>

         <?php echo botaoAjuda('ControleAcesso'); ?>
         <a data-href="<?php echo site_url('ControleAcesso/incluir');?>"  class="abrirPagina btn btn-info "  data-toggle="modal" data-target="#vermodal" title="Incluir ">
           &#xf12f;<sup>&#xf217;</sup>  Novo
         </a>

          <a href="<?php echo site_url('ControleAcesso/relatorio');?>"  class="abrirPagina btn btn-info "  data-toggle="modal" data-target="#vermodal" title="Relatório ">
           &#xf12f;<sup>&#xf217;</sup>  Relatório
         </a>          


         <?php echo $paginacao; ?> 
       </th>        
     </tr>
   </thead>
   <tbody>
    <?php if(!empty($listaControleAcesso)):?>
      <?php foreach ($listaControleAcesso as $dadosControleAcesso):?>
       <tr >
        <td class="row">                      
          <input type="checkbox" value=" <?php echo $dadosControleAcesso['id']; ?>" name="selecionado[]">
        </td>
        <td>
          <ul class=listar>

            <li><b>Modulo:</b> <?php  echo $dadosControleAcesso['modulo'] ?></li>
            <li><b>Geral:</b> <?php  echo $dadosControleAcesso['geral'] ?></li>
            <li><b>Editar:</b> <?php  echo $dadosControleAcesso['editar'] ?></li>
            <li><b>Visualizar:</b> <?php  echo $dadosControleAcesso['visualizar'] ?></li>
            <li><b>Incluir:</b> <?php  echo $dadosControleAcesso['incluir'] ?></li>
            <li><b>Excluir:</b> <?php  echo $dadosControleAcesso['excluir'] ?></li>
            <li><b>Usuário:</b> <?php  echo $dadosControleAcesso['id_usuario'] ?></li>
            <li  style="width: 100%; ">
              <p>
                <a class="btn btn-primary" data-toggle="collapse" href="#collapse_<?php echo  $dadosControleAcesso['id']; ?>" role="button" aria-expanded="false" aria-controls="collapse_<?php echo $dadosControleAcesso['id']; ?>" style="font-size: 12px; margin-top: 10px; margin-left: 0px;
                ">
                &#xf1ca; Mais
              </a>
            </p>
            <div class="collapse" id="collapse_<?php echo  $dadosControleAcesso['id']; ?>" style="width: 100%; ">
              <div class="card card-body">
                <ul style="padding: 0px;">

                  <li><b>Modulo:</b> <?php  echo $dadosControleAcesso['modulo'] ?></li>
                  <li><b>Geral:</b> <?php  echo $dadosControleAcesso['geral'] ?></li>
                  <li><b>Editar:</b> <?php  echo $dadosControleAcesso['editar'] ?></li>
                  <li><b>Visualizar:</b> <?php  echo $dadosControleAcesso['visualizar'] ?></li>
                  <li><b>Incluir:</b> <?php  echo $dadosControleAcesso['incluir'] ?></li>
                  <li><b>Excluir:</b> <?php  echo $dadosControleAcesso['excluir'] ?></li>
                  <li><b>Usuário:</b> <?php  echo $dadosControleAcesso['id_usuario'] ?></li>
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
              <a data-href="<?php echo site_url('ControleAcesso/ver/'.$dadosControleAcesso['id']);?>" class="abrirPagina" data-toggle="modal" data-target="#vermodal" >&#xf189; Visualizar</a>
            </li>

            <li>
              <a data-href="<?php echo site_url('ControleAcesso/editar/'.$dadosControleAcesso['id']);?>" class="abrirPagina" data-toggle="modal" data-target="#vermodal" >&#xf2bf; Editar</a>
            </li>                   

            <li>
              <a data-href="<?php echo site_url('ControleAcesso/excluir/'.$dadosControleAcesso['id']);?>" class="excluirPadrao" data-msg="Deseja excluir ?" data-target="#telaPrincipal" >&#xf1eb; Excluir</a>
            </li>                                              
          </ul>
        </div>
      </td>
      <tr >
      <?php endforeach;?>


      <tr >
        <td colspan="3">
          <a data-href="<?php echo site_url("ControleAcesso/incluir/"); ?>" class="abrirPagina btn  btn-info"  data-toggle="modal" data-target="#vermodal"  style="float:right">
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

