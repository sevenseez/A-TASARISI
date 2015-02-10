
$(document).ready(function(){
    notificate_first();
    setInterval(notificate, 60000);
});

function notificate() {
        $.ajax({
            type : 'POST',
            url :'/ProjectNew/admin/getNotify/',
            dataType : 'json',
            success: function(response){
            
            var msg_count = $('#all_msg').html();
            if(response.length>msg_count){
              //display a sound 
              var audio = new Audio('/ProjectNew/sound/notification.mp3');
              audio.play();
            }
            
            if(response.length!=0){
            $("#all_msg").html(response.length);
            }
            
            $('.huge').each(function(){
                   var count = 0;
                for(var i=0;i<response.length;i++){
                    if ($(this).attr("for") === response[i] ) 
                        count+=1;
                     }
                    $(this).html(count);
            });
        }
        
        });
    }
    
    function notificate_first() {
        $.ajax({
            type : 'POST',
            url :'/ProjectNew/admin/getNotify/',
            dataType : 'json',
            success: function(response){
            
            if(response.length!=0){
            $("#all_msg").html(response.length);
            }
            
            $('.huge').each(function(){
                   var count = 0;
                for(var i=0;i<response.length;i++){
                    if ($(this).attr("for") === response[i] ) 
                        count+=1;
                     }
                    $(this).html(count);
            });
        }
        
        });
    }