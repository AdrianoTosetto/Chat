var idReceiving = -1;
var idSending   = -1;
function updateChat(){
	var id1 = $('.chat-container').attr('id');
	var id2 = $('.chat-container').attr('id-friend');
	var url = "HTTPRequestManager.php?idSent="+id1+"&idReceived=" + id2;
    $.get(url, function(data) {
        $('.chat-body').html(data);
        //alert(data);
        scrollChatDown();
        setTimeout(updateChat,5000);
    });
}
$(document).ready(function(){
			updateChat();
			 $('.updateStatus').click(function(){
 				var status = $("#statusInput").val();
 				var id = $('.chat-container').attr('id');
 				$("#statusInput").val('');
 				if(status.length != 0) {
 					var url = "HTTPRequestManager.php?newStatus="+status+"&userId="+id;
 					$.ajax(url, {
					      success: function(data) {
					      		//$('.chat-body').html(data);
					      },
					      error: function() {
					         alert('Errou');
					      }
				    });
 				}
 				return false;
 			});
 			$('.user').click(function(){
 				$('.chat-container').attr('id-friend',$(this).attr('id'));
 				scrollChatDown();
 			});
 			$('.update-status').click(function(){
 				$('.status-input').toggleClass("input-hidden");
 				$('.status-button').toggleClass("button-hidden");
 			});
 			$('.user').click(function(){
 				$('.friend-name').text($(this).text());
 				var idSent = $('.chat-container').attr('id');
 				var idReceived = $('.chat-container').attr('id-friend');
 				idReceiving = idReceived;
 				idSending = idSent;
 				var url = "HTTPRequestManager.php?idSent="+idSent+"&idReceived=" + idReceived;
 				$.ajax(url, {
					      success: function(data) {
					      		$('.chat-body').html(data);
					      },
					      error: function() {
					         alert('Errou');
					      }
				    });
 					if(text.length != 0) {
 						$(this).val('');
 						var html = "<div class="+"sender"+">"+text+"</div>";
 						$('.chat-body').append(html);
 						return false;
 					}
 			});
 			$('.user').hover(function(){
 				var url = "HTTPRequestManager.php?getStatusById=" + $(this).attr('id');
		  		$.ajax(url, {
				      success: function(data) {
				      		$('.status').html("Status: " + data);
				      },
					  error: function() {
					  alert('Errou');
					}
				}); 		
 				$('.description').fadeIn('fast');
 				$('.description').css('top',(($(this).position().top)) + 50);

 			},function(){
 				$('.description').fadeOut('fast');
 			});
 			$('textarea').keypress(function(key){
 				if(key.keyCode == 13){
 					var text = $(this).val();
 					if(text.length != 0){
	 					var idUserReceived = $('.chat-container').attr('id-friend');
	 					var idUserSent     = $('.chat-container').attr('id');
	 					//alert(idUserSent + " e " + idUserReceived);
	 					var url  = "HTTPRequestManager.php?text="+text+"&idUserSent="+idUserSent+"&idUserReceived=" + idUserReceived;
		  				$.ajax(url, {
						      success: function(data) {},
						      error: function() {
						         alert('Errou');
						      }
					    });
					    scrollChatDown();
					}
 					if(text.length != 0) {
 						$(this).val('');
 						var html = "<div class="+"sender"+">"+text+"</div>";
 						$('.chat-body').append(html);
 						return false;
 					}
 					return false;
 				}
 			});
 			$('button').click(function(key){
 					var text = $('textarea').val();
 					if(text.length != 0) {
 						$('textarea').val('');
 						var html = "<div class="+"sender"+">"+text+"</div>";
 						//$('.chat-body').append(html);
 						return false;
 					}
 					return false;
 			});
 		});