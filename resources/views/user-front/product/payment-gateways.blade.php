@if ($paypal?->status == 1)
    <div class="option-block">
        <div class="radio-block">
            <div class="checkbox">
                <label>
                    <input name="gateway" type="radio" class="input-check" value="paypal" data-tabid="paypal"
                        data-action="{{ route('product.paypal.submit', getParam()) }}">
                    <span>{{ $keywords['Paypal'] ?? __('Paypal') }}</span>
                </label>
            </div>
        </div>
    </div>
@endif

@if ($stripe?->status == 1)
    <div class="option-block">
        <div class="checkbox">
            <label>
                <input name="gateway" class="input-check" type="radio" value="stripe" data-tabid="stripe"
                    data-action="{{ route('product.stripe.submit', getParam()) }}">
                <span>{{ $keywords['Stripe'] ?? __('Stripe') }}</span>
            </label>
        </div>
    </div>


    <div class="row gateway-details" id="tab-stripe">
        <div class="col">
            <div id="stripe-element" class="mb-3">

            </div>
            <div id="stripe-errors" class="text-danger"></div>
        </div>
    </div>
@endif


@if ($paystack?->status == 1)
    <div class="option-block">
        <div class="radio-block">
            <div class="checkbox">
                <label>
                    <input name="gateway" type="radio" class="input-check" value="paystack" data-tabid="paystack"
                        data-action="{{ route('product.paystack.submit', getParam()) }}">
                    <span>{{ $keywords['Paystack'] ?? __('Paystack') }}</span>
                </label>
            </div>
        </div>
    </div>
@endif

@if ($flutterwave?->status == 1)
    <div class="option-block">
        <div class="radio-block">
            <div class="checkbox">
                <label>
                    <input name="gateway" type="radio" class="input-check" value="flutterwave"
                        data-tabid="flutterwave" data-action="{{ route('product.flutterwave.submit', getParam()) }}">
                    <span>{{ $keywords['Flutterwave'] ?? __('Flutterwave') }}</span>
                </label>
            </div>
        </div>
    </div>
@endif

@if ($razorpay?->status == 1)
    <div class="option-block">
        <div class="radio-block">
            <div class="checkbox">
                <label>
                    <input name="gateway" type="radio" class="input-check" value="razorpay" data-tabid="razorpay"
                        data-action="{{ route('product.razorpay.submit', getParam()) }}">
                    <span>{{ $keywords['Razorpay'] ?? __('Razorpay') }}</span>
                </label>
            </div>
        </div>
    </div>
@endif

@if ($instamojo?->status == 1)
    <div class="option-block">
        <div class="radio-block">
            <div class="checkbox">
                <label>
                    <input name="gateway" type="radio" class="input-check" value="instamojo" data-tabid="instamojo"
                        data-action="{{ route('product.instamojo.submit', getParam()) }}">
                    <span>{{ $keywords['Instamojo'] ?? __('Instamojo') }}</span>
                </label>
            </div>
        </div>
    </div>
@endif

@if ($paytm?->status == 1)
    <div class="option-block">
        <div class="radio-block">
            <div class="checkbox">
                <label>
                    <input name="gateway" type="radio" class="input-check" value="paytm" data-tabid="paytm"
                        data-action="{{ route('product.paytm.submit', getParam()) }}">
                    <span>{{ $keywords['Paytm'] ?? __('Paytm') }}</span>
                </label>
            </div>
        </div>
    </div>
@endif

