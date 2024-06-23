<?php

namespace App\Http\Controllers\User;

use App\Models\User\OfflineGateway;
use App\Models\User\PaymentGateway;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Mews\Purifier\Facades\Purifier;

class GatewayController extends Controller
{
    public function index() {
        $userId = getRootUser()->id;
        $data['paypal'] = PaymentGateway::query()->where('user_id', $userId)->where('keyword','paypal')->first();
        $data['stripe'] = PaymentGateway::query()->where('user_id', $userId)->where('keyword','stripe')->first();
        $data['paystack'] = PaymentGateway::query()->where('user_id', $userId)->where('keyword','paystack')->first();
        $data['paytm'] = PaymentGateway::query()->where('user_id', $userId)->where('keyword','paytm')->first();
        $data['flutterwave'] = PaymentGateway::query()->where('user_id', $userId)->where('keyword','flutterwave')->first();
        $data['instamojo'] = PaymentGateway::query()->where('user_id', $userId)->where('keyword','instamojo')->first();
        $data['mollie'] = PaymentGateway::query()->where('user_id', $userId)->where('keyword','mollie')->first();
        $data['razorpay'] = PaymentGateway::query()->where('user_id', $userId)->where('keyword','razorpay')->first();
        $data['mercadopago'] = PaymentGateway::query()->where('user_id', $userId)->where('keyword','mercadopago')->first();
        $data['anet'] = PaymentGateway::query()->where('user_id', $userId)->where('keyword','authorize.net')->first();

        return view('user.gateways.index', $data);
    }

    public function paypalUpdate(Request $request): \Illuminate\Http\RedirectResponse
    {
        $userId = getRootUser()->id;

        PaymentGateway::query()->updateOrCreate(
            [
                'user_id' => $userId,
                'keyword' => 'paypal'
            ],
            $request->except(['information','keyword', 'sandbox_check', 'client_id', 'client_secret','text'])+[
                'user_id' => $userId,
                'status' => (int)$request->status,
                'keyword' => 'paypal',
                'name' => 'PayPal',
                'type' => 'automatic',
                'information' => json_encode([
                    'client_id' => $request->client_id,
                    'sandbox_check' => $request->sandbox_check,
                    'client_secret' => $request->client_secret,
                    'text' => "Pay via your PayPal account."
                ])
            ]
        );
        $request->session()->flash('success', "Paypal informations updated successfully!");
        return back();
    }

    public function stripeUpdate(Request $request) {
        $userId = getRootUser()->id;
        PaymentGateway::query()->updateOrCreate(
            [
                'user_id' => $userId,
                'keyword' => 'stripe'
            ],
            $request->except(['_token','information','keyword', 'key','secret','text'])+[
                'user_id' => $userId,
                'status' => (int)$request->status,
                'keyword' => 'stripe',
                'name' => 'Stripe',
                'type' => 'automatic',
                'information' => json_encode([
                    'key' => $request->key,
                    'secret' => $request->secret,
                    'text' => "Pay via your Credit account."
                ])
            ]
        );
        $request->session()->flash('success', "Stripe informations updated successfully!");
        return back();
    }

    public function paystackUpdate(Request $request) {
        $userId = getRootUser()->id;
        PaymentGateway::query()->updateOrCreate(
            [
                'user_id' => $userId,
                'keyword' => 'paystack'
            ],
            $request->except(['_token','information','keyword','key','email','text'])+[
                'user_id' => $userId,
                'status' => (int)$request->status,
                'keyword' => 'paystack',
                'name' => 'Paystack',
                'type' => 'automatic',
                'information' => json_encode([
                    'key' => $request->key,
                    'email' => $request->email,
                    'text' => "Pay via your Paystack account."
                ])
            ]
        );
        $request->session()->flash('success', "Paystack informations updated successfully!");
        return back();
    }

    public function paytmUpdate(Request $request) {
        $userId = getRootUser()->id;
        PaymentGateway::query()->updateOrCreate(
            [
                'user_id' => $userId,
                'keyword' => 'paytm'
            ],
            $request->except(['_token','information','keyword', 'environment', 'merchant','secret','website','industry','text'])+[
                'user_id' => $userId,
                'status' => (int)$request->status,
                'keyword' => 'paytm',
                'name' => 'Paytm',
                'type' => 'automatic',
                'information' => json_encode([
                    'environment' => $request->environment,
                    'merchant' => $request->merchant,
                    'secret' => $request->secret,
                    'website' => $request->website,
                    'industry' => $request->industry,
                    'text' => "Pay via your Paytm account."
                ])
            ]
        );
        $request->session()->flash('success', "Paytm informations updated successfully!");
        return back();
    }

    public function flutterwaveUpdate(Request $request) {
        $userId = getRootUser()->id;
        PaymentGateway::query()->updateOrCreate(
            [
                'user_id' => $userId,
                'keyword' => 'flutterwave'
            ],
            $request->except(['_token','information','keyword', 'public_key','secret_key','text'])+[
                'user_id' => $userId,
                'status' => (int)$request->status,
                'keyword' => 'flutterwave',
                'name' => 'Flutterwave',
                'type' => 'automatic',
                'information' => json_encode([
                    'public_key' => $request->public_key,
                    'secret_key' => $request->secret_key,
                    'text' => "Pay via your Flutterwave account."
                ])
            ]
        );
        $request->session()->flash('success', "Flutterwave informations updated successfully!");
        return back();
    }

