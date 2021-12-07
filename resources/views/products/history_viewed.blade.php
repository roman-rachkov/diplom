@extends('layout.master')

@section('title', __('view_history.history'))

@section('content')
    <div class="Section Section_column Section_columnLeft">
        <div class="wrap">

            @include('users.navigation')

            <div class="Section-content">
                <div class="Cards">
                    @foreach($viewedProductsDTOs as $dto)
                        <x-card :dto="$dto" />
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
