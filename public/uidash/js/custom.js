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
		console.log("test");
		e.preventDefault();
		var data = sendForm($(this));
		console.log(data);
		console.log(data.responseJSON);
		console.log(data.response);
		console.log(data.data);
		console.log(data.getResponse());
	});




})

function sendForm(form)
{
	var data = $.post(form.attr('action'), form.serialize(), null,"json");

    return data;
}