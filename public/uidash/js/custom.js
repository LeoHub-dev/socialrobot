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

	$('.form-confirm-follow').on('submit', function(e){
		
		e.preventDefault();

		var modal = $('.modal.fade.show');
	
		var user_id = $(modal).find('input[name=user_id]').val();

		$.post($(this).attr('action'), $(this).serialize(), function(response) {

			modal.modal('hide');

			$('#user-'+user_id).find('.btn-follow').html('<i class="now-ui-icons ui-2_favourite-28"></i> Siguiendo');

			$('#user-'+user_id).fadeOut("slow");
	
	    },"json").fail(function(xhr, status, error) {

	    	if(xhr.responseJSON.error)
	    	{
	    		errorModal(xhr.responseJSON.message);
	    	}
	    	else
	    	{
	    		alert('Hubo un error');
	    	}
	    });
	});

})

function errorModal(error)
{
	var modal = $('.modal.fade.show');
	if(modal.length > 0) 
	{
		modal.modal('hide');
	}
	$('#errorModal').find('.errorText').html(error);
	$('#errorModal').modal('show');
}