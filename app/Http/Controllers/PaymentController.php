<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree\Gateway;
use App\Models\Sponsor;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('sponsor_id')) {
            $sponsorId = $request->input('sponsor_id');
            $sponsor = Sponsor::find($sponsorId);

            if (!$sponsor) {
                abort(404, 'Sponsor non trovato');
            }
        } else {
            $sponsor = null;
        }

        return view('admin.payment.index', compact('sponsor'));
    }

    public function checkout(Request $request)
    {
        return view('admin.payment.checkout');
    }

    public function process(Request $request)
    {
        $gateway = new Gateway([
            'environment' => 'sandbox',
            'merchantId' => 'v8v2d8ds6x49rzj5',
            'publicKey' => 'sgrgsw6zssyh97z9',
            'privateKey' => '5809159dbe8181cd28af60274705452b'
        ]);

        $data = $request->all();
        $sponsorId = $request->input('sponsor_id');
        $result = null;

        switch ($sponsorId) {
            case 1:
                $amount = '9.99';
                break;
            case 2:
                $amount = '5.99';
                break;
            case 3:
                $amount = '2.99';
                break;
            default:
                return back()->withErrors(['error' => 'ID dello sponsor non valido.']);
        }
        
        if (isset($data['payment_Method_Nonce'])) {
            $result = $gateway->transaction()->sale([
                'amount' => $amount,
                'paymentMethodNonce' => $data['payment_Method_Nonce'],
                'options' => [
                    'submitForSettlement' => true
                ]
            ]);
        } else {
            return back()->withErrors(['error' => 'Nonce di pagamento non presente.']);
        }

        if ($result->success) {
            return view('admin.payment.checkout', compact('result'));
        } else {
            $errorMessage = $result->message ?? 'Errore durante il pagamento con Braintree.';
            return back()->withErrors(['error' => $errorMessage]);
        }
    }
}
