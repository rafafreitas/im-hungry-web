$(document).ready(function(){
  
  var api;
  var tableAt;
  var tableIn;
  $.get("../_db/url.php", function(result) { api = JSON.parse(result)});
  initTable(tableAt, tableIn, api);
  initPage();

});

function initPage() {
  


}//initPage

function initTable(tableAt, tableIn, api) {
  tableAt = 
  $('#datatable-responsive').DataTable( {	
    processing: true,
    responsive: true,
    ajax: {
           url: 'manter.php',
           type: "POST",
           data : {
             acao : "manterPedidos",
             tipoAcao: "listarAll"
             
           },
           dataSrc: ''
         },
    columns: [
               { data: "empresa_nome" },
               { data: "empresa_cnpj" },
               { data: "empresa_telefone" },
               { 
                 defaultContent: "<button type='button' class='btn btn-success' id='atualizar' title='Atualizar'><span class='fa fa-pencil'></button>&nbsp;"+
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

	$('#datatable-responsive tbody').on( 'click', 'button', function () {
	    var data = tableAt.row( $(this).parents('tr') ).data();
	    var idClick = $(this).attr('id');
	    switch(idClick) {
	      case 'atualizar':
	          updateObj(data);
	          break;
	      case 'apagar':
	          enabledDisabled(data.empresa_id, tableAt, tableIn, false);
	          break;
	      default:
	          $('#alertaErro').show();
	            setTimeout(function() {
	            $('#alertaErro').hide();
	          }, 1000);  
	    }
	});//onClick

}//initTable

