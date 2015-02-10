     $("#side-menu a").on("click",function (e) {
       var id = $(this).attr("href").substr(0);
       localStorage.setItem('active_side',id);
        
    });
    var hash_side = localStorage.getItem('active_side');
    if (hash_side!==null) {
    $('#side-menu a[href="' + hash_side + '"]').parents('li').addClass('active');
       localStorage.removeItem('active_side');
    }
    else
    { $('#side-menu :first-child').addClass('active');
      $('#side-menu a').removeClass('active');
      $('.nav-second-level li').removeClass('active');
      $('.nav-third-level li').removeClass('active');
    }
