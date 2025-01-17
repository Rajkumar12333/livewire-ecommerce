

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dashboard') }}
    </h2>
</x-slot>

<div class="py-12">
  
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    @if (session()->has('message'))
    <div class="alert alert-success" id="success-message" role="alert">
        {{ session('message') }}
    </div>
@endif

<script>
    // Wait for the DOM to fully load
    document.addEventListener('DOMContentLoaded', function () {
        // Get the success message element
        const successMessage = document.getElementById('success-message');

        // Check if the element exists
        if (successMessage) {
            // Set a timeout to hide the alert after 5 seconds (5000 milliseconds)
            setTimeout(() => {
                successMessage.style.display = 'none';
            }, 1000); // Change 5000 to your desired time in milliseconds
        }
    });
</script>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
            <a href="{{route('add-products')}}" class="btn btn-success" wire:navigate>Add</a>
            <table id="product-table" class="table table-striped" style="width:100%">
        <thead>
            <tr>
            <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                 <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
          
            </tbody>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                 <th>Image</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>

            </div>
        </div>
    </div>
</div>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function loadTable() {
        if ($.fn.DataTable.isDataTable('#product-table')) {
            $('#product-table').DataTable().destroy(); // Destroy the existing DataTable instance
            $('#product-table tbody').empty(); // Clear the table body to prevent duplication
        }

        $('#product-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('users.getProduct') }}", // Adjust route if necessary
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
                { data: 'title', name: 'title' },
                { data: 'description', name: 'description' },
                { data: 'image', name: 'image', orderable: false, searchable: false },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            responsive: true, // Makes the table responsive
            lengthChange: true, // Enable changing number of rows displayed
            pageLength: 10, // Default number of rows
            dom: 'Bfrtip', // Add buttons
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: 'Excel <i class="fa-regular fa-file-excel"></i>',
                    className: 'btn btn-success btn-sm'
                },
                {
                    extend: 'pdfHtml5',
                    text: 'Expor PDF <i class="fa-solid fa-file-pdf"></i>',
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
   
    document.addEventListener('livewire:navigated', () => { 
        loadTable(); // Initialize DataTable on initial page load
    });
   
</script>





