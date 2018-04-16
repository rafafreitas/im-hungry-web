var flag = false;
var array_id  = [];
$(document).ready(function(){

	var tablePen;
	var tableEnt;
	initPage();
	initTable(tablePen, tableEnt);

});

function initPage() {

	$('#loadPublicacao').hide();
}//initPage

function initTable(tablePen, tableEnt) {

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
				tableStatus: "P",
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
		{ data: "checkout_ref_format" },
		{ 
			"render" : function(data, type, full, meta) {
				var valor_pedido = full.checkout_valor_bruto.replace(".", ",");
				return '<p>R$ '+valor_pedido+'</p>'
			} 
		},
		{ data: "checkout_date_format" },
		{ 
			"render" : function(data, type, full, meta) {
				var status  = (full.status_pedido == 'E')? "Entregue" : 
				(full.status_pedido == 'C')? "Cancelado" : 
				(full.status_pedido == 'P')? "Pendente" : "Status Inválido" ;
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
				tableStatus: "E",
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
		{ data: "checkout_ref_format" },
		{ 
			"render" : function(data, type, full, meta) {
				var valor_pedido = full.checkout_valor_bruto.replace(".", ",");
				return '<p>R$ '+valor_pedido+'</p>'
			} 
		},
		{ data: "checkout_date_format" },
		{ 
			"render" : function(data, type, full, meta) {
				var status  = (full.status_pedido == 'E')? "Entregue" : 
				(full.status_pedido == 'C')? "Cancelado" : 
				(full.status_pedido == 'P')? "Pendente" : "Status Inválido" ;
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

	$('#datatable-ped-active tbody').on('click', 'td.details-control', function () {
		var data = tablePen.row( $(this).parents('tr') ).data();
		var tr = $(this).closest('tr');
		var row = tablePen.row(tr);

		if ( row.child.isShown() ) {
			row.child.hide();
			tr.removeClass('shown');
		}
		else {
			openChild(data.id_pedido, row, tr);
		}
	});

	function openChild(id_pedido, row, tr){
		$('#alertaRecor').show();
		var acao = 'manterPedidos';
		var tipoAcao = 'moreInfo';
		$.post("manter.php",
		{
			acao: acao,
			tipoAcao: tipoAcao,
			id: id_pedido
		}, 
		function(result)
		{
			var obj = JSON.parse(result)
			row.child( format(row.data(), obj)).show();
			tr.addClass('shown');
			$('#alertaRecor').hide();
		});
	}

}//initTable

function format (d,obj) {
	console.log(d);
	console.log(obj);
	var historicoPed = "";

	$.each(obj, function(key, value) {  
		historicoPed += '<tr>';
		historicoPed += '<td><img src="../_files/produtos/'+value.foto_prod+'" class="icone-categ-img"></td>';
		historicoPed += '<td>'+value.nome_prod+'</td>';
		historicoPed += '<td>'+value.desc_produto+'</td>';
		historicoPed += '<td>R$'+value.preco_hist_ped+'</td>';
		historicoPed += '<td>'+value.qtd_hist_ped+'</td>';
		historicoPed += '</tr>';
	});

	return '<div class="divTable">'+
	'<h4>Pedido: #-'+d.id_pedido+'</h4>'+
	'<h4>Comprador: '+d.nome_usu+'</h4>'+
	'<table class="tabelaDinamica">'+
	'<tr class="trDetalhes">'+
	'<td></td>'+
	'<td>Produto</td>'+
	'<td>Descrição</td>'+
	'<td>Preço da Venda</td>'+
	'<td>Quantidade</td>'+
	'</tr>'+historicoPed+

	'</table>'+
	'<br>'+
	'</div>';

	// `d` is the original data object for the row
}
