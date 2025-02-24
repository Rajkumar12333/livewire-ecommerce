
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

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" wire:ignore>
            <div class="p-6 text-gray-900">
            <a href="{{route('add-department')}}" class="btn btn-success" wire:navigate>Add</a>
            <table id="department-table" class="table table-striped" style="width:100%">
       
    </table>

            </div>
        </div>
    </div>
    <div x-data="{ isOpen: @entangle('isOpen') }">
    <!-- Popup Modal -->
    <div x-show="isOpen" class="popup">
 
        <div class="popup-content">
        <button class="btn btn-danger" @click="isOpen = false" style="position: absolute; top: 10px; right: 10px; border: none; padding: 5px 10px; font-size: 16px; cursor: pointer;">
                X
            </button>
            <h3>Department Details</h3>
            @if(!empty($department))
                <p><strong>Title:</strong> {{ $department->title }}</p>
              
            @else
                <p>Loading...</p> <!-- Show loading if product is not found -->
            @endif
         
        </div>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function loadtable() {
            const table = $('#department-table');
            if ($.fn.DataTable.isDataTable('#department-table')) {
                table.DataTable().destroy(); // Destroy the existing DataTable instance
                table.empty(); // Clear the table to prevent duplication
            }
            table.find('thead, tfoot').remove();

            // Re-append the original thead and tfoot
            table.append(`
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            `);
            table.DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('users.getDepartment') }}",
                    type: "GET",
                    dataSrc: function (json) {
                        // console.log("Data received:", json); // Debug log
                        return json.data; // Ensure only the data array is returned
                    },
                    error: function (xhr, error, thrown) {
                        // console.error("DataTable Error:", xhr, error, thrown); // Log any errors
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'title', name: 'title' },
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
   
    document.addEventListener('livewire:navigated', () => { 
        loadtable(); // Initialize DataTable on initial page load
    });

   

</script>
