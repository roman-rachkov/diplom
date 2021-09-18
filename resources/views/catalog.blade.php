@extends('layout.master')

@section('content')
    <div class="Section Section_column Section_columnLeft">
        <div class="wrap">
            <div class="Section-column">
                <x-filter/>
            </div>
            <div class="Section-content">
                <x-sort/>
                <x-catalog :products="$products"/>
            </div>
        </div>
    </div>
@endsection
