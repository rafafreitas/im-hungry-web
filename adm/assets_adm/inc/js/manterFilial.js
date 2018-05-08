$(document).ready(function(){
  
  var api;
  var tableAt;
  var tableIn;
  $.get("../_db/url.php", function(result) { api = JSON.parse(result)});
  initTable(tableAt, tableIn, api);
  initPage();
  createSelect();

});

function initPage() {
  $(":input").inputmask();
  $('#loadPublicacao').hide();
  $('#btmCancelar').click(function(){
    resetForm('form-company-add');
  }); 

  $("#company-cep, #company-cep-at").keyup(function() {
    $('#loadCep'+temp).show();
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
        toastr.warning(result.result);

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
}//buscaCep

function createSelect(){
  $("#empresa_id").empty();
  $("#empresa_idAt").empty();
  $.ajax({
    url:"manter.php",                    
    type:"post",
    data: {
      acao : "manterEmpresa",
      tipoAcao : "listarAll",
      enabled : "true"
    },                        
    dataType: "JSON",

    success: function (result){ 
      $('select#empresa_id').append($("<option></option>").attr({value:"", disabled:"", selected:""}).text("---")); 
      $('select#empresa_idAt').append($("<option></option>").attr({value:"", disabled:"", selected:""}).text("---")); 
      $.each(result, function(key, value) {   
        $('select#empresa_id')
          .append($("<option></option>")
          .attr({value:value.empresa_id})
          .text(value.empresa_nome)); 
      });
      $.each(result, function(key, value) {  
        $('select#empresa_idAt')
          .append($("<option></option>")
          .attr({value:value.empresa_id})
          .text(value.empresa_nome)); 
      });
    }
  });
}//createSelect

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
           url: 'manter.php',
           type: "POST",
           data : {
             acao : "manterFilial",
             tipoAcao: "listarAll",
             enabled: true
           },
           dataSrc: ''
         },
    columns: [
               { data: "empresa_nome" },
               { data: "filial_nome" },
               { data: "filial_cnpj" },
               { data: "filial_telefone" },
               { 
                 defaultContent: "<button type='button' class='btn btn-success' id='atualizar' title='Atualizar'><span class='fa fa-pencil'></button>&nbsp;"+
                                 "<button type='button' class='btn btn-info' id='menu' title='Menu da filial'><span class='fa fa-list-ol'></button>&nbsp;"+
                                 "<button type='button' class='btn btn-danger' id='apagar' title='Desativar'><span class='fa fa-ban'></button>&nbsp;"+
                                 "<button type='button' class='btn btn-primary' id='fidelidade' title='Fidelidade'><span class='fa fa-handshake-o'></button>"
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
           url: 'manter.php',
           type: "POST",
           data : {
             acao : "manterFilial",
             tipoAcao: "listarAll",
             enabled: false
           },
           dataSrc: ''
         },
    columns: [
               { data: "empresa_nome" },
               { data: "filial_nome" },
               { data: "filial_cnpj" },
               { data: "filial_telefone" },
               { 
                 defaultContent: "<button type='button' class='btn btn-success' id='atualizar' title='Atualizar'><span class='fa fa-pencil'></button>&nbsp;"+
                                 "<button type='button' class='btn btn-info' id='menu' title='Menu da filial'><span class='fa fa-list-ol'></button>&nbsp;"+
                                 "<button type='button' class='btn btn-warning' id='ativar' title='Ativar'><span class='fa fa-check'></button>&nbsp;"+
                                 "<button type='button' class='btn btn-primary' id='fidelidade' title='Fidelidade'><span class='fa fa-handshake-o'></button>"
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
        case 'fidelidade':
            setFidelidade(data);
            break;
        case 'menu':
            window.location = "menu.php?id="+data.filial_id;
            break;
        case 'apagar':
            enabledDisabled(data.filial_id, tableAt, tableIn, false);
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
        case 'menu':
            window.location = "menu.php?id="+data.filial_id;
            break;
        case 'ativar':
            enabledDisabled(data.filial_id, tableAt, tableIn, true);
            break;
        default:
            $('#alertaErro').show();
              setTimeout(function() {
              $('#alertaErro').hide();
            }, 1000);  
      }
  });//onClick

  $('#form-filial-add').submit(function(){  
    //var json = jQuery(this).serialize();
    var formData = new FormData(this);
    cadastrar(formData, tableIn);
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

  $('#formFidelidade').submit(function(){
    var json = jQuery(this).serialize();
    //var formData = new FormData(this);
    var status = $("#idFidelidade").val();
    if (status == "") {
      submitFidelidade(json, "insert");
    }else {
      submitFidelidade(json, "remove");
    }
    return false;
  });//formFidelidade

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
        resetForm('form-filial-add');

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

  console.log(obj);

  $('#loadPublicacao').show();
  $('#submitGif').hide();
  $('#retornoAt').hide();
  $("#idAt").val(obj.filial_id);
  $("#statusAt").val(obj.filial_enabled);
  $("#reloadAt").val('0');

  buscaCep(obj.filial_cep, "-at");
  $("#empresa_idAt").val(obj.empresa_id);
  $("#company-nome-at").val(obj.filial_nome);
  $("#company-telefone-at").val(obj.filial_telefone);
  $("#company-cnpj-at").val(obj.filial_cnpj);
  $("#company-cep-at").val(obj.filial_cep);
  $("#company-numero-at").val(obj.filial_numero_endereco);
  $("#company-complemento-at").val(obj.filial_complemento_endereco);
  
  $("#myModalAtualizar").modal({backdrop: false});
  $('#loadPublicacao').hide();
}//updateObj

function setFidelidade(obj){
  console.log(obj);

  $('#loadtGifFidelidade').hide();
  $('#retornoFid').hide();

  $("#idFidelidade").val(obj.cartao_fid_id);
  $("#idFilial").val(obj.filial_id);

  $("#fidelidade-qtd").val(obj.cartao_fid_qtd);
  $("#fidelidade-valor").val(obj.cartao_fid_valor);
  $("#fidelidade-beneficio").val(obj.cartao_fid_beneficio);

  if(obj.cartao_fid_id != null) {
    $("#btnFidelidade").text("Finalizar");
    $("#h3-title-md-fidelidade").text("Finalizar Fidelidade na Filial");
    $("#fidelidade-qtd").prop( "disabled", true );
    $("#fidelidade-valor").prop( "disabled", true );
    $("#fidelidade-beneficio").prop( "disabled", true );
  }else{
    $("#btnFidelidade").text("Salvar");
    $("#h3-title-md-fidelidade").text("Cadastrar Fidelidade na Filial");
    $("#fidelidade-qtd").prop( "disabled", false );
    $("#fidelidade-valor").prop( "disabled", false );
    $("#fidelidade-beneficio").prop( "disabled", false );
  }

  $("#myModalFidelidade").modal({backdrop: false});
  
}//setFidelidade

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

function submitFidelidade(json, tomada) {
  $('#loadtGifFidelidade').show();
  $('#retornoFid').hide();
  
  var acao = 'manterFilial';
  var tipoAcao = 'fidelidade';

  $.ajax({
    url:"manter.php",                    
    type:"post",                            
    data: json+"&acao="+acao+"&tipoAcao="+tipoAcao+"&tomada="+tomada,
    dataType: "JSON",
    cache: false,
    success: function (result){   
      var obj = JSON.parse(result);
      console.log(obj);
      console.log(obj.status);
      if(obj.status == 200){   

        $('#loadtGifFidelidade').hide();
        //resetForm('formAtualizar');

        toastr.options.progressBar = true;
        toastr.options.closeButton = true;
        toastr.success(obj.result);

      }if(obj.status == 500){
        $('#loadtGifFidelidade').hide();
        toastr.options.progressBar = true;
        toastr.options.closeButton = true;
        toastr.error(obj.result);
      }  
    }//success
  });//ajax
  console.log(data);
  return false;
}//submitFidelidade

function enabledDisabled(idChange, tableAt, tableIn, status) {
  if (status) {
    stName = "ativar";
  }else{
    stName = "inativar";
  }
  bootbox.confirm({
    message: "<h3 class='text-center'>Deseja "+stName+" esta filial?</h3>",
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
            acao : "manterFilial",
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