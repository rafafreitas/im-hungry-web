$(document).ready(function(){
  
  var api;
  $.get("../_db/url.php", function(result) { api = JSON.parse(result)});

    initPage(1, $.brandPrimary);
    initPage(2, $.brandSuccess);
    initPage(3, $.brandWarning);


});

function initPage(id, tema) {

  var labels = ['Jeneiro','Fevereiro','Março','Abril','Maio','Junho','Julho'];
  var data = {
    labels: labels,
    datasets: [
      {
        label: 'Total de Pedidos',
        backgroundColor: tema,
        borderColor: 'rgba(255,255,255,.55)',
        data: [65, 59, 84, 84, 51, 55, 40]
      },
    ]
  };
  var options = {
    maintainAspectRatio: false,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        gridLines: {
          color: 'transparent',
          zeroLineColor: 'transparent'
        },
        ticks: {
          fontSize: 2,
          fontColor: 'transparent',
        }

      }],
      yAxes: [{
        display: false,
        ticks: {
          display: false,
          min: Math.min.apply(Math, data.datasets[0].data) - 5,
          max: Math.max.apply(Math, data.datasets[0].data) + 5,
        }
      }],
    },
    elements: {
      line: {
        borderWidth: 1
      },
      point: {
        radius: 4,
        hitRadius: 10,
        hoverRadius: 4,
      },
    }
  };
  var ctx = $('#card-chart'+id);
  var cardChart1 = new Chart(ctx, {
    type: 'line',
    data: data,
    options: options
  });


}//initPage

