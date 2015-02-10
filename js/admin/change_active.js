        
    $(".nav-change  a").on("click", function (e) { /*  NOTIFICATION PANEL - NAV TAB ÖĞELERİ İÇİN*/
        var id = $(this).attr("href").substr(0);
        localStorage.setItem('active_tab',id);
        
    });
    
    
    var hash =  localStorage.getItem('active_tab');
    if (hash!==null) {
    $('#nav-id  a[href="' + hash + '"]').parent('li').addClass('active');
       localStorage.removeItem('active_tab');
    }
    else
    { $('#nav-id :last-child').addClass('active');
      $('#nav-id a').removeClass('active');
    }

$("#chatbox").prop({ scrollTop: $("#chatbox").prop("scrollHeight") }); // CHATBOX SCROOLL UN SONDAN BAŞLAMASI