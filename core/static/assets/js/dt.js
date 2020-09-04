function currencyFormatDE(num) {
   return (
     num
       .toFixed(0) // always two decimal digits
       .replace('.', ',') // replace decimal point character with ,
       .replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
   ) // use . as a separator
 }

$.extend( true, $.fn.dataTable.defaults, {
    language: {
       "sEmptyTable": "Nincs rendelkezésre álló adat",
       "sInfo": "Találatok: _START_ - _END_ Összesen: _TOTAL_",
       "sInfoEmpty": "Nulla találat",
       "sInfoFiltered": "(_MAX_ összes rekord közül szűrve)",
       "sInfoPostFix": "",
       "sInfoThousands": " ",
       "sLengthMenu": "_MENU_ találat oldalanként",
       "sLoadingRecords": "Betöltés...",
       "sProcessing": "Feldolgozás...",
       "sSearch": "Keresés:",
       "sZeroRecords": "Nincs a keresésnek megfelelő találat",
       "oPaginate": {
           "sFirst": "Első",
           "sPrevious": "Előző",
           "sNext": "Következő",
           "sLast": "Utolsó"
       },
       "oAria": {
           "sSortAscending": ": aktiválja a növekvő rendezéshez",
           "sSortDescending": ": aktiválja a csökkenő rendezéshez"
       },
       "select": {
           "rows": {
               "_": "%d sor kiválasztva",
               "0": "",
               "1": "1 sor kiválasztva"
           }
       },
       "buttons": {
           "print": "Nyomtatás",
           "colvis": "Oszlopok",
           "copy": "Másolás",
           "copyTitle": "Vágólapra másolás",
           "copySuccess": {
               "_": "%d sor másolva",
               "1": "1 sor másolva"
           }
       }
    },
    processing: true,
    pagingType: 'full_numbers',
    select: true,
    scrollY: 400,
    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Mind"]],
    dom: 'B<"clear">lfrtip',
    buttons: [
              {
                extend:    'copyHtml5',
                text:      '<i class="fas fa-copy"></i>',
                titleAttr: 'Másolás',
                 exportOptions: {
                     columns: [ ':visible' ]
                 },
              },

              {
                  extend: 'csvHtml5',
                  text: '<i class="fas fa-file-csv"></i>',
                  titleAttr: 'CSV',
                  exportOptions: {
                      columns: [ ':visible' ]
                  },
              },
              {
                  extend: 'excelHtml5',
                  text: '<i class="fas fa-file-excel"></i>',
                  titleAttr: 'Excel',
                  exportOptions: {
                      columns: [ ':visible' ]
                  },
              },
              {
                  extend: 'pdfHtml5',
                  text:      '<i class="fas fa-file-pdf"></i>',
                  titleAttr: 'PDF',
                  exportOptions: {
                      columns: [ ':visible' ]
                  },
              }
          ],

});
