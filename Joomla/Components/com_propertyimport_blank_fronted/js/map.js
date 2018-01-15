jQuery(document).ready(function($){

    showLoader();

    tableView();
    var clicked = false;
    $( "#searchform" ).submit(function( event ) {
        event.preventDefault();
        markers();
    });

    $(document).on('click', '#searchBtn', function () {
        showLoader();
        tableAjax();
        markers();
        clicked = false;
    });

    $(document).on('change', '.cats-filter input[type=checkbox]', function () {
        showLoader();
        tableAjax();
        markers();
        clicked = false;
    });


    $(document).on('click', '.tableView', function () {

        if(!clicked){
            tableAjax();
            showLoader();
            clicked = true;
        }
    });

});

var mark =[];

function initMap() {
    var mapId = 'map';
    var mapElem = document.getElementById(mapId);

    // Draw map
    if (mapElem) {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 42.7000, lng: 23.3333},
            zoom: 12
        });
        markers();
    } else {
        console.warn('Undefined dom element. Cannot init google map');
    }
}



function markers() {
    var $ = jQuery;
    var url = $('#SERVERURI').val() + 'index.php';
        lang = $('#SITELANG').val();

    var formData = $('#searchform').serialize();

    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        data: {
            option: 'com_mapview',
            task:'mapview.getMapPoints',
            lang: lang,
            format: 'json',
            tmpl: 'none',
            params: formData
        }
    })
        .done(function (res) {
            result = res;
            if (!res) {
                console.log('Undefined or invalid Map xhr response');
                return;
            }
            ;

            if (!res.error) {

                var infowindow = new google.maps.InfoWindow();
                $.each(mark, function(){
                    this.setMap(null);
                });
                mark = [];
                var bounds = new google.maps.LatLngBounds();
                var resToShow = 0;

                $.each(res, function( index, elem ) {

                    if(elem.lat && elem.lng) {
                        resToShow++;
                    }
                });

                regex = /.+?debug=/;

                var url = $('#SERVERURI').val();
                var isDebugger;
                if( url.match(regex) ){
                    var a = url.match(regex)[0];
                    isDebugger = url.replace(a, "");
                }
                $.each(res, function( index, elems ) {
                    $.each( elems, function(i, elem) {
                        if(elem.lat && elem.lng) {
                            var pos = {
                                    lat: parseFloat( elem.lat ),
                                    lng: parseFloat( elem.lng )
                                },
                                marker = new google.maps.Marker({
                                    position: pos,
                                    title: elem.title,
                                    icon: elem.icon
                                });
                            // Extend map bounds based on marker coords
                                bounds.extend( new google.maps.LatLng( pos.lat, pos.lng ) );
                            // Fit map bounds only if there are multiple markers

                            map.fitBounds( bounds );

                            if( resToShow == 1 ){
                                zoomChangeBoundsListener =
                                    google.maps.event.addListenerOnce(map, 'bounds_changed', function(event) {
                                        if (this.getZoom()){
                                            this.setZoom(13);
                                        }
                                    });
                                setTimeout(function(){google.maps.event.removeListener(zoomChangeBoundsListener)}, 2000);
                            }
                            // Add marker's infowindow
                            google.maps.event.addListener(marker,'click', function() {
                                    infowindow.close();
                                    if(parseInt(isDebugger) > 0){
                                        infowindow.setContent(
                                            '<div class="col-md-3"><img style="margin-top:10px; width:100%;" src="'+elem.img+'"></div>'+
                                            '<div class="col-md-9"><a href="'+url+'?option=com_k2&view=item&layout=item&id='+elem.id+'" target="mapiframe"><h5>' + elem.title + '</h5></a>' +
                                            '<p><strong>Адрес: </strong>'+elem.address+'</p>' +
                                            '<p><strong>Телефон: '+elem.phone+'</strong></p>'+
                                            '<p><strong>Lat: </strong>'+elem.lat+'<strong> Lng: </strong> '+elem.lng+'</p></div>'
                                            );
                                    } else {
                                        var address, phone = '';

                                        if(elem.address){
                                            address = '<p><strong>Адрес: </strong>'+elem.address+'</p>';
                                        }
                                        if(elem.phone){
                                            phone = '<p><strong>Телефон: '+elem.phone+'</strong></p></div>';
                                        }
                                        infowindow.setContent(
                                            '<div class="col-md-3"><img style="margin-top:10px; width:100%;" src="'+elem.img+'"></div>'+
                                            '<div class="col-md-9"><a href="'+url+'?option=com_k2&view=item&layout=item&id='+elem.id+'" target="mapiframe"><h5>' + elem.title + '</h5></a>' +
                                             address + phone
                                            );
                                    }
                                    infowindow.open( map, marker );
                            });

                            // Add the markers to the map
                            mark.push(marker);
                            marker.setMap( map );
                        }
                    });
                });

                hideLoader();
            }
        })
        .fail(function () {
            console.log('Something went wrong with Map xhr');
        });
}

