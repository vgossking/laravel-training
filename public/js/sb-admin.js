$(function() {

    $('#side-menu').metisMenu();

});

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
$(function() {
    $(window).bind("load resize", function() {
        width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.sidebar-collapse').addClass('collapse');
        } else {
            $('div.sidebar-collapse').removeClass('collapse');
        }
    });
});

$(function () {
    $(document).on('click', '.btn-delete', function () {
        var id = $(this).closest('tr').find('.user-id').html();
        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });
        $.ajax({
            type: "DELETE",
            url: "users/"+id,
            success: function (data) {
                location.reload();
            },
            error: function (data) {
                console.log('ERR');
            }
        });
    });
});
