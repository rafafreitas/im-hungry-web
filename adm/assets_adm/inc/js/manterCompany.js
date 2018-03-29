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

  $("#company-cep").keyup(function() {
    $('#loadCep').show();
    var acao = 'buscaCep';
    var tipoAcao = 'listar';
    var cep = $(this).val().replace("_", "");
    console.log($(this).val().replace("_", "").length);

    
    if ( $(this).val().replace("_", "").length < 9) {
      $('#loadCep').hide();
    }else{

      $.ajax({
        url:"manter.php",                    
        type:"post",                            
        data: "cep="+cep+"&acao="+acao+"&tipoAcao="+tipoAcao,
        dataType: "JSON",
        success: function (result){ 

          console.log('teste');
          console.log(result);

          // $('#loadCep').hide();
          // if (result != 1) {

          //   $("#enderecoDetalhe").show();
          //   $("#erroCep").hide();
          //   $("#ruaVer").html("<dd id='ruaVer'>"+result[0].logradouro+"</dd>");
          //   $("#bairroVer").html("<dd id='bairroVer'>"+result[0].bairro+"</dd>");
          //   $("#cidadeUfVer").html("<dd id='cidadeUfVer'>"+result[0].cidade+'-'+result[0].uf+"</dd>");
          //   $("#enderecoDetalhe").show();

          // } //end if.
          // else {
          //   $("#cepOng").val('');
          //   $("#enderecoDetalhe").hide();
          //   $("#erroCep").show();
          //   $("#descErro").html("<dd id='descErro' class='animated shake'>Cep não localizado.</dd>");
          // }
        }
      });

    }
    
 });

  $("#company-logo").fileinput({
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
             status: true
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
    cadastrar(formData, table, api);
    return false;
  });//CreateForm

  $('#formAtualizar').submit(function(){
    var json = jQuery(this).serialize();
    submitUp(json, table, api);
    return false;
  });//Update Form

  $("button.close").click(function(){
    //$('#datatable-cond-active').DataTable().ajax.reload();
    var reload = $("#reloadAt").val();
    if (reload == 1) {
      table.ajax.reload();
    }
  });

}//initTable

function cadastrar(formData, table) {
  $('#loadPublicacao').show();
  var acao = 'manterEmpresa';
  var tipoAcao = 'insert';             
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
  $('#loadPublicacao').show();
  $('#submitGif').hide();
  $('#retornoAt').hide();
  $("#idAt").val(obj.id_admin);
  $("#reloadAt").val('0');
  $("#nomeAt").val(obj.nome_admin);
  $("#userNameAt").val(obj.user_admin);
  $("#emailAt").val(obj.email_admin);
  $("#myModalAtualizar").modal({backdrop: false});
  $('#loadPublicacao').hide();
}//updateObj

function submitUp(json, table) {
  $('#submitGif').show();
  $('#retornoAt').hide();
  var acao = 'manterUsuario';
  var tipoAcao = 'editar';
  $.ajax({
    type: "POST",
    url: "manter.php",
    data: json+"&acao="+acao+"&tipoAcao="+tipoAcao,
    success: function(result)
    {
      if(result==1){
        $('#submitGif').hide();
        $('#retornoAt').show();
        $("#reloadAt").val('1');
        $('#retornoAt').addClass('animated shake');                     
        $("#retornoAt").html("<p class='text-center'>Informações atualizadas!</p>");

      }if (result !=1){
        $('#submitGif').hide();
        $('#retornoAt').show();
        $('#retornoAt').addClass('animated shake');                     
        $("#retornoAt").html("<p class='text-center'>"+ result+ "</p>");
      }
    }
  })
}//submitUp

function enabledDisabled(argument) {
  // body...
}