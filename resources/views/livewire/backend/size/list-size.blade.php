<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('List Size') }}
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
            <a href="{{route('add-size')}}" class="btn btn-success">Add</a>
            <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Title</th>
              
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{$product->title}}</td>
               
                <td>
                <a href="{{ route('edit-size', $product->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>

                <button type="submit" wire:click.prevent="delete('{{ $product->id }}')">Delete</button>
                </td>
            </tr>
            @endforeach
            </tbody>
        <tfoot>
            <tr>
                <th>Title</th>
              
                <th>Action</th>
            </tr>
        </tfoot>
    </table>

            </div>
        </div>
    </div>
</div>
<script>
    new DataTable('#example');


</script>



