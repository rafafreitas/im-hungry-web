$(document).ready(function(){
  
    var api;
    var tableAt;
    var tableIn;
    var tableEn;
    initTable(tableAt, tableIn, tableEn);
    initPage();
  
  });
  
  function initPage() {
    $(":input").inputmask();
    $('#valorDesconto').maskMoney({prefix:'R$ ', thousands:'.', decimal:','});
    $('#valor-at-desc').maskMoney({prefix:'R$ ', thousands:'.', decimal:','});
  
    $('#btmCancelar').click(function(){
      resetForm('form-desconto-add');
    }); 
  
  }//initPage
  
  function resetForm(form) {
    $('#'+form).each(function(){
      this.reset(); 
    });
  }//ResetForm
  
  function initTable(tableAt, tableIn, tableEn) {
    tableAt = 
    $('#datatable-responsive').DataTable( { 
      processing: true,
      responsive: true,
      ajax: {
             url: '../manter.php',
             type: "POST",
             data : {
               acao : "manterDesconto",
               tipoAcao: "listarAll",
               enabled: 2
             },
             dataSrc: ''
           },
      columns: [
                 { data: "cartao_fid_nome" },
                 { data: "cartao_fid_qtd" },
                 { 
                    "render" : function(data, type, full, meta) {
                        var valor_item = full.cartao_fid_valor.replace(".", ",");
                        return '<p>R$ '+valor_item+'</p>'
                    } 
                 },
                 { data: "data_format" },
                 { 
                   defaultContent: "<button type='button' class='btn btn-warning' id='ver' title='Ver'><span class='fa fa-eye'></button>&nbsp;"
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
               acao : "manterDesconto",
               tipoAcao: "listarAll",
               enabled: 1
             },
             dataSrc: ''
           },
      columns: [
                 { data: "cartao_fid_nome" },
                 { data: "cartao_fid_qtd" },
                 { 
                    "render" : function(data, type, full, meta) {
                        var valor_item = full.cartao_fid_valor.replace(".", ",");
                        return '<p>R$ '+valor_item+'</p>'
                    } 
                 },
                 { data: "data_format" },
                 { 
                   defaultContent: "<button type='button' class='btn btn-success' id='atualizar' title='Atualizar'><span class='fa fa-pencil'></button>&nbsp;"+
                                   "<button type='button' class='btn btn-warning' id='ativar' title='Ativar Fidelidade'><span class='fa fa-check'></button>"
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
  
    tableEn = 
    $('#datatable-responsive-en').DataTable( { 
      processing: true,
      responsive: true,
      ajax: {
             url: '../manter.php',
             type: "POST",
             data : {
               acao : "manterDesconto",
               tipoAcao: "listarAll",
               enabled: 3
             },
             dataSrc: ''
           },
      columns: [
                 { data: "cartao_fid_nome" },
                 { data: "cartao_fid_qtd" },
                 { 
                    "render" : function(data, type, full, meta) {
                        var valor_item = full.cartao_fid_valor.replace(".", ",");
                        return '<p>R$ '+valor_item+'</p>'
                    } 
                 },
                 { data: "data_format" },
                 { 
                   defaultContent: "<button type='button' class='btn btn-warning' id='ver' title='Ver'><span class='fa fa-eye'></button>&nbsp;"
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
          case 'ver':
            updateObj(data, false);
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
            updateObj(data, true);
            break;
          case 'ativar':
            enabledDisabled(data.cartao_fid_id, tableAt, tableIn, true);
            break;
          default:
            $('#alertaErro').show();
            setTimeout(function() {
              $('#alertaErro').hide();
            }, 1000);  
        }
    });//onClick
  
    $('#datatable-responsive-en tbody').on( 'click', 'button', function () {
        var data = tableAt.row( $(this).parents('tr') ).data();
        var idClick = $(this).attr('id');
        switch(idClick) {
          case 'ver':
            updateObj(data, false);
            break;
          default:
            $('#alertaErro').show();
            setTimeout(function() {
              $('#alertaErro').hide();
            }, 1000);  
        }
    });//onClick
  
    $('#form-desconto-add').submit(function(){  
      var json = jQuery(this).serialize();
      //var formData = new FormData(this);
      cadastrar(json, tableIn);
      return false;
    });//CreateForm
  
    $('#formAtualizarCupom').submit(function(){
      var json = jQuery(this).serialize();
      //var formData = new FormData(this);
      var status = $("#statusAt").val();
      if (status == '1') {
        submitUp(json, tableIn);
      }else{
        toastr.options.progressBar = true;
        toastr.options.closeButton = true;
        toastr.warning("Você só pode editar cartões inativos!");
      }
      return false;
    });//Update Form
  
  }//initTable
  
  function cadastrar(json, table) {
    $('#loadPublicacao').show();
    var acao = 'manterDesconto';
    var tipoAcao = 'insert';
    $.ajax({
      url:"../manter.php",                    
      type:"post",                            
      data: json+"&acao="+acao+"&tipoAcao="+tipoAcao,
      dataType: "JSON",
      success: function (result){   
        console.log(result);
        if(result.status == 200){   
  
          $('#loadPublicacao').hide();
          table.ajax.reload();
          resetForm('form-funcionario-add');
  
          toastr.options.progressBar = true;
          toastr.options.closeButton = true;
          toastr.success(result.result);
  
        }if(result.status == 500){
          $('#loadPublicacao').hide();
          toastr.options.progressBar = true;
          toastr.options.closeButton = true;
          toastr.error(result.result);
        }  
      }//success
    });//ajax
    return false;
  }//cadastrar
  
  function updateObj(obj, flag) {
    
    console.log(obj);
    if (!flag) {
      
      
      $("#valor-at-desc").prop("disabled", true);
      $("#validade-at-desc").prop("disabled", true);
      $("#beneficio-at-desc").prop("disabled", true);
    }else{
      $("#valor-at-desc").prop("disabled", false);
      $("#validade-at-desc").prop("disabled", false);
      $("#beneficio-at-desc").prop("disabled", false);
    }
    
    $('#loadPublicacao').show();
    $('#submitGif').hide();
    $('#retornoAt').hide();
    $("#idAt").val(obj.cartao_fid_id);
    $("#statusAt").val(obj.cartao_fid_status);
    $("#reloadAt").val('0');
  
    
    
    $("#valor-at-desc").val(obj.cartao_fid_valor.replace(".", ","));
    $("#validade-at-desc").val(obj.cartao_fid_date);
    $("#beneficio-at-desc").val(obj.cartao_fid_beneficio);
  
    $("#myModalAtualizar").modal({backdrop: false});
    $('#loadPublicacao').hide();
  }//updateObj
  
  function submitUp(json, table) {
    var acao = 'manterDesconto';
    var tipoAcao = 'update';
    $('#submitGif').show();
    $('#retornoAt').hide();
    $.ajax({
      url:"../manter.php",                    
      type:"post",                            
      data: json+"&acao="+acao+"&tipoAcao="+tipoAcao,
      dataType: "JSON",
      success: function (obj){ 
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
      message: "<h3 class='text-center'>Deseja "+stName+" este cartão?</h3>",
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
              acao : "manterDesconto",
              tipoAcao : "enabledDisabled",
              status : 2,
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