

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
    $(document).ready(function() {
        $('#product-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('users.getProduct') }}",
                type: "GET",
                dataSrc: function (json) {
                    console.log("Data received:", json); // Debug log
                    return json.data;
                },
                error: function(xhr, error, thrown) {
                    console.error("DataTable Error:", xhr, error, thrown); // Log errors
                }
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'title', name: 'title' },
                { data: 'description', name: 'description' },
                { data: 'image', name: 'image' },
               { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
       
    });

</script>



