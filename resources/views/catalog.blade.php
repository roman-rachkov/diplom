@extends('layout.master')

@section('content')
    <div class="Section Section_column Section_columnLeft">
        <div class="wrap">
            <div class="Section-column">
                <x-catalog.filter/>
            </div>
            <div class="Section-content">
                <x-catalog.sort/>

                <div class="Cards">

                    <x-catalog.catalog/>
                </div>
            </div>
        </div>
    </div>
@endsection
