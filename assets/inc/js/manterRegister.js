$(document).ready(function(){
  
  var api;
  $.get("_db/url.php", function(result) { api = JSON.parse(result)});
  
});

function resetForm(form) {
  $('#'+form).each(function(){
    this.reset(); 
  });
}//ResetForm

$('#formRegister').submit(function(){ 
  var json = jQuery(this).serialize();
  //var formData = new FormData(this);
  cadastrar(json);
  return false;
});//CreateForm

function cadastrar(json) {
  var senha1 = $("#register-senha-1").val();
  var senha2 = $("#register-senha-2").val();

  if(senha1 != senha2){
    window.alert('Senhas Não Conferem!');
  }else{
    var acao = 'manterRegister';
    var tipoAcao = 'insert';

    $.ajax({
      url:"manter.php",                    
      type:"post",                            
      data: json+"&acao="+acao+"&tipoAcao="+tipoAcao,
      dataType: "JSON",
      success: function (result){   
        console.log(result);
        if(result.status == 200){   

          window.alert('Registro Realizado com Sucesso!');
  		    window.location.replace('http://app.rafafreitas.com');

        }if(result.status == 500){
          toastr.options.progressBar = true;
          toastr.options.closeButton = true;
          toastr.error(result.result);
        }  
      }//success
    });//ajax
    return false;
  }
}//Cadastrar