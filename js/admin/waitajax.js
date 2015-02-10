$(document).ajaxStart(function ()
{
    $('body').addClass('wait');
    $('#wrapper').bind('click contextmenu mousedown dblclick',function(e){
       e.stopPropagation();
       e.preventDefault();
       e.stopImmediatePropagation();
       
    });

}).ajaxComplete(function () {
    $('#wrapper').unbind();
    $('body').removeClass('wait');
   
});

