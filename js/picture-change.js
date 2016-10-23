function test(){
	$('#changePicInput').change(function (evt) {
	    var tgt = evt.target || window.event.srcElement,
	        files = tgt.files;

	    if (FileReader && files && files.length) {
	        var fr = new FileReader();
	        fr.onload = function () {
	            document.getElementById('pic-change').src = fr.result;
	        }
	        fr.readAsDataURL(files[0]);
	        $('.resize-profile-pic-container').show();
	    } else {
	    	alert('Navegador não suporta essa funcionalidade');
	    }
	});
}
 $(document).ready(function(){
 	test();
 	$('#linkUpdatePic').click(function(){
 		$('#changePicInput').click();
 		//return false;
 	});
 	$('#height-range').change(function(){
 		var height = $(this).val() + '%';
 		$('#pic-change').attr('height',height);
 		$('#height-h').text(height);
 	});
 	$('#width-range').change(function(){
 		 var width = $(this).val() + '%';
 		$('#pic-change').attr('width',width);
 		$('#width-h').text(width);
 	});
 });