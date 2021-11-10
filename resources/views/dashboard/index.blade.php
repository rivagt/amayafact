{{-- @include('dashboard.extdashboard') --}}
@extends('adminlte::page')
{{-- , ['iFrameEnabled'=>true] --}}
{{-- @section('title', 'Dashboard') --}}
@include('dashboard.styles')
@include('dashboard.head')


@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
@stop
@section('footer')
    <p>footer</p>
@stop

{{-- @section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop --}}
@include('dashboard.js')
{{-- @section('js')
    <script> console.log('Hi!'); </script>
@stop --}}
