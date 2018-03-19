var api = "";
$.get("../_db/url.php", function(result) { api = JSON.parse(result)});
$(document).ready(function(){

  if (api) {
    var table;
    initTable(table, api);
    initPage();
  }

});

function initPage() {
  $('#loadPublicacao').hide();
  $('#btmCancelar').click(function(){
    resetForm('form-company-add');
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
             acao : "manterFilial",
             tipoAcao: "listarAll"
           },
           dataSrc: ''
         },
    columns: [
               { data: "empresa_nome" },
               { data: "filial_nome" },
               { data: "filial_cnpj" },
               { data: "filial_telefone" },
               { 
                 defaultContent: "<button type='button' class='btn btn-success' id='atualizar' title='Atualizar Dados'><span class='fa fa-pencil'></button>&nbsp;"+
                 "<button type='button' class='btn btn-info' id='menu' title='Acessar Menu da Filial'><span class='fa fa-list-alt'></button>&nbsp;"+
                 "<button type='button' class='btn btn-danger' id='apagar' title='Apagar Filial'><span class='fa fa-trash'></button>"
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