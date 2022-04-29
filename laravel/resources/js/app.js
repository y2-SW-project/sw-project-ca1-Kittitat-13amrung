console.log("script loaded");

require('./bootstrap');

// when page loads
$( window ).on( "load", () => {
    // check if the page has been scrolled
    // and add classes
    $(window).scroll( function() {
        if($(this).scrollTop() >= 100) {
           $('.nav-header').addClass('nav-header-transition'); 
           $('.nav-header a').addClass('nav-text-transition'); 
        } else {
            $('.nav-header').removeClass('nav-header-transition');
            $('.nav-header a').removeClass('nav-text-transition'); 
        }
    });

    // focus email input 
    $('#loginModal').on('shown.bs.modal', function () {
        $('#email').focus();
      });

      let likeTooltip = '.like > i[data-toggle="tooltip"]';
      let favTooltip = '.favourite > i[data-toggle="tooltip"]';

      $(likeTooltip).tooltip({
          trigger: 'manual'
        });

        $(favTooltip).tooltip({
            trigger: 'manual'
          });
      
        //   runs if the user has not logged in has clicked the artist caroussel for likes or favourites
      window.guest = function(id) {

          
          $('#'+id+'[data-toggle="tooltip').tooltip('toggle');

            
          setTimeout(
              function() 
              {
                  $('#'+id+'[data-toggle="tooltip').tooltip('toggle');
                  $('#loginModal').modal('toggle');
              }, 700);


    }


    // set up ajax token
    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

    // runs when user is logged in and send ajax request to liked the element
    window.fetchLike = function(id){   
        let liker = $('div #liker'+id+"-bs3");
        
        let content = liker.html();
        
        let obj = $('div #like'+id);

        // console.log(id);
        $.ajax({

           type:'POST',

           url:'/artist/fetch/like',

           data:{id:id},

           success:function(data){
              if(jQuery.isEmptyObject(data.liked)){

                $(liker).each(function() {
                    $(this).html(parseInt(content)-1);
                });

                $(obj).each(function() {
                    $(this).removeClass("bi-hand-thumbs-up-fill");
                    $(this).addClass("bi-hand-thumbs-up");
                })
                
            }else{

                $(liker).each(function() {
                    $(this).html(parseInt(content)+1);
                });

                $(obj).each(function() {
                    $(this).removeClass("bi-hand-thumbs-up");
                    $(this).addClass("bi-hand-thumbs-up-fill");
                })

              }

           },


        });

    };

    // runs only if the user is logged in
    window.fetchFavourite = function(id){   
        
        let obj = $('div #favorite'+id);

        // console.log(id);
        $.ajax({

           type:'POST',

           url:'/artist/fetch/favourite',

           data:{id:id},

           success:function(data){
               console.log(data);
              if(jQuery.isEmptyObject(data.favourited)){

                $(obj).removeClass("bi-heart-fill");
                $(obj).addClass("bi-heart");
                
            }else{
                $(obj).removeClass("bi-heart");
                $(obj).addClass("bi-heart-fill");

              }

           }

        });

    };

});