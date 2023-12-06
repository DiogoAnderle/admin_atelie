
/*===========================
      Sidebar menu
=============================*/
$('.sidebar-menu').tree()

/*===========================
      Datatables
=============================*/
$('.tabelas').DataTable({
      "responsive": true,
      "language": {
            "decimal": ",",
            "thousands": ".",
            "processing": "Processando...",
            "loadingRecords": "Carregando...",
            "lengthMenu": "Mostrar _MENU_ registros",
            "search": "Pesquisar",
            "zeroRecords": "Desculpe, nada encontrado",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "Nenhum registro disponível",
            "infoFiltered": "(filtrados de um total de _MAX_ registros)",
            "paginate": {
                  "first": "Primeira",
                  "last": "Última",
                  "next": "Próxima",
                  "previous": "Anterior"
            },
            "aria": {
                  "sortAscending": ": ative para ordenar a coluna ascendente",
                  "sortDescending": ": ative para ordenar a coluna descendente"
            }
      }
});


/*=============================================
      iCheck for checkbox and radio inputs
===============================================*/
$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue',
})

/*=============================================
      InputMask
===============================================*/
//DateMask
$("#datemask").inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });


/***************************************
Máscara campo telefone
***************************************/
const handlePhone = (event) => {
      let input = event.target
      input.value = phoneMask(input.value)
}

const phoneMask = (value) => {
      if (!value) return ""
      value = value.replace(/\D/g, '')
      value = value.replace(/(\d{2})(\d)/, "($1) $2")
      value = value.replace(/(\d)(\d{4})$/, "$1-$2")
      return value
}
