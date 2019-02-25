$(function(){
	//scripts gérant la tête de chat
	$("#section2").hover(function(){
		$("#teteChat").css({"background-color":"#061339"});
	});
	
	$("#section2").mouseleave(function(){
		$("#teteChat").css({"background-color":"#7885A5"});
	});
	
	//scripts gérant le formulaire (validation)
	$("#envoyer").click(function(){
		if ($("#choix option:selected").val() == ""){
			$("#choix").css({"border":"1px solid red"});
		}
		
		if ($("#raison").val().length < 15 ){
				$("#raison").css({"border":"1px solid red"});
			}

		//(message de confirmation)
		else if ($("#raison").val().length >= 15 && $("#choix option:selected").val() != ""){
			$("#form").animate({height: "toggle"}).delay(200).queue(function() {$("#valider").animate({height: "toggle"});})
		}
	});
	
	//scripts pour enlever les bordures rouges
	$("#choix").change(function(){
		$("#choix").css({"border":"1px solid lightgrey"});
	});
	
	$("#raison").keydown(function(){
		$("#raison").css({"border":"1px solid lightgrey"});
	});
})