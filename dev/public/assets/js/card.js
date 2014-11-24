$(function(){

    if( $('#google-map').length ) {

        var latitude  = $('#google-map').data('latitude');
        var longitude = $('#google-map').data('longitude');

        var latlng = ( latitude == '' && longitude == '' ) ? new google.maps.LatLng( 50.833, 4.333 ) : new google.maps.LatLng( latitude, longitude );
        var map = new google.maps.Map( document.getElementById( 'google-map' ), {
            zoom: 8,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            panControl: 0,
            zoomControl: 0,
            mapTypeControl: 0,
            scaleControl: 0,
            streetViewControl: 0,
            overviewMapControl: 0
        });

        var marker = new google.maps.Marker({
            position: latlng,
            map: map,
            draggable: true,
        });

    }

    if( $('.pledge-edit').length && $('#pledge-modal').length ) {
        $(document).on('click', '.pledge-edit', function(e) {
            e.preventDefault();
            var $this = $(this),
                modal_url = $this.attr('href'),
                $pledge_modal = $('#pledge-modal');

            $pledge_modal.find('.modal-content').load(modal_url, function() {
                $pledge_modal.modal('show');
            });
        });

        $(document).on('click', '.pledge-update', function(e) {
            e.preventDefault();
            var $this = $(this);

            $('#pledge-modal .form-group').removeClass('has-error has-feedback');
            $('#pledge-modal .ajax-error').addClass('hidden');
            $this.button('loading');

            $.ajax({
                url: $this.attr('href'),
                type: 'post',
                dataType: 'json',
                data: {
                    title: $('#edit_pledge_title').val(),
                    description: $('#edit_pledge_description').val(),
                    price_min: $('#edit_pledge_price_min').val(),
                    price_max: $('#edit_pledge_price_max').val()
                },
                success: function(response) {
                    if( response.status == 'fail') {
                        if( response.errors.hasOwnProperty('title') ) {
                            var $child_parent = $('#edit_pledge_title').parents('.form-group').first();
                            $child_parent.addClass('has-error has-feedback');
                            $child_parent.find('.ajax-error').removeClass('hidden');
                            $child_parent.find('.ajax-error .help-block').html(response.errors.title);
                        }
                        if( response.errors.hasOwnProperty('description') ) {
                            var $child_parent = $('#edit_pledge_description').parents('.form-group').first();
                            $child_parent.addClass('has-error has-feedback');
                            $child_parent.find('.ajax-error').removeClass('hidden');
                            $child_parent.find('.ajax-error .help-block').html(response.errors.description);
                        }
                        if( response.errors.hasOwnProperty('price_min') ) {
                            var $child_parent = $('#edit_pledge_price_min').parents('.form-group').first();
                            $child_parent.addClass('has-error has-feedback');
                            $child_parent.find('.ajax-error').removeClass('hidden');
                            $child_parent.find('.ajax-error .help-block').html(response.errors.price_min);
                        }
                        if( response.errors.hasOwnProperty('price_max') ) {
                            var $child_parent = $('#edit_pledge_price_max').parents('.form-group').first();
                            $child_parent.addClass('has-error has-feedback');
                            $child_parent.find('.ajax-error').removeClass('hidden');
                            $child_parent.find('.ajax-error .help-block').html(response.errors.price_max);
                        }
                        $this.button('reset');
                    } else if( response.status == 'success' ) {
                        $('.modal').modal('hide');
                        reload_pledges( response.pledges_url );
                    }
                }
            });
        });
    }

    $(document).on('click', '.pledge-fund', function(e) {
        e.preventDefault();

        var $this = $(this),
            modal_url = $this.attr('href'),
            $pledge_modal = $('#pledge-modal');

        $pledge_modal.find('.modal-content').load(modal_url, function() {
            $pledge_modal.modal('show');
        });
    });

    $(document).on('click', '.pledge-buy', function(e) {
        e.preventDefault();

        var $this = $(this),
            $pledge_modal = $('#pledge-modal');

        $this.button('loading');

        $.ajax({
            url: $this.attr('href'),
            type: 'post',
            success: function(response) {
                $pledge_modal.find('.modal-content').load(response.view_url);
            }
        });
    });
});
function reload_pledges( pledges_url ) {
    $('#pledges-list tbody').empty().load( pledges_url );
}