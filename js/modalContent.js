function content (contentName) {
    $.ajax({
           type: "POST",
           url : 'site/'+contentName,
           success: function(data) {
               $('#'+contentName+'Content').html(data);
               $('#'+contentName+'_screen').modal('show');
           },
           error:function(response) {console.log(response);}
       });
}


