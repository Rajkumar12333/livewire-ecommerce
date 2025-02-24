@section('title', $page_title)
<div>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('List Color') }}
    </h2>
</x-slot>

<div class="py-12">
  
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
<div class="p-6 text-gray-900">
    <table class="table table-striped table-hover" id="users-table">
       
    </table>
    </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
   
    function loadtable() {
        const table = $('#users-table');
        if ($.fn.DataTable.isDataTable('#users-table')) {
            table.DataTable().destroy(); // Destroy the existing DataTable instance
            table.empty(); // Clear the table
        }
        table.find('thead, tfoot').remove();

        // Re-append the original thead and tfoot
        table.append(`
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        `);
        table.DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('users.getUsers') }}",
                type: "GET",
                dataSrc: function (json) {
                    console.log("Data received:", json); // Debug log
                    return json.data; // Ensure only the data array is returned
                },
                error: function (xhr, error, thrown) {
                    console.error("DataTable Error:", xhr, error, thrown); // Log any errors
                }
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            responsive: true, // Makes the table responsive
            lengthChange: true,
            pageLength: 10,
            dom: 'Bfrtip', // Add buttons
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: 'Excel <i class="fa-regular fa-file-excel"></i>',
                    className: 'btn btn-success btn-sm'
                },
                {
                    extend: 'pdfHtml5',
                    text: 'Export PDF <i class="fa-solid fa-file-pdf"></i>',
                    className: 'btn btn-danger btn-sm'
                },
                {
                    extend: 'print',
                    text: 'Print <i class="fa-solid fa-print"></i>',
                    className: 'btn btn-info btn-sm'
                }
            ],
            language: {
                paginate: {
                    previous: '&laquo;',
                    next: '&raquo;'
                }
            }
        });
    }

    document.addEventListener("DOMContentLoaded", function () {
        loadtable(); // Initialize DataTable on initial page load
    });
    loadtable();
</script>

</div>


