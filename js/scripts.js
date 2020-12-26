function criar_request() {
    try{
        request = new XMLHttpRequest();        
    }catch (IEAtual){
         
        try{
            request = new ActiveXObject("Msxml2.XMLHTTP");       
        }catch(IEAntigo){
         
            try{
                request = new ActiveXObject("Microsoft.XMLHTTP");          
            }catch(falha){
                request = false;
            }
        }
    }
    if (!request){
        alert("Seu navegador não suporta Ajax!");
    }else{
        return request;
    }
}

$(document).ready(function () { 
    var cpf = $("#cpf")
    cpf.mask('000.000.000-00', {reverse: true})

    var telefone = $("#telefone")		        
    telefone.mask('00 0000-0000',{reverse: true})

    var telefone = $("#data_nascimento")               
    telefone.mask('00/00/0000',{reverse: true})


    jQuery("#estado").change(function(){
        var estado = jQuery("#estado").children("option:selected").val();
        jQuery.ajax({
              url : "ajax_city.php?id_estado=" + estado,
              type : "get"
         })
         .done(function(data){
              jQuery("#cidade").html(data);
              console.log(data)
             
         });
    }); 

 //    $(function(){
	// 	$('#estado').change(function(){
	// 		if( $(this).val() ) {
	// 			// $('.carregando').show();
	// 			var result = document.getElementById("cidade");
 //                // var result = $('#cidade')
	// 			var xmlreq = criar_request();
	// 			xmlreq.open("GET", "ajax_city.php?id_estado=" + $(this).val(), true);
	// 	        xmlreq.onreadystatechange = function(){
	// 	            if (xmlreq.readyState == 4) {
	// 	                if (xmlreq.status == 200) {
	// 	                    result.innerHTML = xmlreq.responseText;
 //                            $('#cidade').html(xmlreq.responseText)
	// 						// $('.carregando').hide()
 //                            console.log(xmlreq.responseText)
	// 	                }else{
	// 	                    result.innerHTML = "Erro: " + xmlreq.statusText;
	// 	                }
	// 	            }
	// 	        };
	// 	        xmlreq.send(null);
	// 		}
	// 	});
	// });

});

function exibir_menu() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    }else{
        x.className = "topnav";
    }
}

function validar_cpf() {
    var cpf   = document.getElementById("cpf").value;
    var result = document.getElementById("erro");
    var xmlreq = criar_request();
    
    if($("#cpf").val().length >= 10){
        xmlreq.open("GET", "validate_cpf.php?cpf=" + cpf, true);
        xmlreq.onreadystatechange = function(){
              
            if (xmlreq.readyState == 4) {
                if (xmlreq.status == 200) {
                    result.innerHTML = xmlreq.responseText;
                }else{
                    result.innerHTML = "Erro: " + xmlreq.statusText;
                }
            }
        };
        xmlreq.send(null);
    }
}

function validar_senha(){
    var senha = $("#senha").val()
    var confirmar_senha = $("#confirmar_senha").val()
    var erro = $("#erro")
    
    if(confirmar_senha != senha){
        erro.html('<div style="color: #721c24; background-color: #f8d7da; border-color: #f5c6cb; border-radius: 5px; padding: 10px;">As senhas precisam ser iguais!</div><br />');
    }else{
        erro.html('');
    }
}