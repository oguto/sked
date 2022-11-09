
<tr  linha='<?php echo $linha; ?>'>
  <td  linha='<?php echo $linha; ?>'>

     <?php

      $atributos = "required='required'
      data-url='".site_url('Servico/verCombo')."'
      class='comboServico'
      data-target='.linha_".$linha."'";


        echo form_dropdown('id_servico_pag[]',$comboServico,'',$atributos);


      ?>

  </td>

  <td linha='<?php echo $linha; ?>'>

     <?php


        echo form_dropdown('id_colaborador_pag[]',$comboColaborador,$dadosPagamento['id_colaborador'],"required='required'");

      ?>

  </td>
    <td class="<?php echo 'linha_'.$linha ;?>">
      <?php


         $atributos = array('name' => 'valor_pag[]','class' => 'valorServ','value' => $dadosPagamento['valor'],'readonly' => 'readonly');



        echo form_input($atributos);

      ?>
    </td>
    <td  class="<?php echo 'linha_'.$linha ;?>">
      <?php
        $atributos = array('name' => 'desconto_pag[]','class' => 'descontoServ linha_'.$linha.'','value' => 0 ,'min' => 0);

        echo form_input($atributos);

      ?>
    </td>

    <td>   <button type="button" class="btn btn-danger removerLinha" linha="<?php echo $linha; ?>" > &#xf1eb;</button> </td>
</tr>
