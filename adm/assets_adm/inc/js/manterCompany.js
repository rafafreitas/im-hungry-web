$(document).ready(function(){
  
  var api;
  var table;
  $.get("../_db/url.php", function(result) { api = JSON.parse(result)});
  initTable(table, api);
  initPage();

});

function initPage() {
  $(":input").inputmask();
  $('#loadPublicacao').hide();
  $('#btmCancelar').click(function(){
    resetForm('form-company-add');
  }); 

  $("#company-cep, #company-cep-at").keyup(function() {
    $('#loadCep').show();
    var cep = $(this).val().replace(/_/g, "");
    var temp = ($(this).attr('id') == "company-cep-at") ? '-at' : "";
    
    if ( cep.length != 9) {
      $('#loadCep'+temp).hide();
      $("#company-rua"+temp).val("");
      $("#company-bairro"+temp).val("");
      $("#company-cidade-uf"+temp).val("");
      $("#company-lat"+temp).val("");
      $("#company-long"+temp).val("");
    }else{
      buscaCep(cep, temp);
    }
    
  });

  $("#company-logo, #company-logo-at").fileinput({
    allowedFileExtensions: ["jpg", "gif", "png"],
    maxFilePreviewSize: 10240,
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

}//initPage

function buscaCep(cep, temp){
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
        $('#loadCep'+temp).hide();
        $("#company-rua"+temp).val("");
        $("#company-bairro"+temp).val("");
        $("#company-cidade-uf"+temp).val("");
        $("#company-lat"+temp).val("");
        $("#company-long"+temp).val("");

        toastr.options.progressBar = true;
        toastr.options.closeButton = true;
        toastr.success(result.result);

      }else{
        $('#loadCep'+temp).hide();
        $("#company-rua"+temp).val(result.dados.logradouro);
        $("#company-bairro"+temp).val(result.dados.bairro);
        $("#company-cidade-uf"+temp).val(result.dados.cidade+'-'+result.dados.uf);
        $("#company-lat"+temp).val(result.dados.latitude);
        $("#company-long"+temp).val(result.dados.longitude);

      }

    }
  });
}

function resetForm(form) {
  $('#'+form).each(function(){
    this.reset(); 
  });
}//ResetForm

function initTable(table, api) {
  table = 
  $('#datatable-responsive').DataTable( {	
    processing: true,
    responsive: true,
    ajax: {
           url: 'manter.php',
           type: "POST",
           data : {
             acao : "manterEmpresa",
             tipoAcao: "listarAll",
             enabled: true
           },
           dataSrc: ''
         },
    columns: [
               { data: "empresa_nome" },
               { data: "empresa_cnpj" },
               { data: "empresa_telefone" },
               { 
                 defaultContent: "<button type='button' class='btn btn-success' id='atualizar' title='Atualizar'><span class='fa fa-pencil'></button>&nbsp;"+
                 "<button type='button' class='btn btn-danger' id='apagar' title='Apagar'><span class='fa fa-trash'></button>"
               }
            ],
   fixedHeader: true,
   "language": {
     "lengthMenu": "Exibir _MENU_ por página",
     "zeroRecords": "Nada encontrado, desculpe.",
     "processing": "Processando...",
     "info": "Exibindo página _PAGE_ de _PAGES_",
     "infoEmpty": "Nenhum registro disponível",
     "infoFiltered": "(Filtrado de _MAX_ registros totais)",
     "search": "Buscar: ",
     "paginate": {
       "first":      "Primeiro",
       "last":       "Último",
       "next":       "Prox",
       "previous":   "Anterior"
     }
   }
  });//DataTable

	$('#datatable-responsive tbody').on( 'click', 'button', function () {
	    var data = table.row( $(this).parents('tr') ).data();
	    var idClick = $(this).attr('id');
	    switch(idClick) {
	      case 'atualizar':
	          updateObj(data);
	          break;
	      case 'apagar':
	          delUser(data.id_admin, table);
	          break;
	      default:
	          $('#alertaErro').show();
	            setTimeout(function() {
	            $('#alertaErro').hide();
	          }, 1000);  
	    }
	    //console.log(data);
	    //alert(data.id_admin);
	    //table.fnClearTable();//table.clear().draw();
	});//onClick

  $('#form-company-add').submit(function(){  
    //var json = jQuery(this).serialize();
    var formData = new FormData(this);
    cadastrar(formData, table);
    return false;
  });//CreateForm

  $('#formAtualizar').submit(function(){
    //var json = jQuery(this).serialize();
    var formData = new FormData(this);
    var status = $("#statusAt").val();
    if (status == '1') {
      submitUp(formData, table);
    }if (status == '0') {
      submitUp(formData);
    }
    return false;
  });//Update Form

  $("button.close").click(function(){
    var reload = $("#reloadAt").val();
    if (reload == 1) {
      //table.ajax.reload();
    }
  });

}//initTable

function cadastrar(formData, table) {
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

        $('#loadPublicacao').hide();
        table.ajax.reload();
        resetForm('form-company-add');

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
}//cadastrar

function updateObj(obj) {
  $("#company-logo-at").fileinput('destroy');

  $('#loadPublicacao').show();
  $('#submitGif').hide();
  $('#retornoAt').hide();
  $("#idAt").val(obj.empresa_id);
  $("#statusAt").val(obj.empresa_enabled);
  $("#reloadAt").val('0');

  buscaCep(obj.empresa_cep, "-at");
  $("#company-nome-at").val(obj.empresa_nome);
  $("#company-telefone-at").val(obj.empresa_telefone);
  $("#company-cnpj-at").val(obj.empresa_cnpj);
  $("#company-facebook-at").val(obj.empresa_facebook);
  $("#company-instagram-at").val(obj.empresa_instagram);
  $("#company-twitter-at").val(obj.empresa_twitter);
  $("#company-fundacao-at").val(obj.empresa_data_fundacao);
  $("#company-cep-at").val(obj.empresa_cep);
  $("#company-numero-at").val(obj.empresa_numero_endereco);
  $("#company-complemento-at").val(obj.empresa_complemento_endereco);
  
  $("#company-logo-at").fileinput({
    overwriteInitial: true,
    initialPreview: [
          "https://api.rafafreitas.com/uploads/empresa/"+obj.empresa_foto_marca
          ],
        initialPreviewConfig: [
                          {
                            caption: "Logo", 
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

  $("#myModalAtualizar").modal({backdrop: false});
  $('#loadPublicacao').hide();
}//updateObj

function submitUp(formData, table) {
  $('#submitGif').show();
  $('#retornoAt').hide();
  $.ajax({
    url:"manter.php",                    
    type:"post",                            
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
    success: function (result){ 
      var obj = JSON.parse(result)  
      console.log(obj);
      if(obj.status == 200){
        $('#submitGif').hide();
        $('#retornoAt').show();
        $("#reloadAt").val('1');
        table.ajax.reload();
        toastr.options.progressBar = true;
        toastr.options.closeButton = true;
        toastr.success(obj.result);

      }if (obj.status == 500){
        $('#submitGif').hide();
        toastr.options.progressBar = true;
        toastr.options.closeButton = true;
        toastr.error(obj.result);
      }
    }//success
  });//ajax
      return false;
}//submitUp

function enabledDisabled(argument) {
  // body...
}