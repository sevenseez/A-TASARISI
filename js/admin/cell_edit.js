

function load_this (count) {

    $('.table-bordered').each(function(){$(this).attr('id', 'data_table');}); 
    var table = document.getElementById('data_table');
    var rows = table.getElementsByTagName('tr');

    
    for(k=1;k<=count;k++)
    {
       rows[k].classList.add('danger'); 
    }
}
    
    window.onLoad = load_this();
 
    
   