@extends('layout.master')

@section('content')

    <div class="Section Section_column Section_columnLeft">
        <div class="wrap">

            @include('users.navigation')

            <div class="Section-content">
                <div class="Profile">

                    @include('users.form')

                </div>
            </div>

        </div>
    </div>

@endsection
