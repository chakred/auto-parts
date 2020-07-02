$(document).ready(function(){
   let removeRow = $('.remove_row')

    removeRow.on('click', function (e) {
        e.preventDefault();
        let rowId = $(this).data('row-id');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/product/remove-from-cart",
            type: "POST",
            data: {
                rowId : rowId,

            },
            dataType: "html"
        });

    })
})
