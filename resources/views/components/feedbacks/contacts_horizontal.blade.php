<div class="Contacts Contacts_main">
    <div class="Contacts-block">
        <div class="media">
            <div class="media-image"><img src="{{asset('assets/img/icons/contacts/phone.svg')}}" alt="phone.svg"/></div>
            <div class="media-content">Тел: {{$phone}}</div>
        </div>
    </div>
    <div class="Contacts-block">
        <div class="media">
            <div class="media-image"><img src="{{asset('assets/img/icons/contacts/address.svg')}}" alt="address.svg"/></div>
            <div class="media-content">
                {{$address}}
            </div>
        </div>
    </div>
    <div class="Contacts-block">
        <div class="media">
            <div class="media-image"><img src="{{asset('assets/img/icons/contacts/mail.svg')}}" alt="mail.svg"/></div>
            <div class="media-content">Email: {{$email}}</div>
        </div>
    </div>
</div>
