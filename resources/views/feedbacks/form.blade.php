
<form class="form form_contacts" action="{{route('feedbacks.send_message')}}" method="post">
    @csrf
    <div class="form-group">
        <div class="row">
            <div class="row-block">
                <input
                    class="form-input"
                    id="name" name="name"
                    type="text"
                    placeholder="Ваше Имя"
                    value="{{old('name')}}"
                />
            </div>
            <div class="row-block">
                <input
                    class="form-input"
                    id="mail"
                    name="email"
                    type="text"
                    placeholder="Ваш Email"
                    value="{{old('email')}}"
                />
            </div>
        </div>
    </div>
    <div class="form-group">
        <textarea
            class="form-textarea"
            name="message"
            id="message"
            placeholder="Сообщение...">{{old('message')}}
        </textarea>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn_muted form-btn">Отправить</button>
    </div>
</form>
