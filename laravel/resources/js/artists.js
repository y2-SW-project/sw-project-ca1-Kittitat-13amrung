$(window).on("load", () => {

    function fetchRequest(page, sort_type, sort_by) {
        $.ajax({
            url: "/art/requests/fetch?page="+page+"&sortby="+sort_by+"&sorttype="+sort_type,
            success: (data) => {
                
            }
        })
    }
});