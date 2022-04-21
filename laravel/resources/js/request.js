console.log("loaded");
import Editor from "@toast-ui/editor";

let desc;
$( window ).on( "load", () => {
    
    $.ajax({
        url: '/art/requests/first',
        type: 'get',
        dataType: 'json',
        success: (res) => {
            console.log(res);
            let commercial = res.commercial_use;
            let description = res.description;
            if (description == null) {description = "Client has not specified any detail regarding this request. <br> Maybe consider contacting them directly?";}
            let start_date = res.start_date;
            let end_date = res.end_date;
            let start_price = res.start_price;
            let end_price = res.end_price;
            let user_id = res.user_id; 
            let title = "<h2 class='h2 text-capitalize card-title my-5'><i class='bi bi-info-circle pe-2'></i>" + res.title + "</h2><hr>";
            if (commercial !== 0) {
                let comm = "<span class='small text-start text-white d-lg-inline d-block border-bottom border-end border-4 border-muted rounded-pill px-2 px-lg-5 py-0 py-lg-3 bg-tertiary'>For Commercial Uses </span>'";
                $('#commTag').append(comm);
            } else {
                let comm = "<span class='small text-start text-white d-lg-inline d-block border-bottom border-end border-4 border-muted rounded-pill px-2 px-lg-5 py-0 py-lg-3 bg-primary'>For Personal Uses </span>";
                $('#commTag').append(comm);
            }
            console.log(res.title);
            if (res.digital_art !== 0) {
                let dig = "<span class='ms-auto p-2 mx-2 small rounded-pill bg-primary text-capitalize pill-hover'><i class='fs-6 me-1 bi bi-tags-fill'></i>Digital Art</span>";
                $('#artTag').append(dig);
            } 
            if (res.tradional_art !== 0) {
                let trad = "<span class='ms-auto p-2 mx-2 small rounded-pill bg-secondary text-dark text-capitalize pill-hover'><i class='fs-6 me-1 bi bi-tags-fill'></i>Traditional Art</span>";
                 $('#artTag').append(trad);
            }
            if (res.pixel_art !== 0) {
                let pix = "<span class='ms-auto p-2 mx-2 small rounded-pill bg-danger text-capitalize pill-hover'><i class='fs-6 me-1 bi bi-tags-fill'></i>Pixel Art</span>";
                $('#artTag').append(pix);
            }

            desc = description;
            // console.log(desc);

            let requestBody =
            "<p class='h5 my-5'><i class='bi bi-calendar-event pe-3'></i> Expected Begin Date: <span class='paragraph h6'>" + start_date + "</span></p>" +
            "<p class='h5 my-5'><i class='bi bi-calendar-x pe-3'></i> Expected Deadline Date: <span class='paragraph h6'>" + end_date + "</span></p>" +
            "<p class='h5 my-5'> Price Range: <span class='paragraph h6'>From €" + start_price + " To €" + end_price + "</span></p><hr>" +
            "<div class='h3 my-5 paragraph text-center' id='viewer'></div><hr>" +
            "<p class='paragraph text-end ms-auto my-5'> Document supplied by " + user_id + "</p>";
            // console.log(tr_str);
            $('#requestTitle').append(title);
            $('#requestBody').append(requestBody);

            const viewer = new Editor.factory({
                el: document.querySelector('#viewer'),
                viewer: true,
                initialValue: desc,
            });
        }
    })

    window.fetchRequest = function(id) {
        $('html, body').animate({
            scrollTop: $("#request"+id).offset().top - 225
    }, 200);
    // console.log($(window).height());

    $('.request-select').animate({
        scrollTop: 0
    }, 1000);

        $.ajax({
            url: '/art/requests/'+id,
            type: 'get',
            dataType: 'json',
            success: (response) => {
                $('#requestTitle').empty();
                $('#requestBody').empty();
                $('#commTag').empty();
                $('#artTag').empty();
                        let commercial = response.commercial_use;
                        let description = response.description;
                        if (description == null) {description = "Client has not specified any detail regarding this request. <br> Maybe consider contacting them directly?";}
                        let start_date = response.start_date;
                        let end_date = response.end_date;
                        let start_price = response.start_price;
                        let end_price = response.end_price;
                        let user_id = response.user_id; 
                        let title = "<h2 class='h2 text-capitalize card-title my-5'><i class='bi bi-info-circle pe-2'></i>" + response.title + "</h2><hr>";
                        if (commercial !== 0) {
                            let comm = "<span class='small text-start text-white d-lg-inline d-block border-bottom border-end border-4 border-muted rounded-pill px-2 px-lg-5 py-0 py-lg-3 bg-tertiary'>For Commercial Uses </span>'";
                            $('#commTag').append(comm);
                        } else {
                            let comm = "<span class='small text-start text-white d-lg-inline d-block border-bottom border-end border-4 border-muted rounded-pill px-2 px-lg-5 py-0 py-lg-3 bg-primary'>For Personal Uses </span>";
                            $('#commTag').append(comm);
                        }
                        if (response.digital_art !== 0) {
                            let dig = "<span class='ms-auto p-2 mx-2 small rounded-pill bg-primary text-capitalize pill-hover'><i class='fs-6 me-1 bi bi-tags-fill'></i>Digital Art</span>";
                            $('#artTag').append(dig);
                        } 
                        if (response.tradional_art !== 0) {
                            let trad = "<span class='ms-auto p-2 mx-2 small rounded-pill text-dark bg-secondary text-capitalize pill-hover'><i class='fs-6 me-1 bi bi-tags-fill'></i>Traditional Art</span>";
                             $('#artTag').append(trad);
                        }
                        if (response.pixel_art !== 0) {
                            let pix = "<span class='ms-auto p-2 mx-2 small rounded-pill bg-danger text-capitalize pill-hover'><i class='fs-6 me-1 bi bi-tags-fill'></i>Pixel Art</span>";
                            $('#artTag').append(pix);
                        }

                        desc = description;
                        // console.log(desc);

                        let requestBody =
                        "<p class='h5 my-5'><i class='bi bi-calendar-event pe-3'></i> Expected Begin Date: <span class='paragraph h6'>" + start_date + "</span></p>" +
                        "<p class='h5 my-5'><i class='bi bi-calendar-x pe-3'></i> Expected Deadline Date: <span class='paragraph h6'>" + end_date + "</span></p>" +
                        "<p class='h5 my-5'> Price Range: <span class='paragraph h6'>From €" + start_price + " To €" + end_price + "</span></p><hr>" +
                        // "<input type='hidden' name='view' id='view' value='" + description + "'>" +
                        "<div class='my-5 pe-auto paragraph text-center' id='viewer'></div><hr>" +
                        "<p class='paragraph text-end ms-auto my-5'> Document supplied by " + user_id + "</p>";
                        // console.log(tr_str);
                        $('#requestTitle').append(title);
                        $('#requestBody').append(requestBody);

                        const viewer = new Editor.factory({
                            el: document.querySelector('#viewer'),
                            viewer: true,
                            initialValue: desc,
                        });
            }
        });
    };

});

