@dump($errors->messages())
<form class="form Profile-form" action="{{route('users.update', $user)}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="row-block">
            <div class="form-group">
                <label class="form-label" for="avatar">Аватар
                </label>
                <div class="Profile-avatar Profile-avatar_noimg">
                    <div class="Profile-img"><img src="{{asset('assets/img/#.png')}}" alt="#.png"/>
                    </div>
                    <label class="Profile-fileLabel" for="avatar">Выберите аватар
                    </label>
                    <input class="Profile-file form-input" id="avatar" name="avatar" type="file" data-validate="onlyImgAvatar"/>
                </div>
                @if($errors->get('avatar'))
                    <div class="form-error">{{ implode(', ', $errors->get('avatar')) }}</div>
                @endif
            </div>
            <div class="form-group">
                <label class="form-label" for="name">ФИО
                </label>
                <input class="form-input {{ $errors->get('name') ? 'form-input_error' : '' }}" id="name" name="name" type="text" value="{{$user->name}}" data-validate="require"/>
                @if($errors->get('name'))
                    <div class="form-error">{{ implode(', ', $errors->get('name')) }}</div>
                @endif
            </div>
        </div>
        <div class="row-block">
            <div class="form-group">
                <label class="form-label" for="phone">Телефон
                </label>
                <input class="form-input {{ $errors->get('phone') ? 'form-input_error' : '' }}" id="phone" name="phone" type="text" value="{{$user->phone ?? old('phone')}}" data-inputmask="'mask': '99-9999999'"/>
                @if($errors->get('phone'))
                    <div class="form-error">{{ implode(', ', $errors->get('phone')) }}</div>
                @endif
            </div>
            <div class="form-group">
                <label class="form-label" for="mail">E-mail
                </label>
                <input class="form-input {{ $errors->get('email') ? 'form-input_error' : '' }}" id="mail" name="email" type="text" value="{{$user->email}}" data-validate="require"/>
                @if($errors->get('email'))
                    <div class="form-error">{{ implode(', ', $errors->get('email')) }}</div>
                @endif
            </div>
            <div class="form-group">
                <label class="form-label" for="password">Пароль
                </label>
                <input class="form-input {{ $errors->get('password') ? 'form-input_error' : '' }}" id="password" name="password" type="password" placeholder="Тут можно изменить пароль"/>
                @if($errors->get('password'))
                    <div class="form-error">{{ implode(', ', $errors->get('password')) }}</div>
                @endif
            </div>
            <div class="form-group">
                <label class="form-label" for="passwordReply">Подтверждение пароля
                </label>
                <input class="form-input" id="passwordReply" name="password_confirmation" type="password" placeholder="Введите пароль повторно"/>
            </div>
            <div class="form-group">
                <div class="Profile-btn">
                    <button class="btn btn_success" type="submit">Сохранить</button>
                </div>
                <div class="Profile-success">Профиль успешно сохранен</div>
            </div>
        </div>
    </div>
</form>
