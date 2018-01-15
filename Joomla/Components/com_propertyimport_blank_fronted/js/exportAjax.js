jQuery(document).ready(function($){


    $( "#exportForm" ).submit(function( event ) {
        event.preventDefault();
    });

    $(document).on('click', '#ExportExcelBtn', function(){
        showLoader();
        submitForm();
    })

});


function submitForm(){

    var formValues = jQuery( "#exportForm").serialize();
    var url = jQuery('#SERVERURI').val() + 'index.php';
    var urlRoot = jQuery('#SERVERURI').val();

    jQuery.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        data: {
            option: 'com_mapview',
            task:'mapview.getExcel',
            format: 'json',
            tmpl: 'none',
            params: formValues
        }
    })
        .done(function (res) {
            hideLoader();
            jQuery('.exportExcelMsg').html('Файла е успешно създаден. Може да го изтеглите от тук: <a href="'+urlRoot+'/export/lists/'+res+'">'+res+'</a>');

        })
        .fail(function () {
            console.log('Something went wrong');
        });
}

function showLoader() {
    jQuery('.exportExcelMsg .exportLoader').animate({
            opacity: 1}
    );
}

function hideLoader() {
    jQuery('.exportExcelMsg .exportLoader').animate({
            opacity: 0}
    );
}