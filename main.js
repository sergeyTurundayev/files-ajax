let formData = new FormData();

let formInfo = $('#my-form').serialize();

formData.append('info', formInfo);

$('.input_file').each(function() {

	let fileData = $(this).prop('files')[0];

	formData.append( $(this).attr('id'), fileData );

});

let canvas = $('#canvas');

let canvasImgCode = canvas[0].toDataURL("image/png").replace("image/png", "image/octet-stream");

formData.append('canvas', canvasImgCode);

$.ajax({
	url: "../form.php",
	dataType: 'text',
	cache: false,
	contentType: false,
	processData: false,
	data: formData,
	type: 'post',
	success:function(response){
				// console.log(response);
			}
		});