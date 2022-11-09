<div  class="col-sm-6">
    <h3 class="titulo">Admin</h3>
    <div  class="col-sm-3">
        Cadastrar
        <input type="checkbox" name="acess_cadatrar[Admin]"  <?php

        $array = array('modulo'=>'Admin','id_grupo'=>$grupo['id'],'incluir'=>1);

         $checkbox=$acesso->filtrar($array);

         if(!empty($checkbox)){

            echo "checked";

         }



         ?> >

    </div>
    <div  class="col-sm-3">
        Visualizar
         <input type="checkbox" name="acess_visualizar[Admin]"
         <?php

        $array = array('modulo'=>'Admin','id_grupo'=>$grupo['id'],'visualizar'=>1);

         $checkbox=$acesso->filtrar($array);

         if(!empty($checkbox)){

            echo "checked";

         }



         ?>>
    </div>
    <div  class="col-sm-3">
        Editar
         <input type="checkbox" name="acess_editar[Admin]"   <?php

        $array = array('modulo'=>'Admin','id_grupo'=>$grupo['id'],'editar'=>1);

         $checkbox=$acesso->filtrar($array);

         if(!empty($checkbox)){

            echo "checked";

         }



         ?>>
    </div>
    <div  class="col-sm-3">
        Excluir
         <input type="checkbox" name="acess_excluir[Admin]"
           <?php

        $array = array('modulo'=>'Admin','id_grupo'=>$grupo['id'],'excluir'=>1);

         $checkbox=$acesso->filtrar($array);

         if(!empty($checkbox)){

            echo "checked";

         }



         ?>>
    </div>
</div>