@if ($anet?->status == 1)

    <div class="option-block">
        <div class="checkbox">
            <label>
                <input name="gateway" class="input-check" type="radio" value="authorize.net" data-tabid="anet"
                    data-action="{{ route('product.anet.submit', getParam()) }}">
                <span>{{ $keywords['Authorize'] ?? __('Authorize.net') }}</span>
            </label>
        </div>
    </div>


    <div class="row gateway-details" id="tab-anet">
        <div class="col-lg-12 mb-4">
            <div class="field-input">
                <input id="anetCardNumber" class="card-elements mb-0" name="anetCardNumber" type="text"
                    placeholder="{{ $keywords['Enter your card number'] ?? __('Enter Your Card Number') }}"
                    value="{{ old('anetCardNumber') }}" autocomplete="off" />
            </div>
            @if ($errors->has('anetCardNumber'))
                <p class="text-danger mb-0">{{ $errors->first('anetCardNumber') }}</p>
            @endif
        </div>

        <div class="col-lg-12 mb-4">
            <div class="field-input">
                <input id="anetExpMonth" class="card-elements mb-0" name="anetExpMonth" type="text"
                    placeholder="{{ $keywords['Enter expiry month'] ?? __('Enter Expiry Month') }}"
                    value="{{ old('anetExpMonth') }}" autocomplete="off" />
            </div>
            @if ($errors->has('anetExpMonth'))
                <p class="text-danger mb-0">{{ $errors->first('anetExpMonth') }}</p>
            @endif
        </div>

        <div class="col-lg-12 mb-4">
            <div class="field-input">
                <input id="anetExpYear" class="card-elements mb-0" name="anetExpYear" type="text"
                    placeholder="{{ $keywords['Enter expiry year'] ?? __('Enter Expiry Year') }}"
                    value="{{ old('anetExpYear') }}" autocomplete="off" />
            </div>
            @if ($errors->has('anetExpYear'))
                <p class="text-danger mb-0">{{ $errors->first('anetExpYear') }}</p>
            @endif
        </div>
        <div class="col-lg-12 mb-4">
            <div class="field-input">
                <input id="anetCardCode" class="card-elements mb-0" name="anetCardCode" type="text"
                    placeholder="{{ $keywords['Enter card code'] ?? __('Enter Card Code') }}"
                    value="{{ old('anetCardCode') }}" autocomplete="off" />
            </div>
            @if ($errors->has('anetCardCode'))
                <p class="text-danger mb-0">{{ $errors->first('anetCardCode') }}</p>
            @endif
        </div>
        <input type="hidden" name="opaqueDataValue" id="opaqueDataValue" />
        <input type="hidden" name="opaqueDataDescriptor" id="opaqueDataDescriptor" />
        <ul id="anetErrors" class="dis-none"></ul>
    </div>
@endif

@if ($mollie?->status == 1)
    <div class="option-block">
        <div class="radio-block">
            <div class="checkbox">
                <label>
                    <input name="gateway" type="radio" class="input-check" value="mollie" data-tabid="mollie"
                        data-action="{{ route('product.mollie.submit', getParam()) }}">
                    <span>{{ $keywords['Mollie'] ?? __('Mollie') }}</span>
                </label>
            </div>
        </div>
    </div>
@endif

@if ($mercadopago?->status == 1)
    <div class="option-block">
        <div class="radio-block">
            <div class="checkbox">
                <label>
                    <input name="gateway" type="radio" class="input-check" value="mercadopago"
                        data-tabid="mercadopago" data-action="{{ route('product.mercadopago.submit', getParam()) }}">
                    <span>{{ $keywords['Mercadopago'] ?? __('Mercadopago') }}</span>
                </label>
            </div>
        </div>
    </div>
@endif

@foreach ($ogateways as $ogateway)
    <div class="offline" id="offline{{ $ogateway->id }}">
        <div class="option-block">
            <div class="checkbox">
                <label>
                    <input name="gateway" class="input-check" type="radio" value="{{ $ogateway->id }}"
                        data-tabid="{{ $ogateway->id }}"
                        data-action="{{ route('product.offline.submit', [getParam(), $ogateway->id]) }}">
                    <span>{{ $ogateway->name }}</span>
                </label>
            </div>
        </div>

        @if (!empty($ogateway->short_description))
            <p class="gateway-desc">{{ $ogateway->short_description }}</p>
        @endif

        <div class="gateway-details row" id="tab-{{ $ogateway->id }}">
            @if (!empty(strip_tags($ogateway->instructions)))
                <div class="col-12">
                    <div class="gateway-instruction">
                        {!! replaceBaseUrl($ogateway->instructions) !!}
                    </div>
                </div>
            @endif

            @if ($ogateway->is_receipt == 1)
                <div class="col-12 mb-4">
                    <label for="" class="d-block">{{ $keywords['Receipt'] ?? __('Receipt') }} **</label>
                    <input type="file" name="receipt">
                    <p class="mb-0 text-warning">**
                        {{ $keywords['Receipt image must be .jpg / .jpeg / .png'] ?? __('Receipt image must be .jpg / .jpeg / .png') }}
                    </p>
                </div>
            @endif
        </div>
    </div>
@endforeach


@if ($errors->has('receipt'))
    <p class="text-danger mb-4">{{ $errors->first('receipt') }}</p>
@endif
