console.log("script loaded");

require('./bootstrap');

$( window ).on( "load", () => {
    $(window).scroll( function() {
        if($(this).scrollTop() >= 100) {
            console.log("test")
           $('.nav-header').addClass('nav-header-transition'); 
           $('.nav-header a').addClass('nav-text-transition'); 
        } else {
            $('.nav-header').removeClass('nav-header-transition');
            $('.nav-header a').removeClass('nav-text-transition'); 
        }
    });

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
        
      window.guest = function(id) {

          
          $('#'+id+'[data-toggle="tooltip').tooltip('toggle');

            
          setTimeout(
              function() 
              {
                  $('#'+id+'[data-toggle="tooltip').tooltip('toggle');
                  $('#loginModal').modal('toggle');
              }, 700);


    }


    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

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
                // console.log(liker.val());
                // $(liker).val(liker.val() - 1);
                $(liker).each(function() {
                    $(this).html(parseInt(content)-1);
                });

                $(obj).each(function() {
                    $(this).removeClass("bi-hand-thumbs-up-fill");
                    $(this).addClass("bi-hand-thumbs-up");
                })
                
            }else{
                // console.log(liker.val());
                // $(liker).val(liker.val() + 1);
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


    // window.login = function() {
    //     $('#login-submit').preventDefault();
    //     $.ajax({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         type: 'POST',
    //         url: '/login/authenticate',
    //         data: form.serialize(),
    //         success: function(controllerResponse) {
    //             console.log(controllerResponse);
    //             if (!controllerResponse) {
    //                // here show a hidden field inside your modal by setting his visibility 
    //                $('#loginModal').modal('toggle');
    //             } else {
    //                 $('#loginModal').modal('toggle');
    //                // controller return was true so you can redirect or do whatever you wish to do here
    //                window.location.href = $(location).attr("href");
    //             }
    //         }
    //     });
    // };
});