$(document).ready(function() {
    setTimeout(function() {

        // [ Simple Initialization ]
        $('#single-select').DataTable({
            select: true
        });

        // [ Multi Item Selection ]
        $('#multi-select').DataTable({
            select: {
                style: 'multi'
            }
        });

        // [ Cell Selection ]
        $('#cell-select').DataTable({
            select: {
                style: 'os',
                items: 'cell'
            }
        });


        // [ Button ]
        var table = $('#button-select').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'selected',
                'selectedSingle',
                'selectAll',
                'selectNone',
                'selectRows',
                'selectColumns',
                'selectCells'
            ],
            select: true
        });

    }, 350);
});
