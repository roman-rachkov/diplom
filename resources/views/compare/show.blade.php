@extends('layout.master')

@section('title', __('compare.title'))

@section('content')
    <x-compare.compare
            :comparedProducts="$comparedProducts"
    />
@endsection
