$(document).ready(function() {
    $('.btn-follow').click(function(e) {
        e.preventDefault();
        var data = $(this).attr('data-user').split('|');
        var modal = $(this).attr('data-target');
        $(modal).find('.user_id').html(data[0]);
        $(modal).find('input[name=user_id]').val(data[0]);
        $(modal).find('.user_name').html(data[1]);
        $(modal).find('.user_reputation').html(data[2]);
    });
    $('.form-confirm-follow').on('submit', function(e) {
        e.preventDefault();
        var modal = $('.modal.fade.show');
        var user_id = $(modal).find('input[name=user_id]').val();
        $.post($(this).attr('action'), $(this).serialize(), function(response) {
            modal.modal('hide');
            $('#user-' + user_id).find('.btn-follow').html('<i class="now-ui-icons ui-2_favourite-28"></i> Siguiendo');
            $('#user-' + user_id).fadeOut("slow");
        }, "json").fail(function(xhr, status, error) {
            if (xhr.responseJSON.error) {
                errorModal(xhr.responseJSON.message);
            } else {
                alert('Hubo un error');
                console.log(error);
                console.log(xhr.responseJSON);
            }
        });
    });
    $('.form-payment-coin').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        $.post($(this).attr('action'), $(this).serialize(), function(response) {
            $('#payment-info').fadeIn();
            $('.payment-coin').html(form.find('select[name=coin]').val());
            $('#payment-address').val(response.data.message);
        }, "json").fail(function(xhr, status, error) {
            if (xhr.responseJSON != undefined && xhr.responseJSON.error) {
                errorModal(xhr.responseJSON.message);
            } else {
                alert('Hubo un error');
                console.log(error);
                console.log(xhr.responseJSON);
            }
        });
    });
    var laravel = {
        initialize: function() {
            this.methodLinks = $('.action-link[data-method]');
            this.token = $('.action-link[data-token]');
            this.registerEvents();
        },
        registerEvents: function() {
            this.methodLinks.on('click', this.handleMethod);
        },
        handleMethod: function(e) {
            var link = $(this);
            var httpMethod = link.data('method').toUpperCase();
            var form;
            // If the data-method attribute is not PUT or DELETE,
            // then we don't know what to do. Just ignore.
            if ($.inArray(httpMethod, ['PUT', 'DELETE']) === -1) {
                return;
            }
            // Allow user to optionally provide data-confirm="Are you sure?"
            if (link.data('confirm')) {
                if (!laravel.verifyConfirm(link)) {
                    return false;
                }
            }
            form = laravel.createForm(link);
            form.submit();
            e.preventDefault();
        },
        verifyConfirm: function(link) {
            return confirm(link.data('confirm'));
        },
        createForm: function(link) {
            var form = $('<form>', {
                'method': 'POST',
                'action': link.attr('href')
            });
            var token = $('<input>', {
                'type': 'hidden',
                'name': '_token',
                'value': link.data('token')
            });
            var hiddenInput = $('<input>', {
                'name': '_method',
                'type': 'hidden',
                'value': link.data('method')
            });
            return form.append(token, hiddenInput).appendTo('body');
        }
    };
    laravel.initialize();

    $('.json-action-link').click(function(e) {
		e.preventDefault();

		//var method = $(this).attr('data-method').toUpperCase();
		//var response_target = $(this).attr('data-target');

		var method = $(this).data('method').toUpperCase();
		var response_target = $(this).data('target');
		var token = $(this).data('token');

		if ( $.inArray(method, ['PUT', 'DELETE']) === - 1 ) {
       		return;
     	}
		
		if ($(this).data('confirm')) {
            if (!confirm($(this).data('confirm'))) {
                return false;
            }
        }

		$.post($(this).attr('href'), {'_token' : token}, function(response) {
            $('#'+response_target).fadeIn();
            $('#'+response_target).html(response.data.message);
        }, "json").fail(function(xhr, status, error) {
            if (xhr.responseJSON != undefined && xhr.responseJSON.error) {
                errorModal(xhr.responseJSON.message);
            } else {
                alert('Hubo un error');
                console.log(error);
                console.log(xhr.responseJSON);
            }
        });

     });
})

function errorModal(error) {
    var modal = $('.modal.fade.show');
    if (modal.length > 0) {
        modal.modal('hide');
    }
    $('#errorModal').find('.errorText').html(error);
    $('#errorModal').modal('show');
}