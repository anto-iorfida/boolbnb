<?php
// namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use Braintree\Gateway;
// use App\Models\Sponsor;

// class PaymentController extends Controller
// {
//     public function index(Request $request)
//     {
//         if ($request->has('sponsor_id')) {
//             $sponsorId = $request->input('sponsor_id');
//             $sponsor = Sponsor::find($sponsorId);

//             if (!$sponsor) {
//                 abort(404, 'Sponsor non trovato');
//             }
//         } else {
//             $sponsor = null;
//         }

//         return view('admin.payment.index', compact('sponsor'));
//     }

//     public function process(Request $request)
//     {
//         $gateway = new Gateway([
//             'environment' => 'sandbox',
//             'merchantId' => 'v8v2d8ds6x49rzj5',
//             'publicKey' => 'sgrgsw6zssyh97z9',
//             'privateKey' => '5809159dbe8181cd28af60274705452b'
//         ]);

//         $data = $request->all();
//         $sponsorId = $request->input('sponsor_id');
//         $result = null;

//         switch ($sponsorId) {
//             case 1:
//                 $amount = '9.99';
//                 break;
//             case 2:
//                 $amount = '5.99';
//                 break;
//             case 3:
//                 $amount = '2.99';
//                 break;
//             default:
//                 return back()->withErrors(['error' => 'ID dello sponsor non valido.']);
//         }
        
//         if (isset($data['payment_Method_Nonce'])) {
//             $result = $gateway->transaction()->sale([
//                 'amount' => $amount,
//                 'paymentMethodNonce' => $data['payment_Method_Nonce'],
//                 'options' => [
//                     'submitForSettlement' => true
//                 ]
//             ]);
//         } else {
//             return back()->withErrors(['error' => 'Nonce di pagamento non presente.']);
//         }

//         if ($result->success) {
//             return view('admin.payment.checkout', compact('result'));
//         } else {
//             $errorMessage = $result->message ?? 'Errore durante il pagamento con Braintree.';
//             return back()->withErrors(['error' => $errorMessage]);
//         }
//     }
// }

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree\Gateway;
use App\Models\Sponsor;
use App\Models\Apartment;
use App\Models\ApartmentSponsor;
use Carbon\Carbon;

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
        if ($request->has('id_apartment')) {
            $apartmentId = $request->input('id_apartment');
            $apartment = Apartment::find($apartmentId);

            if (!$apartment) {
                abort(404, 'Apartment non trovato');
            }
        } else {
            $apartment = null;
        }
        

        return view('admin.payment.index', compact('sponsor','apartment'));
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
        $apartmentId = $request->input('id_apartment');
        $result = null;
        // dd($request,$apartmentId);

        switch ($sponsorId) {
            case 1:
                $amount = '9.99';
                $duration = 6;
                break;
            case 2:
                $amount = '5.99';
                $duration = 3; 
                break;
            case 3:
                $amount = '2.99';
                $duration = 1; 
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

            $startTime = Carbon::now();
            $endTime = $startTime->copy()->addDays($duration);

            ApartmentSponsor::create([
                'id_apartment' => $apartmentId,
                'id_sponsor' => $sponsorId,
                'start_time' => $startTime,
                'end_time' => $endTime
            ]);

            return view('admin.payment.checkout', compact('result'));
        } else {
            $errorMessage = $result->message ?? 'Errore durante il pagamento con Braintree.';
            return back()->withErrors(['error' => $errorMessage]);
        }
    }
}

