<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Xendit\Configuration;
use Xendit\Invoice\CreateInvoiceRequest;
use Xendit\Invoice\InvoiceApi;

class PublicController extends Controller
{

    public function index()
    {
        return view('homepage');
    }

    public function checkout(Request $request)
    {
        Configuration::setXenditKey(env('XENDIT_SECRET_KEY'));

        $apiInstance = new InvoiceApi();

        $create_invoice_request = new CreateInvoiceRequest([
            'external_id' => strtoupper(uniqid()),
            'description' => $request->get('plan'),
            'amount' => $request->get('price'),
            'invoice_duration' => 172800,
            'currency' => 'IDR',
            'reminder_time' => 1,
            'customer' => [
                'email' => auth()->user()->email,
                'given_name' => auth()->user()->name,
            ],
            'success_redirect_url' => config('app.url'),
            'failure_redirect_url' => config('app.url'),
        ]);

        try
        {
            $result = $apiInstance->createInvoice($create_invoice_request);
            return redirect()->to($result->getInvoiceUrl());
        }

        catch (\Xendit\XenditSdkException $e)
        {
            echo 'Exception when calling InvoiceApi->createInvoice: ', $e->getMessage(), PHP_EOL;
            echo 'Full Error: ', json_encode($e->getFullError()), PHP_EOL;
        }

    }
}
