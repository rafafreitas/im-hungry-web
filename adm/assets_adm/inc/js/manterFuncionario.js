$(document).ready(function(){
  
  var api;
  var tableAt;
  var tableIn;
  //$.get("../_db/url.php", function(result) { api = JSON.parse(result)});
  initTable(tableAt, tableIn, api);
  initPage();

});

function initPage() {
  $(":input").inputmask();

  $('#btmCancelar').click(function(){
    resetForm('form-company-add');
  }); 

  $("#funcionario-cep, #funcionario-cep-at").keyup(function() {
    $('#loadCep'+temp).show();
    var cep = $(this).val().replace(/_/g, "");
    var temp = ($(this).attr('id') == "funcionario-cep-at") ? '-at' : "";
    
    if ( cep.length != 9) {
      $('#loadCep'+temp).hide();
      $("#funcionario-rua"+temp).val("");
      $("#funcionario-bairro"+temp).val("");
      $("#funcionario-cidade-uf"+temp).val("");
    }else{
      buscaCep(cep, temp);
    }
    
  });

  $("#funcionario-foto, #funcionario-foto-at").fileinput({
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
    url:"../manter.php",                    
    type:"post",                            
    data: "cep="+cep+"&acao="+acao+"&tipoAcao="+tipoAcao,
    dataType: "JSON",
    success: function (result){ 
      console.log(result);

      if (result.status == 500 && result.qtd == 0) {
        $('#loadCep'+temp).hide();
        $("#funcionario-rua"+temp).val("");
        $("#funcionario-bairro"+temp).val("");
        $("#funcionario-cidade-uf"+temp).val("");

        toastr.options.progressBar = true;
        toastr.options.closeButton = true;
        toastr.success(result.result);

      }else{
        $('#loadCep'+temp).hide();
        $("#funcionario-rua"+temp).val(result.dados.logradouro);
        $("#funcionario-bairro"+temp).val(result.dados.bairro);
        $("#funcionario-cidade-uf"+temp).val(result.dados.cidade+'-'+result.dados.uf);
      }

    }
  });
}

function resetForm(form) {
  $('#'+form).each(function(){
    this.reset(); 
  });
}//ResetForm

