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
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <!-- <th>Actions</th> -->
            </tr>
        </thead>
    </table>
    </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('users.getUsers') }}",
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
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
               // { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
</script>

</div>



