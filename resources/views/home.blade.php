@extends('layouts.app')

@section('title')
    Principal
@endsection

@section('content')
    <x-list-posts :posts="$posts" />
@endsection
