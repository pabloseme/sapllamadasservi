$(document).ready(function()
{
    $('.secciones article').hide();
    $('.secciones article:first').show();

    $('a').click(function(){
        $('.secciones article').hide();
        
        var activetab=$(this).attr('href');
        $(activetab).show();
        return false;
    });
   
}
);