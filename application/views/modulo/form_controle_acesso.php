<div  class="col-sm-6">
    <h3 class="titulo">Modulo</h3>
    <div  class="col-sm-3">
        Cadastrar  
        <input type="checkbox" name="acess_cadatrar[Modulo]"  <?php

        $array = array('modulo'=>'Modulo','id_usuario'=>$usuario['id'],'incluir'=>1);

         $checkbox=$acesso->filtrar($array);

         if(!empty($checkbox)){

            echo "checked";

         }



         ?> >  

    </div>
    <div  class="col-sm-3">
        Visualizar  
         <input type="checkbox" name="acess_visualizar[Modulo]"
         <?php

        $array = array('modulo'=>'Modulo','id_usuario'=>$usuario['id'],'visualizar'=>1);

         $checkbox=$acesso->filtrar($array);

         if(!empty($checkbox)){

            echo "checked";

         }



         ?>>                    
    </div>
    <div  class="col-sm-3">
        Editar  
         <input type="checkbox" name="acess_editar[Modulo]"   <?php

        $array = array('modulo'=>'Modulo','id_usuario'=>$usuario['id'],'editar'=>1);

         $checkbox=$acesso->filtrar($array);

         if(!empty($checkbox)){

            echo "checked";

         }



         ?>>                    
    </div>
    <div  class="col-sm-3">
        Excluir  
         <input type="checkbox" name="acess_excluir[Modulo]"
           <?php

        $array = array('modulo'=>'Modulo','id_usuario'=>$usuario['id'],'excluir'=>1);

         $checkbox=$acesso->filtrar($array);

         if(!empty($checkbox)){

            echo "checked";

         }



         ?>>                    
    </div>
</div>