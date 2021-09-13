@extends('layout.master')

@section('content')

        <div class="Section Section_column Section_columnRight Section_columnWide">
            <div class="wrap">

                <div class="Section-column">

                    <x-quality_banner/>

                    <x-feedbacks.socseti/>

                </div>
                <div class="Section-content">

                    @include('feedbacks.map')

                    <x-feedbacks.contacts_horizontal :phone="$phone" :address="$address" :email="$email"/>

                    <header class="Section-header Section-header_sm">
                        <h2 class="Section-title">Обратная связь</h2>
                    </header>
                    @include('layout.errors')
                    @include('feedbacks.form')

                </div>
            </div>
        </div>

@endsection
