$(document).ready(function a(){
    $('#search_text').keypress(function (e){
         if(e.keyCode==13)
      {
      e.preventDefault();
      
        value = $('#search_text').val();
         tableName = $('.page-header a').attr('href');
      $.ajax({
          type: "POST",
          data: {text:value},
          url : "/ProjectNew/tables/"+tableName,
          success: function(data) {
              
                var div = $('#table_grid', $(data));
                $('.table-responsive').html(div);  
                $('#thewell').css('display','none');
                }
          });
      }
          
      });
    
});



$('#per_page').change(function(){
    tableName = $('.page-header a').attr('href');
    $.ajax({
        type:'POST',
        url: '/ProjectNew/tables/'+tableName,
        data: {pageSize: $('#per_page').val()},
        success:  function (data) { 
                    var div = $('.table-responsive', $(data));
                    $('.table-responsive').html(div); // yada location.reload();
                    $('#thewell').css('display','none');
                }
    });
    
    
    
});