    public function instamojoUpdate(Request $request) {
        $userId = getRootUser()->id;
        PaymentGateway::query()->updateOrCreate(
            [
                'user_id' => $userId,
                'keyword' => 'instamojo'
            ],
            $request->except(['_token','information','keyword','token','key', 'sandbox_check','text'])+[
                'user_id' => $userId,
                'status' => (int)$request->status,
                'keyword' => 'instamojo',
                'name' => 'Instamojo',
                'type' => 'automatic',
                'information' => json_encode([
                    'key' => $request->key,
                    'token' => $request->token,
                    'sandbox_check' => $request->sandbox_check,
                    'text' => "Pay via your Instamojo account."
                ])
            ]
        );
        $request->session()->flash('success', "Instamojo informations updated successfully!");
        return back();
    }

    public function mollieUpdate(Request $request) {
        $userId = getRootUser()->id;
        PaymentGateway::query()->updateOrCreate(
            [
                'user_id' => $userId,
                'keyword' => 'mollie'
            ],
            $request->except(['_token','information','keyword','key','text'])+[
                'user_id' => $userId,
                'status' => (int)$request->status,
                'keyword' => 'mollie',
                'name' => 'Mollie',
                'type' => 'automatic',
                'information' => json_encode([
                    'key' => $request->key,
                    'text' => "Pay via your Mollie Payment account."
                ])
            ]
        );
        $request->session()->flash('success', "Mollie Payment informations updated successfully!");
        return back();
    }

    public function razorpayUpdate(Request $request) {
        $userId = getRootUser()->id;
        PaymentGateway::query()->updateOrCreate(
            [
                'user_id' => $userId,
                'keyword' => 'razorpay'
            ],
            $request->except(['_token','information','keyword','key', 'secret','text'])+[
                'user_id' => $userId,
                'status' => (int)$request->status,
                'keyword' => 'razorpay',
                'name' => 'Razorpay',
                'type' => 'automatic',
                'information' => json_encode([
                    'key' => $request->key,
                    'secret' => $request->secret,
                    'text' => "Pay via your Razorpay account."
                ])
            ]
        );
        $request->session()->flash('success', "Razorpay informations updated successfully!");
        return back();
    }

    public function anetUpdate(Request $request) {
        $userId = getRootUser()->id;
        PaymentGateway::query()->updateOrCreate(
            [
                'user_id' => $userId,
                'keyword' => 'authorize.net'
            ],
            $request->except(['_token','information','keyword', 'login_id', 'transaction_key', 'public_key', 'sandbox_check','text'])+[
                'user_id' => $userId,
                'status' => (int)$request->status,
                'keyword' => 'authorize.net',
                'name' => 'Authorize.net',
                'type' => 'automatic',
                'information' => json_encode([
                    'login_id' => $request->login_id,
                    'transaction_key' => $request->transaction_key,
                    'public_key' => $request->public_key,
                    'sandbox_check' => $request->sandbox_check,
                    'text' => "Pay via your Authorize.net account."
                ])
            ]
        );

        $request->session()->flash('success', "Authorize.net informations updated successfully!");
        return back();
    }

    public function mercadopagoUpdate(Request $request) {
        $userId = getRootUser()->id;
        PaymentGateway::query()->updateOrCreate(
            [
                'user_id' => $userId,
                'keyword' => 'mercadopago'
            ],
            $request->except(['_token','information','keyword','token', 'sandbox_check','text'])+[
                'user_id' => $userId,
                'status' => (int)$request->status,
                'keyword' => 'mercadopago',
                'name' => 'Mercado Pago',
                'type' => 'automatic',
                'information' => json_encode([
                    'token' => $request->token,
                    'sandbox_check' => $request->sandbox_check,
                    'text' => "Pay via your Mercado Pago account."
                ])
            ]
        );
        $request->session()->flash('success', "Mercado Pago informations updated successfully!");
        return back();
    }

    public function offline() {
        $userId = getRootUser()->id;
        $data['ogateways'] = OfflineGateway::query()
            ->where('user_id', $userId)
            ->orderBy('id', 'DESC')
            ->get();
        return view('user.gateways.offline.index', $data);
    }

    public function store(Request $request) {

        $rules = [
            'name' => 'required|max:100',
            'short_description' => 'nullable',
            'serial_number' => 'required|integer',
            'is_receipt' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }
        $userId = getRootUser()->id;
        OfflineGateway::create($request->except('user_id', 'instructions') + [
                'user_id' => $userId,
                'instructions' => Purifier::clean($request->instructions,'youtube')
            ]);

        Session::flash('success', 'Gateway added successfully!');
        return "success";
    }

    public function update(Request $request) {

        $rules = [
            'name' => 'required|max:100',
            'short_description' => 'nullable',
            'serial_number' => 'required|integer',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $in = $request->except('_token', 'ogateway_id', 'instructions');
        $in['instructions'] = Purifier::clean($request->instructions,'youtube');
        $userId = getRootUser()->id;
        OfflineGateway::query()
            ->where('user_id', $userId)
            ->where('id', $request->ogateway_id)
            ->update($in);

        Session::flash('success', 'Gateway updated successfully!');
        return "success";
    }

    public function status(Request $request)
    {
        $userId = getRootUser()->id;
        OfflineGateway::query()
            ->where('user_id', $userId)
            ->find($request->ogateway_id)
            ->update(['status' => $request->status]);
        Session::flash('success', 'Gateway status changed successfully!');
        return back();
    }

    public function delete(Request $request)
    {

        $userId = getRootUser()->id;
        OfflineGateway::query()
            ->where('user_id', $userId)
            ->findOrFail($request->ogateway_id)
            ->delete();
        Session::flash('success', 'Gateway deleted successfully!');
        return back();
    }

}
