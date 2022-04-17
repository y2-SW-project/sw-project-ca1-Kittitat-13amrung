$(window).on("load", () => {

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

    function fetchRequest(page, sort_type, sort_by) {
        $.ajax({
            url: "/art/requests/fetch?page="+page+"&sortby="+sort_by+"&sorttype="+sort_type,
            success: (data) => {
                
            }
        })
    }
});