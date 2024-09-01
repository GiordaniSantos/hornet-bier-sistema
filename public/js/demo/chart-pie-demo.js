// Set new default font family and font color to mimic Bootstrap's default styling

var dataVisitacao;
$.ajax({
  url: 'relatorio-geral-dados-visitacao',
  type: 'GET',
  async: false,
  success: function(data){
    dataVisitacao = data;
  },
  error: function(data){
    var errors = data.responseJSON;
    console.log(errors);
  }
});
// Pie Chart Example
var ctx = document.getElementById("graficoVisitacao");
var graficoVisitacao = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Crentes", "Não Crentes", "Presídios", "Enfermos", "Hospitais", "Escolas"],
    datasets: [{
      data: dataVisitacao,
      backgroundColor: ['#1cc88a', '#4e73df', '#d55b2a', '#99443b', '#f6c23e', '#85102f'],
      //hoverBackgroundColor: ['#015b41'],
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


var dataAtosPastorais;
$.ajax({
  url: 'relatorio-geral-dados-atos-pastorais',
  type: 'GET',
  async: false,
  success: function(data){
    dataAtosPastorais = data;
  },
  error: function(data){
    var errors = data.responseJSON;
    console.log(errors);
  }
});
// Pie Chart Example
var ctx = document.getElementById("graficoAtosPastorais");
var graficoAtosPastorais = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Batismos Infantis", "Batismo/Profissão de Fé", "Benções Nupciais", "Santas Ceias"],
    datasets: [{
      data: dataAtosPastorais,
      backgroundColor: ['#359d93', '#d27322', '#211f11', '#338767'],
      //hoverBackgroundColor: ['#015b41'],
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



var dataAtosPregacoes;
$.ajax({
  url: 'relatorio-geral-dados-pregacoes',
  type: 'GET',
  async: false,
  success: function(data){
    dataAtosPregacoes = data;
  },
  error: function(data){
    var errors = data.responseJSON;
    console.log(errors);
  }
});
// Pie Chart Example
var ctx = document.getElementById("graficoPregacoes");
var graficoPregacoes = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Estudos", "Sermões", "Estudos Bíblicos", "Discipulados"],
    datasets: [{
      data: dataAtosPregacoes,
      backgroundColor: ['#d15268', '#1f1956', '#d27322', '#2ddfae'],
      //hoverBackgroundColor: ['#015b41'],
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