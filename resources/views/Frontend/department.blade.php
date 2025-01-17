@extends('layouts.master')
@section('title', "Department page | Ecommerce")
@section('content')
<livewire:frontend.department-page  :slug="$slug" lazy/>

@endsection