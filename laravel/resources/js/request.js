console.log("loaded");


$( window ).on( "load", () => {
    window.fetchRequest = function(id) {
        $.ajax({
            url: '/art/requests/'+id,
            type: 'get',
            dataType: 'json',
            success: (response) => {
                $('#requestTable').empty();
                
                        let id = response.id;
                        let arts = [response.traditional_art, response.digital_art, response.pixel_art];
                        let commercial = response.commercial_use;
                        let description = response.description;
                        let start_date = response.start_date;
                        let end_date = response.end_date;
                        let start_price = response.start_price;
                        let end_price = response.end_price;
                        let user_id = response.user_id; 
                        let tr_str =
                        "<p class='h3'>" + response.id + "</p>" +
                        "<p class='h3'>" + arts[0] + "</p>" +
                        "<p class='h3'>" + arts[1] + "</p>" +
                        "<p class='h3'>" + arts[2] + "</p>" +
                        "<p class='h3'>" + commercial + "</p>" +
                        "<p class='h3'>" + description + "</p>" +
                        "<p class='h3'>" + start_date + "</p>" +
                        "<p class='h3'>" + end_date + "</p>" +
                        "<p class='h3'>" + start_price + "</p>" +
                        "<p class='h3'>" + end_price + "</p>" +
                        "<p class='h3'>" + user_id + "</p>";
                        // console.log(tr_str);
                        $('#requestTable').append(tr_str);
                        $('html, body').animate({
                                scrollTo: $('#request'+id).offset().top
                        }, 2000);
            }
        });
    };

    window.fetchRequest(1);
});

