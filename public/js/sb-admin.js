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
        deleteAjax('user', id);
    });

    $(document).on('click', '.btn-post-delete', function () {
        var id = $(this).closest('tr').find('.post-id').html();
        deleteAjax('post', id);
    });

    function deleteAjax(typeDelete, id){
        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });
        $.ajax({
            type: "DELETE",
            url: typeDelete +'s/'+id,
            success: function (data) {
                $("#"+typeDelete+"-"+id).remove();
            },
            error: function (data) {
                console.log('ERR');
            }
        });
    }
});
