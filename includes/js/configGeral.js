
$(function() {
    $('p').tooltip();
    $('a').tooltip();
    $('img').popover();
    $('a[data-toggle="popover"]').popover();
    $(document).on('mouseover', 'a', function() {
        $(this).tooltip();
    });
    $(document).on('mouseover', 'p', function() {       
        $(this).attr("data-placement=right");
        $(this).tooltip();
    });
    //Mascaras padrão do sistema
   
   

});






    