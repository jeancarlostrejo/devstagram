@extends('layouts.app')

@section('title')
    Principal
@endsection

@section('content')
    <x-list-posts :$posts message='No tienes publicaciones, sigue a alguien para mostrar sus posts'/>
@endsection
