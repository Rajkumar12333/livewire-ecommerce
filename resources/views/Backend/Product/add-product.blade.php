<x-app-layout>
@section('title', $page_title)
    <livewire:backend.product.add-product :recordId="$recordId??null" :page_title=$page_title  />
</x-app-layout>
