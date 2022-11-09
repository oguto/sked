<div  class="col-sm-6">
    <h3 class="titulo">Fotos</h3>
    <div  class="col-sm-3">
        Cadastrar  
        <input type="checkbox" name="acess_cadatrar[Fotos]"  <?php

        $array = array('modulo'=>'Fotos','id_usuario'=>$usuario['id'],'incluir'=>1);

         $checkbox=$acesso->filtrar($array);

         if(!empty($checkbox)){

            echo "checked";

         }



         ?> >  

    </div>
    <div  class="col-sm-3">
        Visualizar  
         <input type="checkbox" name="acess_visualizar[Fotos]"
         <?php

        $array = array('modulo'=>'Fotos','id_usuario'=>$usuario['id'],'visualizar'=>1);

         $checkbox=$acesso->filtrar($array);

         if(!empty($checkbox)){

            echo "checked";

         }



         ?>>                    
    </div>
    <div  class="col-sm-3">
        Editar  
         <input type="checkbox" name="acess_editar[Fotos]"   <?php

        $array = array('modulo'=>'Fotos','id_usuario'=>$usuario['id'],'editar'=>1);

         $checkbox=$acesso->filtrar($array);

         if(!empty($checkbox)){

            echo "checked";

         }



         ?>>                    
    </div>
    <div  class="col-sm-3">
        Excluir  
         <input type="checkbox" name="acess_excluir[Fotos]"
           <?php

        $array = array('modulo'=>'Fotos','id_usuario'=>$usuario['id'],'excluir'=>1);

         $checkbox=$acesso->filtrar($array);

         if(!empty($checkbox)){

            echo "checked";

         }



         ?>>                    
    </div>
</div>