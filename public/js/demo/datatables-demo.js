
// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable({
    "language": {
      "lengthMenu": "Mostrando _MENU_ por página",
      "zeroRecords": "Nenhum resultado encontrado",
      "info": "Mostrando página _PAGE_ de _PAGES_",
      "infoEmpty": "Nenhum registro encontrado",
      "infoFiltered": "(filtrado de _MAX_ registros totais)",
      "search": "Pesquisar",
      "paginate": {
        "previous": "Anterior",
        "next": "Próximo"
      }
    },
    "order": [[0, "desc"]]
  });
});
