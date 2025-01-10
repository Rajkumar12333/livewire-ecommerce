<x-app-layout>
@section('title', $page_title)
    <livewire:backend.color.add-color :recordId="$recordId??null" :page_title=$page_title  />
</x-app-layout>
