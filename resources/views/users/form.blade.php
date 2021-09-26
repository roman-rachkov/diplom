<form class="form Profile-form" action="{{route('users.update', $user)}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="row-block">
            <div class="form-group">
                <label class="form-label" for="avatar">{{ __('profile.avatar') }}
                </label>
                <div class="Profile-avatar {{$user->avatar->url ? : 'Profile-avatar_noimg'}}">
                    <div class="Profile-img">
                        <img src="{{$user->avatar->url ?? asset('assets/img/#.png')}}" alt="#.png"/>
                    </div>
                    <label class="Profile-fileLabel" for="avatar">{{ __('profile.avatar_check') }}
                    </label>
                    <input class="Profile-file form-input" id="avatar" name="avatar" type="file" data-validate="onlyImgAvatar"/>
                </div>
                @if($errors->get('avatar'))
                    <div class="form-error">{{ implode(', ', $errors->get('avatar')) }}</div>
                @endif
            </div>
            <div class="form-group">
                <label class="form-label" for="name">{{ __('profile.fio') }}
                </label>
                <input class="form-input {{ $errors->get('name') ? 'form-input_error' : '' }}" id="name" name="name" type="text" value="{{ old('name', $user->name) }}" data-validate="require"/>
                @if($errors->get('name'))
                    <div class="form-error">{{ implode(', ', $errors->get('name')) }}</div>
                @endif
            </div>
        </div>
        <div class="row-block">
            <div class="form-group">
                <label class="form-label" for="phone">{{ __('profile.phone') }}
                </label>
                <input class="form-input {{ $errors->get('phone') ? 'form-input_error' : '' }}" id="phone" name="phone" type="text" value="{{ old('phone', $user->phone) }}" data-inputmask="'mask': '99-9999999'"/>
                @if($errors->get('phone'))
                    <div class="form-error">{{ implode(', ', $errors->get('phone')) }}</div>
                @endif
            </div>
            <div class="form-group">
                <label class="form-label" for="mail">{{ __('profile.email') }}
                </label>
                <input class="form-input {{ $errors->get('email') ? 'form-input_error' : '' }}" id="mail" name="email" type="text" value="{{ old('email', $user->email) }}" data-validate="require"/>
                @if($errors->get('email'))
                    <div class="form-error">{{ implode(', ', $errors->get('email')) }}</div>
                @endif
            </div>
            <div class="form-group">
                <label class="form-label" for="password">{{ __('profile.password') }}
                </label>
                <input class="form-input {{ $errors->get('password') ? 'form-input_error' : '' }}" id="password" name="password" type="password" placeholder="{{ __('profile.password_change') }}"/>
                @if($errors->get('password'))
                    <div class="form-error">{{ implode(', ', $errors->get('password')) }}</div>
                @endif
            </div>
            <div class="form-group">
                <label class="form-label" for="passwordReply">{{ __('profile.password_reply') }}
                </label>
                <input class="form-input" id="passwordReply" name="password_confirmation" type="password" placeholder="{{ __('profile.password_confirmation') }}"/>
            </div>
            <div class="form-group">
                <div class="Profile-btn">
                    <button class="btn btn_success" type="submit">{{ __('profile.save') }}</button>
                </div>
                @if(session('success'))
                    <div class="Profile-success">{{ __('profile.save_success') }}</div>
                @endif
            </div>
        </div>
    </div>
</form>
