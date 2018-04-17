var flag = false;
var array_id  = [];
$(document).ready(function(){

	var tablePen;
	var tableComp;
	var tableEnt;
	initPage();
	initTable(tablePen, tableComp, tableEnt);

});

function initPage() {

	$('#loadPublicacao').hide();
}//initPage

function initTable(tablePen, tableComp, tableEnt) {

	tablePen = 
	$('#datatable-ped-pending').DataTable( {
		processing: true,
		responsive: true,
		ajax: {
			url: 'manter.php',
			type: "POST",
			data : {
				acao : "manterPedidos",
				tipoAcao: "listarAll",
				tableStatus: 1,
			},
			dataSrc: ''
		},
		columns: [
		{
			"className":      'details-control',
			"orderable":      false,
			"data":           null,
			"defaultContent": ''
		},
		{ data: "user_nome" },
		{ 
			"render" : function(data, type, full, meta) {
				var cod_ref = full.checkout_ref.slice(-6);
				return '<p>'+cod_ref+'</p>'
			} 
		},
		{ 
			"render" : function(data, type, full, meta) {
				var valor_pedido = full.checkout_valor_bruto.replace(".", ",");
				return '<p>R$ '+valor_pedido+'</p>'
			} 
		},
		{ data: "checkout_date_format" },
		{ 
			"render" : function(data, type, full, meta) {
				var status  = (full.checkout_flag == 'E')? "Entregue" : 
				(full.checkout_flag == 'C')? "Cancelado" : 
				(full.checkout_flag == 'P')? "Pendente" : "Status Inválido" ;
				return '<p>'+status+'</p>'
			} 
		},
		{ 
			defaultContent: "<button type='button' class='btn btn-success' id='delivered' title='Entregar Pedido'><span class='fa fa-check'></button>&nbsp;"+
			"<button type='button' class='btn btn-danger' id='problem' title='Relatar Problema'><span class='fa fa-ban'></button>"
		}
		],
		fixedHeader: true,
		"language": {
			"lengthMenu": "Exibir _MENU_ por página",
			"zeroRecords": "Nada encontrado, desculpe.",
			"processing": "Buscando novos pedidos...",
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
	});

	tableComp = 
	$('#datatable-ped-completed').DataTable( {
		processing: true,
		responsive: true,
		ajax: {
			url: 'manter.php',
			type: "POST",
			data : {
				acao : "manterPedidos",
				tipoAcao: "listarAll",
				tableStatus: 2,
			},
			dataSrc: ''
		},
		columns: [
		{
			"className":      'details-control',
			"orderable":      false,
			"data":           null,
			"defaultContent": ''
		},
		{ data: "user_nome" },
		{ 
			"render" : function(data, type, full, meta) {
				var cod_ref = full.checkout_ref.slice(-6);
				return '<p>'+cod_ref+'</p>'
			} 
		},
		{ 
			"render" : function(data, type, full, meta) {
				var valor_pedido = full.checkout_valor_bruto.replace(".", ",");
				return '<p>R$ '+valor_pedido+'</p>'
			} 
		},
		{ data: "checkout_date_format" },
		{ 
			"render" : function(data, type, full, meta) {
				var status  = (full.checkout_flag == 'E')? "Entregue" : 
				(full.checkout_flag == 'C')? "Cancelado" : 
				(full.checkout_flag == 'P')? "Pendente" : "Status Inválido" ;
				return '<p>'+status+'</p>'
			} 
		},
		{ 
			defaultContent: "<button type='button' class='btn btn-success' id='delivered' title='Entregar Pedido'><span class='fa fa-check'></button>&nbsp;"+
			"<button type='button' class='btn btn-danger' id='problem' title='Relatar Problema'><span class='fa fa-ban'></button>"
		}
		],
		fixedHeader: true,
		"language": {
			"lengthMenu": "Exibir _MENU_ por página",
			"zeroRecords": "Nada encontrado, desculpe.",
			"processing": "Buscando novos pedidos...",
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
	});

	tableEnt =
	$('#datatable-ped-delivered').DataTable( {
		processing: true,
		responsive: true,
		ajax: {
			url: 'manter.php',
			type: "POST",
			data : {
				acao : "manterPedidos",
				tipoAcao: "listarAll",
				tableStatus: 3,
			},
			dataSrc: ''
		},
		columns: [
		{
			"className":      'details-control',
			"orderable":      false,
			"data":           null,
			"defaultContent": ''
		},
		{ data: "user_nome" },
		{ 
			"render" : function(data, type, full, meta) {
				var cod_ref = full.checkout_ref.slice(-6);
				return '<p>'+cod_ref+'</p>'
			} 
		},
		{ 
			"render" : function(data, type, full, meta) {
				var valor_pedido = full.checkout_valor_bruto.replace(".", ",");
				return '<p>R$ '+valor_pedido+'</p>'
			} 
		},
		{ data: "checkout_date_format" },
		{ 
			"render" : function(data, type, full, meta) {
				var status  = (full.checkout_flag == 'E')? "Entregue" : 
				(full.checkout_flag == 'C')? "Cancelado" : 
				(full.checkout_flag == 'P')? "Pendente" : "Status Inválido" ;
				return '<p>'+status+'</p>'
			} 
		},
		{ 
			defaultContent: "<button type='button' class='btn btn-danger' id='problem' title='Relatar Problema'><span class='fa fa-ban'></button>"
		}
		],
		fixedHeader: true,
		"language": {
			"lengthMenu": "Exibir _MENU_ por página",
			"zeroRecords": "Nada encontrado, desculpe.",
			"processing": "Buscando novos pedidos...",
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
	});

	$('#datatable-ped-pending tbody').on( 'click', 'button', function () {
		var data = tablePen.row( $(this).parents('tr') ).data();
		var idClick = $(this).attr('id');
		switch(idClick) {
			case 'delivered':
			delivered(data);
			break;
			case 'problem':
			toastr.options.progressBar = true;
			toastr.options.closeButton = true;
			toastr.info("Esta opção ainda será implementada!");
			break;
			default:
			toastr.options.progressBar = true;
			toastr.options.closeButton = true;
			toastr.danger("Opção desconhecida!");
		}
	});

	$('#datatable-ped-delivered tbody').on( 'click', 'button', function () {
		var data = tablePen.row( $(this).parents('tr') ).data();
		var idClick = $(this).attr('id');
		switch(idClick) {
			case 'problem':
			toastr.options.progressBar = true;
			toastr.options.closeButton = true;
			toastr.info("Esta opção ainda será implementada!");
			break;
			default:
			toastr.options.progressBar = true;
			toastr.options.closeButton = true;
			toastr.danger("Opção desconhecida!");
		}
	});

	$('#datatable-ped-pending tbody').on('click', 'td.details-control', function () {
		var data = tablePen.row( $(this).parents('tr') ).data();
		var tr = $(this).closest('tr');
		var row = tablePen.row(tr);

		if ( row.child.isShown() ) {
			row.child.hide();
			tr.removeClass('shown');
		}
		else {

			row.child( tableChild(row.data(), data.itens)).show();
			tr.addClass('shown');

		}
	});

}//initTable

function tableChild (d,obj) {
	console.log(d);
	console.log(obj);
	var historicoPed = "";

	$.each(obj, function(key, value) {  
		console.log(value);
		var vaorTemp = value.checkout_item_valor.replace(".", ",");
		historicoPed += '<tr class="trBody">';
		historicoPed += '<td><img src="https://api.rafafreitas.com/uploads/itens/'+value.fotos[0].fot_file+'" class="icone-categ-img"></td>';
		historicoPed += '<td>'+value.item_nome+'</td>';
		historicoPed += '<td>R$'+value.checkout_item_valor.replace(".", ",")+'</td>';
		historicoPed += '<td>'+value.checkout_item_qtd+'</td>';
		historicoPed += '</tr>';
	});

	return '<div class="divTable">'+
	'<h4 class="text-center">Pedido: #-'+d.checkout_ref.slice(-6)+'</h4>'+
	'<h4 class="text-center">Cliente: '+d.user_nome+'</h4>'+
	'<table class="tabelaDinamica">'+
	'<tr class="trDetalhes">'+
	'<td>Imagem</td>'+
	'<td>Produto</td>'+
	'<td>Preço da Venda</td>'+
	'<td>Quantidade</td>'+
	'</tr>'+historicoPed+

	'</table>'+
	'<br>'+
	'</div>';

	// `d` is the original data object for the row
}