function initTable(tableAt, tableIn, api) {
  tableAt = 
  $('#datatable-responsive').DataTable( { 
    processing: true,
    responsive: true,
    ajax: {
           url: '../manter.php',
           type: "POST",
           data : {
             acao : "manterFuncionario",
             tipoAcao: "listarAll",
             enabled: true
           },
           dataSrc: ''
         },
    columns: [
               { 
                  "render" : function(data, type, full, meta) {
                    var icone = full.user_foto_perfil;
                    return '<div class="icone-categ-div"><img src="https://api.rafafreitas.com/uploads/funcionario/'+icone+'" class="icone-categ-img"></div>'
                  } 
               },
               { data: "user_nome" },
               { data: "user_cpf" },
               { data: "user_telefone" },
               { data: "user_email" },
               { 
                 defaultContent: "<button type='button' class='btn btn-success' id='atualizar' title='Atualizar'><span class='fa fa-pencil'></button>&nbsp;"+
                                 "<button type='button' class='btn btn-danger' id='desativar' title='Desativar Funcionário'><span class='fa fa-ban'></button>"
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

  tableIn = 
  $('#datatable-responsive-in').DataTable( { 
    processing: true,
    responsive: true,
    ajax: {
           url: '../manter.php',
           type: "POST",
           data : {
             acao : "manterFuncionario",
             tipoAcao: "listarAll",
             enabled: false
           },
           dataSrc: ''
         },
    columns: [
               { 
                  "render" : function(data, type, full, meta) {
                    var icone = full.user_foto_perfil;
                    return '<div class="icone-categ-div"><img src="https://api.rafafreitas.com/uploads/funcionario/'+icone+'" class="icone-categ-img"></div>'
                  } 
               },
               { data: "user_nome" },
               { data: "user_cpf" },
               { data: "user_telefone" },
               { data: "user_email" },
               { 
                 defaultContent: "<button type='button' class='btn btn-success' id='atualizar' title='Atualizar'><span class='fa fa-pencil'></button>&nbsp;"+
                                 "<button type='button' class='btn btn-warning' id='ativar' title='Ativar Funcionário'><span class='fa fa-check'></button>"
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
      var data = tableAt.row( $(this).parents('tr') ).data();
      var idClick = $(this).attr('id');
      switch(idClick) {
        case 'atualizar':
          updateObj(data);
          break;
        case 'desativar':
          enabledDisabled(data.user_id, tableAt, tableIn, false);
          break;
        default:
          $('#alertaErro').show();
          setTimeout(function() {
            $('#alertaErro').hide();
          }, 1000);  
      }
  });//onClick

  $('#datatable-responsive-in tbody').on( 'click', 'button', function () {
      var data = tableIn.row( $(this).parents('tr') ).data();
      var idClick = $(this).attr('id');
      switch(idClick) {
        case 'atualizar':
          updateObj(data);
          break;
        case 'ativar':
          enabledDisabled(data.user_id, tableAt, tableIn, true);
          break;
        default:
          $('#alertaErro').show();
          setTimeout(function() {
            $('#alertaErro').hide();
          }, 1000);  
      }
  });//onClick

  $('#form-funcionario-add').submit(function(){  
    //var json = jQuery(this).serialize();
    var formData = new FormData(this);
    cadastrar(formData, tableAt);
    return false;
  });//CreateForm

  $('#formAtualizar').submit(function(){
    //var json = jQuery(this).serialize();
    var formData = new FormData(this);
    var status = $("#statusAt").val();
    if (status == '1') {
      submitUp(formData, tableAt);
    }if (status == '0') {
      submitUp(formData, tableIn);
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
    url:"../manter.php",                    
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
        resetForm('form-funcionario-add');

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

function updateObj(obj, table) {
  
  $("#funcionario-foto-at").fileinput('destroy');
  
  console.log(obj);
  $('#loadPublicacao').show();
  $('#submitGif').hide();
  $('#retornoAt').hide();
  $("#idAt").val(obj.user_id);
  $("#statusAt").val(obj.user_status);
  $("#reloadAt").val('0');

  buscaCep(obj.user_cep, "-at");
  $("#funcionario-nome-at").val(obj.user_nome);
  $("#funcionario-cpf-at").val(obj.user_cpf);
  $("#funcionario-telefone-at").val(obj.user_telefone);
  $("#funcionario-data-at").val(obj.user_data);
  $("#funcionario-email-at").val(obj.user_email);
  $("#funcionario-cep-at").val(obj.user_cep);
  $("#funcionario-numero-at").val(obj.user_endereco_numero);
  $("#funcionario-complemento-at").val(obj.user_endereco_complemento);

  $("#funcionario-foto-at").fileinput({
    overwriteInitial: true,
    initialPreview: [
      "https://api.rafafreitas.com/uploads/funcionario/"+obj.user_foto_perfil
    ],
    initialPreviewConfig: [
      {
        caption: "Logo", 
        width: "120px", 
        key: 1
      },
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
    url:"../manter.php",                    
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

function enabledDisabled(idChange, tableAt, tableIn, status) {
  console.log(idChange);
  if (status) {
    stName = "ativar";
  }else{
    stName = "inativar";
  }
  bootbox.confirm({
    message: "<h3 class='text-center'>Deseja "+stName+" este funcionario?</h3>",
    buttons: {
      confirm: {
        label: 'Sim!',
        className: 'btn-success'
      },
      cancel: {
        label: 'Cancelar!',
        className: 'btn-danger'
      }
    },
    callback: function (confirma) {
      if (confirma == true) {
        $('#loadPublicacao').show();
        $.ajax({
          url:"../manter.php",                    
          type:"post",
          data: {
            acao : "manterFuncionario",
            tipoAcao : "enabledDisabled",
            status : status,
            idChange : idChange
          },                     
          dataType: "JSON",
          success: function (obj){ 
            console.log(obj);
            if(obj.status == 200){

              tableAt.ajax.reload();
              tableIn.ajax.reload();

              toastr.options.progressBar = true;
              toastr.options.closeButton = true;
              toastr.success(obj.result);

            }if (obj.status == 500){

              toastr.options.progressBar = true;
              toastr.options.closeButton = true;
              toastr.error(obj.result);
            }
          }
        });
      }else{

      }
    }//callback
  });//bootbox
}//delUser