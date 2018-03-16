var api = "";
$.get("../_db/url.php", function(result) { api = JSON.parse(result)});
$(document).ready(function(){

  if (api) {
	console.log(api);
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
    	//serverSide: false,
       
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
	            { data: "result" },
	            { data: "qtd" },
	            { data: "message" },
	            { 
	              //data: "id_admin", 
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
    var json = jQuery(this).serialize();
    cadastrar(json, table);
    return false;
  });//CreateForm

  $('#formAtualizar').submit(function(){
    var json = jQuery(this).serialize();
    submitUp(json, table);
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

function cadastrar(json, table) {
  $('#loadPublicacao').show();
  var acao = 'manterUsuario';
  var tipoAcao = 'adicionar';             
  $.ajax({
    url:"manter.php",                    
    type:"post",                            
    data: json+"&acao="+acao+"&tipoAcao="+tipoAcao,
    success: function (result){             
      if(result==1){                      
        $('#loadPublicacao').hide();
        $('#alertaSucUser').show();
        table.ajax.reload();
        resetForm('form-company-add');
        setTimeout(function() {
          $('#alertaSucUser').hide();
        }, 2000);
      
      }if(result != 1){
        $('#loadPublicacao').hide();
        $('#alertaErro').show();
        setTimeout(function() {
          $('#alertaErro').hide();
        }, 2000);                 
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