function tableAjax(){
    var $ = jQuery;
    var url = $('#SERVERURI').val() + 'index.php';
    lang = $('#SITELANG').val();

    var formData = $('#searchform').serialize();

    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        data: {
            option: 'com_mapview',
            task:'mapview.getMapPoints',
            lang: lang,
            format: 'json',
            tmpl: 'none',
            params: formData
        }
    })
        .done(function (res) {
            result = res;
            if (!res) {
                console.log('Undefined or invalid Map xhr response');
                return;
            }
            ;

            if (!res.error) {
                fillTable(res);
            }
        })
        .fail(function () {
            console.log('Something went wrong with Map xhr');
        });
}

function tableView(){

    var col1 = "Обект",
        col2 = "Обект",
        col3 = "Обект";

    jQuery('#listViewTable').append('<thead><tr><th>'+col1+'</th><th>'+col2+'</th><th>'+col3+'</th></tr></thead>');
    jQuery('#listViewTable').append('<tbody></tbody>');


        jQuery('#listViewTable').dataTable( {
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.10/i18n/Bulgarian.json"
            }
        } );

}
function fillTable(res) {
    var url = jQuery('#SERVERURI').val();
    var col = [];
    jQuery('#listViewTable').dataTable().fnClearTable();
    jQuery('.dataTables_filter input, .dataTables_length select').addClass('form-control');
    var onMap = "";
    var count = 1;


    jQuery.each(res, function( i, elems ) {
        
        var len =0;
        jQuery.each(elems, function( ind, elem ) {
            len++;
            
        });
        
        jQuery.each(elems, function( index, elem ) {

            if(elem.lat > 1 && elem.lng > 1){
                onMap = '<img src="'+url+'/components/com_mapview/images/mapicon.png">';
            } else {
                onMap = ""
            }

            if(count <= 3 && count != len ) {
                if( elem.title == "" ) elem.title = "обект";
                col[count] = '<div class="col-md-2"><img src="' + elem.icon + '"/></div> '+onMap+' <a href="'+url+'index.php?option=com_k2&view=item&layout=item&id='+elem.id+'" target="mapiframe">' + elem.title+'</a>';
                count++;
                console.log("if");
            }else if( count == 1 && count == len ){
                if( elem.title == "" ) elem.title = "обект";
                col[count] = '<div class="col-md-2"><img src="' + elem.icon + '"/></div> '+onMap+' <a href="'+url+'index.php?option=com_k2&view=item&layout=item&id='+elem.id+'" target="mapiframe">' + elem.title+'</a>';
                 jQuery('#listViewTable').dataTable().fnAddData( [ col[1], "", "" ]);
                col = [];
                count = 1;
            }else if( count == 2 && count == len ){
                if( elem.title == "" ) elem.title = "обект";
                col[count] = '<div class="col-md-2"><img src="' + elem.icon + '"/></div> '+onMap+' <a href="'+url+'index.php?option=com_k2&view=item&layout=item&id='+elem.id+'" target="mapiframe">' + elem.title+'</a>';
                 jQuery('#listViewTable').dataTable().fnAddData( [ col[1], col[2], "" ]);
                col = [];
                count = 1;
            }else if( count == 3 && count == len ){
                if( elem.title == "" ) elem.title = "обект";
                col[count] = '<div class="col-md-2"><img src="' + elem.icon + '"/></div> '+onMap+' <a href="'+url+'index.php?option=com_k2&view=item&layout=item&id='+elem.id+'" target="mapiframe">' + elem.title+'</a>';
                 jQuery('#listViewTable').dataTable().fnAddData( [ col[1], col[2], col[3] ]);
                col = [];
                count = 1;
            } else {
                jQuery('#listViewTable').dataTable().fnAddData( [ col[1], col[2], col[3] ]);
                col = [];
                count = 1;
            }
        });
    });

    hideLoader()
}



function showLoader() {
    jQuery('#filterLoader').animate({
            opacity: 1}
    );
}

function hideLoader() {
    jQuery('#filterLoader').animate({
            opacity: 0}
    );
}

