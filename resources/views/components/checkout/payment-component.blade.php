@props(['payment'])
<div>
    <label class="toggle">
        <input type="radio" name="payment" value="{{$payment->id}}" {{$payment->id === 1 ? 'checked': ''}}/>
        <span class="toggle-box"></span><span class="toggle-text">{{$payment->name}}</span>
    </label>
</div>
