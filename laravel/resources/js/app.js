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

      window.guest = function() {
        $('#loginModal').modal('toggle');
    }

    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

    window.fetchLike = function(id){   
        
        let liker = $('#liker'+id+"-bs3");

        let content = liker.html();

        let obj = $('#like'+id);

        // console.log(id);
        $.ajax({

           type:'POST',

           url:'/artist/fetch/like',

           data:{id:id},

           success:function(data){
               console.log(data);
              if(jQuery.isEmptyObject(data.liked)){
                // console.log(liker.val());
                // $(liker).val(liker.val() - 1);
                $('#liker'+id+'-bs3').html(parseInt(content)-1);

                $(obj).removeClass("bi-hand-thumbs-up-fill");
                $(obj).addClass("bi-hand-thumbs-up");
                
            }else{
                // console.log(liker.val());
                // $(liker).val(liker.val() + 1);
                $('#liker'+id+'-bs3').html(parseInt(content)+1);
                $(obj).removeClass("bi-hand-thumbs-up");
                $(obj).addClass("bi-hand-thumbs-up-fill");

              }

           },


        });

    };

    window.fetchFavourite = function(id){   
        
        let obj = $('#favorite'+id);

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