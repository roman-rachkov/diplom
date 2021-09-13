@extends('layout.master')

@section('content')
    <div class="Section Section_column Section_columnLeft">
        <div class="wrap">
            <div class="Section-column">
                <x-catalog.filter/>
            </div>
            <div class="Section-content">
                <x-sort/>
                <x-catalog.catalog :products="$products"/>
            </div>
        </div>
    </div>
@endsection
