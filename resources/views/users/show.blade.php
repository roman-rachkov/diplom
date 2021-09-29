@extends('layout.master')

@section('content')

    <div class="Section Section_column Section_columnLeft">
        <div class="wrap">

            @include('users.navigation')

            <div class="Section-content">
                <div class="Account">
                    <div class="Account-group">
                        <div class="Account-column">
                            <div class="Account-avatar">
                                <img src="{{ $user->avatar->url ?? asset('assets/img/no_image.png') }}" alt="card.jpg"/>
                            </div>
                        </div>
                        <div class="Account-column">
                            <div class="Account-name">{{$user->name}}
                            </div><a class="Account-editLink" href="{{route('users.edit', $user)}}">{{__('profile.edit')}}</a>
                        </div>
                    </div>

                    @include('users.order_history')

                    @include('users.view_history')

                </div>
            </div>
        </div>
    </div>

@endsection
