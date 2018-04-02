$(document).ready(function(){

  var api;
  var table;
  $.get("../_db/url.php", function(result) { api = JSON.parse(result)});
  createSelect();
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
    var cep = $(this).val().replace(/_/g, "");
    
    if ( cep.length != 9) {
      $('#loadCep').hide();
      $("#company-rua").val("");
      $("#company-bairro").val("");
      $("#company-cidade-uf").val("");
      $("#company-lat").val("");
      $("#company-long").val("");
    }else{

      $.ajax({
        url:"manter.php",                    
        type:"post",                            
        data: "cep="+cep+"&acao="+acao+"&tipoAcao="+tipoAcao,
        dataType: "JSON",
        success: function (result){ 
          console.log(result);

          if (result.status == 500 && result.qtd == 0) {
            $('#loadCep').hide();
            $("#company-rua").val("");
            $("#company-bairro").val("");
            $("#company-cidade-uf").val("");
            $("#company-lat").val("");
            $("#company-long").val("");

            toastr.options.progressBar = true;
            toastr.options.closeButton = true;
            toastr.success(result.result);
            
          }else{
            $('#loadCep').hide();
            $("#company-rua").val(result.dados.logradouro);
            $("#company-bairro").val(result.dados.bairro);
            $("#company-cidade-uf").val(result.dados.cidade+'-'+result.dados.uf);
            $("#company-lat").val(result.dados.latitude);
            $("#company-long").val(result.dados.longitude);
            
          }

        }
      });

    }
    
  });

}//initPage

function resetForm(form) {
  $('#'+form).each(function(){
    this.reset(); 
  });
}//ResetForm

function createSelect(){
  $("#empresa_id").empty();
  
  var acao = 'manterEmpresa';
  var tipoAcao = 'listarAll';
  $.ajax({
    url:"manter.php",                    
    type:"post",                            
    data: "acao="+acao+"&tipoAcao="+tipoAcao+"&status="+status,
    dataType: "JSON",

    success: function (result){ 
      $('select#empresa_id').append($("<option></option>").attr("value","").text("---")); 
      $.each(result, function(key, value) {   
        $('select#empresa_id')
          .append($("<option></option>")
          .attr("value",result[key].empresa_id)
          .text(result[key].empresa_nome));

      });

    }
  });

}

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
	      case 'menu':
        location.href='menu.php?show='+data.filial_id
	          break;
        case 'apagar':
            delUser(data.filial_id, table);
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