
$(function() {
//mascaras
    $(document).on('keypress', 'input[name="cep"]', function() {
        $(this).mask("99.999-999");
    });

    $(document).on('keypress', 'input[name="nascimento"]', function() {
        $(this).mask("99/99/9999");
    });


    $(document).on('keypress', 'input[name="tel"]', function() {
        $(this).mask("(99)999999999");
    });
    $(document).on('keypress', 'input[name="horas"]', function() {
        $(this).mask("99:99");
    });

    $(document).on('keypress', '.maskHoras', function() {
        $(this).mask("99:99");
    });

    $(document).on('keypress', '.maskNumero', function() {
        $(this).mask("99999");
    });

    $(document).on('keypress', 'input[name="cel"]', function() {
        $(this).mask("(99) 999999999");
    });
    
   
    $(document).on('keypress', 'input[name="cnpj"]', function() {
        $(this).mask('99.999.999/9999-99');
    });

    $(document).on('keypress', '#numeroProcesso', function() {
        $(this).mask('9999999-99.9999.9.99.9999');
    });
    

     $(document).on('keypress', '.maskNota', function() {
        $(this).mask("99,99");
    });
    //datepiker


    $(document).on('click', '.data', function() {
        $(this).datepicker({format: "dd/mm/yyyy"});
        $(this).datepicker('show');
    });
    //add produto  


   
    //datepiker

    $(document).on('click', '.datepicker', function() {
        $(this).datepicker('show');
    });
    $(document).on('click', 'input[name=data_de]', function() {
        $(this).datepicker({format: "yyyy-mm-dd"});
        $(this).datepicker('show');

    });
    
    $(document).on('click', 'input[name=data_ate]', function() {
        $(this).datepicker({format: "yyyy-mm-dd"});
        $(this).datepicker('show');
    });
    $(document).on('click', 'input[name=dt_vencimento]', function() {
        $(this).datepicker({format: "yyyy-mm-dd"});
        $(this).datepicker('show');
    });
    $(document).on('click', '.inputDate', function() {
        $(this).datepicker({format: "yyyy-mm-dd"});
        $(this).datepicker('show');
    });

    //GERAL

     $(document).on('keypress', 'input[name="cpf"]', function() {
        $(this).mask('000.000.000-00', {reverse: true});
    });




    // mae form 


    


    

});

