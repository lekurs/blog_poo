jQuery(document).ready(function ($) {

    $('.select-rank').on('change', function (event) {
        var parent = $(this).closest('.select-contain');
        var idUser = parent.find('.hidd-id').val();
        var rankUser = parent.find('.select-rank').val();
        $('#idUser').val(idUser);
        $('#rankUser').val(rankUser) ;

        $('form#update-user').submit();

    })
})
