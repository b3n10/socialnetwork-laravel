@extends('layouts.main')

@section('title')
	404 Page
@endsection

@section('content')
	<h3>Oops, page cannot be found!</h3>
	<a href="{{ route('home') }}">Go home</a>
@endsection

