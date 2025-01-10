<x-app-layout>
@section('title', $page_title)

    <livewire:backend.size.add-size :recordId="$recordId??null"   />
</x-app-layout>
