<div  class="col-sm-12">
    <h3 class="titulo">Produto</h3>
    <div  class="col-sm-3">
        Cadastrar
        <input type="checkbox" name="acess_cadatrar[Produto]"  <?php

        $array = array('modulo'=>'Produto','id_grupo'=>$grupo['id'],'incluir'=>1);

         $checkbox=$acesso->filtrar($array);

         if(!empty($checkbox)){

            echo "checked";

         }



         ?> >

    </div>
    <div  class="col-sm-3">
        Visualizar
         <input type="checkbox" name="acess_visualizar[Produto]"
         <?php

        $array = array('modulo'=>'Produto','id_grupo'=>$grupo['id'],'visualizar'=>1);

         $checkbox=$acesso->filtrar($array);

         if(!empty($checkbox)){

            echo "checked";

         }



         ?>>
    </div>
    <div  class="col-sm-3">
        Editar
         <input type="checkbox" name="acess_editar[Produto]"   <?php

        $array = array('modulo'=>'Produto','id_grupo'=>$grupo['id'],'editar'=>1);

         $checkbox=$acesso->filtrar($array);

         if(!empty($checkbox)){

            echo "checked";

         }



         ?>>
    </div>
    <div  class="col-sm-3">
        Excluir
         <input type="checkbox" name="acess_excluir[Produto]"
           <?php

        $array = array('modulo'=>'Produto','id_grupo'=>$grupo['id'],'excluir'=>1);

         $checkbox=$acesso->filtrar($array);

         if(!empty($checkbox)){

            echo "checked";

         }



         ?>>
    </div>
</div>
