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
  $('#item-valor').maskMoney({prefix:'R$ ', thousands:'.', decimal:','});
  $('#item-valor-at').maskMoney({prefix:'R$ ', thousands:'.', decimal:','});

  $('#loadPublicacao').hide();
  $('#btmCancelar').click(function(){
    resetForm('form-company-add');
  }); 

  $("#upFilesFotos").fileinput({
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

function initTable(tableAt, tableIn, api) {
  tableAt = 
  $('#datatable-responsive').DataTable( { 
    processing: true,
    responsive: true,
    ajax: {
           url: '../manter.php',
           type: "POST",
           data : {
             acao : "manterMenu",
             tipoAcao: "listarAll",
             enabled: true
           },
           dataSrc: ''
         },
    columns: [
               { 
                  "render" : function(data, type, full, meta) {
                    var icone = full.fotos[0].fot_file;
                    return '<div class="icone-categ-div"><img src="https://api.rafafreitas.com/uploads/itens/'+icone+'" class="icone-categ-img"></div>'
                  } 
               },
               { data: "item_nome" },
               { 
                  "render" : function(data, type, full, meta) {
                      var valor_item = full.item_valor.replace(".", ",");
                      return '<p>R$ '+valor_item+'</p>'
                  } 
               },
               { data: "item_tempo_medio" },
               { 
                 defaultContent: "<button type='button' class='btn btn-success' id='atualizar' title='Atualizar'><span class='fa fa-pencil'></button>&nbsp;"+
                                 "<button type='button' class='btn btn-warning' id='imagens' title='Atualizar Imagens'><span class='fa fa-picture-o'></button>&nbsp;"+
                                 "<button type='button' class='btn btn-danger' id='apagar' title='Desativar'><span class='fa fa-ban'></button>"
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
             acao : "manterMenu",
             tipoAcao: "listarAll",
             enabled: false
           },
           dataSrc: ''
         },
    columns: [
               { 
                  "render" : function(data, type, full, meta) {
                    var icone = full.fotos[0].fot_file;
                    return '<div class="icone-categ-div"><img src="https://api.rafafreitas.com/uploads/itens/'+icone+'" class="icone-categ-img"></div>'
                  } 
               },
               { data: "item_nome" },
               { 
                  "render" : function(data, type, full, meta) {
                      var valor_item = full.item_valor.replace(".", ",");
                      return '<p>R$ '+valor_item+'</p>'
                  } 
               },
               { data: "item_tempo_medio" },
               { 
                 defaultContent: "<button type='button' class='btn btn-success' id='atualizar' title='Atualizar'><span class='fa fa-pencil'></button>&nbsp;"+
                                 "<button type='button' class='btn btn-warning' id='imagens' title='Atualizar Imagens'><span class='fa fa-picture-o'></button>&nbsp;"+
                                 "<button type='button' class='btn btn-info' id='ativar' title='Ativar'><span class='fa fa-check'></button>"
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
            updateObj(data, tableAt);
            break;
        case 'imagens':
            updateImg(data, tableAt);
            break;
        case 'apagar':
            enabledDisabled(data.item_id, tableAt, tableIn, false);
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
            updateObj(data, tableIn);
            break;
        case 'imagens':
            updateImg(data, tableIn);
            break;
        case 'ativar':
            enabledDisabled(data.item_id, tableAt, tableIn, true);
            break;
        default:
            $('#alertaErro').show();
              setTimeout(function() {
              $('#alertaErro').hide();
            }, 1000);  
      }
  });//onClick

  $('#form-item-add').submit(function(){  
    //var json = jQuery(this).serialize();
    var formData = new FormData(this);
    cadastrar(formData, tableAt);
    return false;
  });//CreateForm

  $('#formAtualizar').submit(function(){
    var json = jQuery(this).serialize();
    //var formData = new FormData(this);
    var status = $("#statusAt").val();
    if (status == '1') {
      submitUp(json, tableAt);
    }if (status == '0') {
      submitUp(json, tableIn);
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
        resetForm('form-item-add');

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
  $('#loadPublicacao').show();
  $('#submitGif').hide();
  $('#retornoAt').hide();
  $("#idAt").val(obj.item_id);
  $("#statusAt").val(obj.item_status);
  $("#reloadAt").val('0');

  $("#item-nome-at").val(obj.item_nome);
  $("#item-valor-at").val(obj.item_valor.replace(".", ","));
  $("#item-tempo-at").val(obj.item_tempo_medio);
  if (obj.item_promocao == "1"){$("#item-promo-at").val('true');}
  if (obj.item_promocao == "0"){$("#item-promo-at").val('false');}

  $("#myModalAtualizar").modal({backdrop: false});
  $('#loadPublicacao').hide();
}//updateObj

function updateImg(obj, table){
  $("#upFilesFotos-at").fileinput('destroy');

  var initialPreview = [];
  var initialPreviewConfig = [];
  var aux, temp = 0

  $.each(obj.fotos, function(key, value) {  
    initialPreview.push("https://api.rafafreitas.com/uploads/itens/"+value.fot_file); 
    initialPreviewConfig.push({ 
      caption: value.fot_file, 
      size: 762980, 
      url: 'manter.php', 
      key: value.fot_id, 
      extra:  {
        acao: 'manterMenu', 
        tipoAcao: 'delImage',
        fot_id: value.fot_id, 
        item_id: value.item_id, 
        flag : false
      } 
    }
    );
  });

  $("#upFilesFotos-at").fileinput({
    overwriteInitial: false,
    minFileCount: 1,
    initialPreview,
    initialPreviewConfig,
    initialPreviewAsData: true, 
    initialPreviewFileType: 'image', 

    uploadUrl: 'manter.php',
    uploadExtraData: {acao:'manterMenu', tipoAcao: 'addImage', id: obj.item_id},
    language: "pt-BR",
    'showUpload':true, 
    allowedFileExtensions: ["jpg", "gif", "png"],
    maxFilePreviewSize: 10240
  }).on('fileuploaded', function(event, data, id, index) {

    temp++;
    if (temp == 1) {aux = $("#upFilesFotos-at").fileinput("getFilesCount");}
    if (temp == aux) {
      temp = 0;
      toastr.options.progressBar = true;
      toastr.options.closeButton = true;
      toastr.success(data.response.result);
      table.ajax.reload();
    }
    
  }).on('filepredelete', function (event, key, data, extra) {
    
    var abort = true;
    $.ajax({
      async: false,
      url:"manter.php",                    
      type:"post",
      data: {
        acao : extra.acao,
        tipoAcao : extra.tipoAcao,
        item_id : extra.item_id,
        fot_id : extra.fot_id,
        flag : true
      },                     
      dataType: "JSON",
      success: function (obj){ 
        console.log(obj);
        if(obj.status == 200){

          table.ajax.reload();
          toastr.options.progressBar = true;
          toastr.options.closeButton = true;
          toastr.success(obj.result);
          abort = false;

        }if (obj.status == 500){

          toastr.options.progressBar = true;
          toastr.options.closeButton = true;
          toastr.error(obj.result);
          abort = true;

        }
      }
    });

    return abort;

  });

  $("#myModalImagens").modal({backdrop: false});
}

function submitUp(json, table) {
  var acao = 'manterMenu';
  var tipoAcao = 'update';
  $('#submitGif').show();
  $('#retornoAt').hide();
  $.ajax({
    url:"manter.php",                    
    type:"post",                            
    data: json+"&acao="+acao+"&tipoAcao="+tipoAcao,
    dataType: "JSON",
    success: function (result){ 
      console.log(result);
      if(result.status == 200){
        $('#submitGif').hide();
        $('#retornoAt').show();
        $("#reloadAt").val('1');
        table.ajax.reload();
        toastr.options.progressBar = true;
        toastr.options.closeButton = true;
        toastr.success(result.result);

      }if (result.status == 500){
        $('#submitGif').hide();
        toastr.options.progressBar = true;
        toastr.options.closeButton = true;
        toastr.error(result.result);
      }
    }//success
  });//ajax
  return false;
}//submitUp

function enabledDisabled(idChange, tableAt, tableIn, status) {
  if (status) {
    stName = "ativar";
  }else{
    stName = "inativar";
  }
  bootbox.confirm({
    message: "<h3 class='text-center'>Deseja "+stName+" este item do menu?</h3>",
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
          url:"manter.php",                    
          type:"post",
          data: {
            acao : "manterMenu",
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