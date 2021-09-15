
<form class="form form_contacts" action="{{route('feedbacks.send_message')}}" method="post">
    @csrf
    <div class="form-group">
        <div class="row">
            <div class="row-block">
                <input
                    class="form-input"
                    id="name" name="name"
                    type="text"
                    placeholder="{{__('feedback.YourName')}}"
                    value="{{old('name')}}"
                />
            </div>
            <div class="row-block">
                <input
                    class="form-input"
                    id="mail"
                    name="email"
                    type="text"
                    placeholder="{{__('feedback.YourEmail')}}"
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
            placeholder="{{__('feedback.Message')}}...">{{old('message')}}
        </textarea>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn_muted form-btn">{{__('feedback.Send')}}</button>
    </div>
</form>
