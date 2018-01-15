jQuery(document).ready(function ($) {

    //showLoader();
    //tableView();

    // var activeTab = 'map';

    // $("#gmap-filter").submit(function (event) {
    //     event.preventDefault();
    //     showProgress('gmap-filter');

    //     if (activeTab == 'map') {
    //         markers();
    //     } else if (activeTab == 'table') {
    //         tableAjax();
    //     }
    // });

    // $(document).on('change', '.cats-filter input[type=checkbox]', function () {
    //     showLoader();

    //     if (activeTab == 'map') {
    //         markers();
    //     } else if (activeTab == 'table') {
    //         tableAjax();
    //     }
    // });

    // $(document).on('click', '#tableView', function () {
    //     tableAjax();
    //     showLoader();
    //     activeTab = 'table';

    // });

    $(document).on('click', '#monuments_map_search_btn', function () {
        event.preventDefault();
        markers();
        // showLoader();
        // activeTab = 'map';

    });

    google.maps.event.addDomListener( window, 'load', initMap );

    // $(document).on('click', '#mon_search_btn', function () {
    //     showProgress('gmap-filter');
    //     markers();
    // });

});
var mark = [];
function initMap() {

    var mapId = 'monuments_map';
    // Draw map
        map = new google.maps.Map(document.getElementById(mapId), {
            center: {lat: 42.7000, lng: 23.3333},
            zoom: 12
        });
        markers();
}

function markers() {

    var formId = 'ajax_search_form';

    var $ = jQuery;
    var url = "http://172.16.100.10/register.sofiahistorymuseum.bg/web/public/restapi";
    var formdata = jQuery("#"+formId).serialize()
    $.ajax({
            url: url,
            dataType: "json",
            data: formdata,
        })
        .done(function (res) {
            // clearProgress('gmap-filter');
            //result = res;
            if (!res) {
                console.log('Undefined or invalid Map xhr response');
                return;
            }
            if (!res.error) {

                var infowindow = new google.maps.InfoWindow({maxWidth: 800, maxHeight: 400});
                $.each(mark, function () {
                    this.setMap(null);
                });

                var bounds = new google.maps.LatLngBounds();

                var resToShow = 0;
                $.each(res, function (i, elem) {
                    if( elem.latitude && elem.longitude ) {
                        resToShow++;
                    }
                });


                $.each(res, function (i, elem) {
                    if (elem.latitude && elem.longitude) {
                        var pos = {
                                lat: parseFloat(elem.latitude),
                                lng: parseFloat(elem.longitude)
                            },
                            marker = new google.maps.Marker({
                                position: pos,
                                title: elem.title,
                                icon: elem.marker
                            });

                        // Extend map bounds based on marker coords
                        bounds.extend(new google.maps.LatLng(pos.lat, pos.lng));
                        // Fit map bounds only if there are multiple markers

                        map.fitBounds(bounds);

                        if (resToShow == 1) {
                            zoomChangeBoundsListener =
                                google.maps.event.addListenerOnce(map, 'bounds_changed', function (event) {
                                    if (this.getZoom()) {
                                        this.setZoom(13);
                                    }
                                });
                            setTimeout(function () {
                                google.maps.event.removeListener(zoomChangeBoundsListener)
                            }, 2000);
                        }

                        // Add marker's infowindow
                        google.maps.event.addListener(marker, 'click', function () {
                            infowindow.close();
                            if (res.version == 2) {

                                if (elem.counter > 1) {
                                    var counter = '<div class="obj-count">Намерени са <strong>' + elem.counter + '</strong> обекта на този адрес</div>';
                                } else {
                                    var counter = '';
                                }
                                infowindow.setContent('<div class="infoWindow-wrapper">' + counter + '<h3>'+elem.title+'</h3></div>');

                            } else {
                                    infowindow.setContent('<div class="col-md-3"><img src="'+elem.image+'" width="100%"></div><div class="col-md-9"><h4>'+elem.title+'</h4><div class="">'+elem.note+'</div></div>');
                            }
                            infowindow.open(map, marker);
                        });

                        // Add the markers to the map
                        mark.push(marker);
                        marker.setMap(map);
                    }
                });

                hideLoader();
            }
        })
        .fail(function () {
            hideLoader();
            console.log('Something went wrong with Map xhr');
        });
}


function showLoader() {
    jQuery('#filterLoader').animate({
            opacity: 1
        }
    );
}

function hideLoader() {
    jQuery('#filterLoader').animate({
            opacity: 0
        }
    );
}