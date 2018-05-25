$(document).ready(function(){
  
  var api;
  $.get("../_db/url.php", function(result) { api = JSON.parse(result)});
  initPage();
  getData();

});

function initPage() {
  $(":input").inputmask();

  $("#perfil-cep").keyup(function() {
    $('#loadCep').show();
    var cep = $(this).val().replace(/_/g, "");
    
    if ( cep.length != 9) {
      $('#loadCep').hide();
      $("#perfil-rua").val("");
      $("#perfil-bairro").val("");
      $("#perfil-cidade-uf").val("");
    }else{
      buscaCep(cep);
    }
    
  });

  $('#form-perfil-add').submit(function(){  
    var formData = new FormData(this);
    atualizar(formData);
    return false;
  });//CreateForm

}//initPage

function getData(){
 $.ajax({
  url:"manter.php",                    
  type:"post",
  data: {
    acao : "manterPerfil",
    tipoAcao : "getInfo"
  },                     
  dataType: "JSON",
  success: function (obj){ 
    //console.log(obj);
    if(obj.status == 200){

      toastr.options.progressBar = true;
      toastr.options.closeButton = true;
      toastr.info(obj.result);

      buscaCep(obj.usuario[0].user_cep);
      $("#perfil-nome").val(obj.usuario[0].user_nome);
      $("#perfil-telefone").val(obj.usuario[0].user_telefone);
      $("#perfil-cpf").val(obj.usuario[0].user_cpf);
      $("#perfil-data").val(obj.usuario[0].user_data);
      $("#perfil-email").val(obj.usuario[0].user_email);
      $("#perfil-cep").val(obj.usuario[0].user_cep);
      $("#perfil-numero").val(obj.usuario[0].user_endereco_numero);
      $("#perfil-complemento").val(obj.usuario[0].user_endereco_complemento);

      $("#perfil-foto").fileinput({
        overwriteInitial: true,
        initialPreview: [
              "https://api.rafafreitas.com/uploads/usuarios/"+obj.usuario[0].user_foto_perfil
              ],
            initialPreviewConfig: [
                              {
                                caption: "Foto", 
                                width: "120px", 
                                key: 1},
              ],

        initialPreviewAsData: true, 
        initialPreviewFileType: 'image', 
              
        allowedFileExtensions: ["jpg", "gif", "png"],
        
        previewFileType: "image",
        showUpload: false, 
        language: "pt-BR",

        browseClass: "btn btn-success",
          browseLabel: "Escolher",
          browseIcon: "<i class=\"glyphicon glyphicon-picture\"></i> ",

        removeClass: "btn btn-danger",
          removeLabel: "Remover",
          removeIcon: "<i class=\"glyphicon glyphicon-trash\"></i> ",
      });
      
    }if (obj.status == 500){

      toastr.options.progressBar = true;
      toastr.options.closeButton = true;
      toastr.error(obj.result);
    }
  }
});
}

function buscaCep(cep){
  var acao = 'buscaCep';
  var tipoAcao = 'listar';

  $.ajax({
    url:"manter.php",                    
    type:"post",                            
    data: "cep="+cep+"&acao="+acao+"&tipoAcao="+tipoAcao,
    dataType: "JSON",
    success: function (result){ 
      console.log(result);

      if (result.status == 500 && result.qtd == 0) {
        $('#loadCep').hide();
        $("#perfil-rua").val("");
        $("#perfil-bairro").val("");
        $("#perfil-cidade-uf").val("");

        toastr.options.progressBar = true;
        toastr.options.closeButton = true;
        toastr.success(result.result);

      }else{
        $('#loadCep').hide();
        $("#perfil-rua").val(result.dados.logradouro);
        $("#perfil-bairro").val(result.dados.bairro);
        $("#perfil-cidade-uf").val(result.dados.cidade+'-'+result.dados.uf);

      }

    }
  });
}

function atualizar(formData) {
  $('#loadPublicacao').show();
  $.ajax({
    url:"manter.php",                    
    type:"post",                            
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
    success: function (result){   
      var obj = JSON.parse(result);
      console.log(obj);
      console.log(obj.status);
      if(obj.status == 200){   

        toastr.options.progressBar = true;
        toastr.options.closeButton = true;
        toastr.success(obj.result);

      }if(obj.status == 500){
        $('#loadPublicacao').hide();
        toastr.options.progressBar = true;
        toastr.options.closeButton = true;
        toastr.error(obj.result);
      }  
    }//success
  });//ajax
  return false;
}//atualizar