// Set new default font family and font color to mimic Bootstrap's default styling

var dataOSPorCliente;
$.ajax({
  url: 'relatorio-os-por-cliente',
  type: 'GET',
  async: false,
  success: function(data){
    dataOSPorCliente = data;
  },
  error: function(data){
    var errors = data.responseJSON;
    console.log(errors);
  }
});
// Pie Chart Example
var ctx = document.getElementById("graficoOrdemServicoPorCliente");
var graficoOrdemServicoPorCliente = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: dataOSPorCliente.labels,
    datasets: [{
      data: dataOSPorCliente.quantidades,
      backgroundColor: ['#d55b2a', '#4e73df', '#1cc88a', '#99443b', '#f6c23e', '#85102f'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});