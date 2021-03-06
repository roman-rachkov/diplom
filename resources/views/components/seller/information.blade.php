<div class="Section-column">
    <div class="Section-columnSection Section-columnSection_mark">
        <div class="media media_middle">
            <div class="media-image"><img src="{{asset('assets/img/icons/contacts/phone.svg')}}" alt="phone.svg"/>
            </div>
            <div class="media-content">{{__('seller.Phone')}}:&#32;
                <nobr>{{$seller->phone ?? ''}}</nobr>
            </div>
        </div>
    </div>
    <div class="Section-columnSection Section-columnSection_mark">
        <div class="media media_middle">
            <div class="media-image"><img src="{{asset('assets/img/icons/contacts/address.svg')}}" alt="address.svg"/>
            </div>
            <div class="media-content">
                {{__('seller.Address')}}: {{$seller->address ?? ''}}
            </div>
        </div>
    </div>
    <div class="Section-columnSection Section-columnSection_mark">
        <div class="media media_middle">
            <div class="media-image"><img src="{{asset('assets/img/icons/contacts/mail.svg')}}" alt="mail.svg"/></div>
            <div class="media-content">{{__('seller.Email')}}: {{$seller->email ?? ''}}</div>
        </div>
    </div>
</div>
