var value='';
function paginate(value) {
    var currentPage = 0;
	var numPerPage;
	if (value!='')
    numPerPage = value;
	else numPerPage = 10;
	
    var $table = $('#data_table');
    $table.bind('repaginate', function() {
        $('.gorunur').hide().slice(currentPage * numPerPage, (currentPage + 1) * numPerPage).show();
    });
    $table.trigger('repaginate');
    paintRows();
    
    var numRows = $('.gorunur').length;
    var numPages = Math.ceil(numRows / numPerPage);
    var pager = document.getElementById('pagination');
	pager.innerHTML="";
    for (page = 0; page < numPages; page++) {
                $('<span class="page-number btn-primary btn"></span>').text(page+1).bind('click', {
                    newPage: page
                }, function(event) {
                    currentPage = event.data['newPage'];
                    localStorage.setItem('active_page',currentPage);
                    $table.trigger('repaginate');
                    $(this).addClass('active').siblings().removeClass('active');
                }).appendTo(pager).addClass('clickable');
           
    }  
    
    
  
};

function pageNumbers (numPerPage) {
     var $table = $('#data_table');
 
}



$('#per_page').on('change',function (e) {

var select = document.getElementById("per_page");
value = parseInt(select.options[select.selectedIndex].text);
paginate(value);

} );

function paintRows () {
    var table = document.getElementById('data_table');
    var rows = table.getElementsByTagName('tr');
    for (i=1;i<rows.length;i++){
        rows[i].classList.remove('grey'); 
        
    }
    gorunur = document.getElementsByClassName('gorunur');
    
     for (i=1;i<gorunur.length;i++){
        if (i%2!=0) {gorunur[i].classList.add('grey'); }
    }
    
}

function on_Load () { document.getElementById("per_page").options[0].selected=true; paginate(10); }

window.onLoad = on_Load();