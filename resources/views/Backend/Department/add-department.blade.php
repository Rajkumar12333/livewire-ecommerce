<x-app-layout>
@section('title', $page_title)
    <livewire:backend.department.add-department :recordId="$recordId??null" :page_title=$page_title  />
</x-app-layout>
