function div_show(x){
$('.alert').hide();
$('#'+x).show();
}

function div_show2(x,response){
$('.alert').hide();
if ((response!=null || response!='') && typeof response ==='object'){
    var array = $.map(response, function(value, index) {
             return [value];
         });
      response=array[0];
  console.log(response);}
 $('.alert-text').html(response);
$('#'+x).show();
}

$("[data-hide]").on("click", function(){
       // $("." + $(this).attr("data-hide")).hide();
         $(this).closest("." + $(this).attr("data-hide")).hide();
       
    });
    



/*$('#istek_form').submit(function (e) {
    e.preventDefault();
    $form = $('this');
    $.post(site.popup_screen,$form.serialize(),function (data) {
        $feedback= $('<div>').html(data).find('.form-feedback');
        
        $form.prepend($feedback);
        
    })
    
}); */
    
/*
$('#submitit').click(function (e) {
        alert('clicked');
        $form= $('#form');
        $.post(
        $form.attr("action"), // serialize Yii2 form
        $form.serialize()
        ).done(function(result) {
            $form.parent().html(result.message);
            $('#panel_login').modal('hide');
        })
        .fail(function() {
            console.log("server error");
            $form.replaceWith('<button class="newType">Fail</button>').fadeOut()
        });
    return false;
    
}) */
