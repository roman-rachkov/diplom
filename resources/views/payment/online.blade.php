@extends('layout.master')

@section('title', __('checkout.payment'))

@section('content')
    <div class="Middle Middle_top">
        <div class="Middle-top">
            <div class="wrap">
                <div class="Middle-header">
                    <h1 class="Middle-title">Оплата Заказа №200</h1>
                    <ul class="breadcrumbs Middle-breadcrumbs">
                        <li class="breadcrumbs-item"><a href="index.html">Главная</a></li>
                        <li class="breadcrumbs-item breadcrumbs-item_current"><span>Оплата</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="Section">
            <div class="wrap">
                <form class="form Payment" action="#" method="post">
                    <div class="Payment-card">
                        <div class="form-group">
                            <label class="form-label">Номер карты</label>
                            <input class="form-input Payment-bill" id="numero1" name="numero1" type="text" placeholder="9999 9999" data-mask="9999 9999" data-validate="require pay"/>
                        </div>
                    </div>
                    <div class="Payment-pay"><a class="btn btn_primary" href="paymentprogress.html">Оплатить $200.99</a></div>
                </form>
            </div>
        </div>
    </div>
@endsection
