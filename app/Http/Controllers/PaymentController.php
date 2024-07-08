// <?php 

// namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use App\Payment;
// use Braintree\Gateway;
// use App\Models\Sponsor;

// class PaymentController extends Controller { 
    // -->
    //
    // public function index(Request $request, Sponsor $sponsor) {

    //     $sponsorId = $request->input('sponsor_id');
    //     $sponsor = Sponsor::find($sponsorId);

    //     return view('admin.payment.index', compact('sponsor'));
    // }

    // public function index(Request $request)
    // {
    //     // Verifica se il parametro 'sponsor_id' è presente nella richiesta
    //     if ($request->has('sponsor_id')) {
    //         // Recupera il valore del parametro 'sponsor_id' dalla richiesta
    //         $sponsorId = $request->input('sponsor_id');

    //         // Utilizza il modello Sponsor per trovare lo sponsor con l'ID specificato
    //         $sponsor = Sponsor::find($sponsorId);

    //         // Verifica se lo sponsor è stato trovato
    //         if (!$sponsor) {
    //             // Gestisci il caso in cui lo sponsor non viene trovato, ad esempio ritornando un errore 404
    //             abort(404, 'Sponsor non trovato');
    //         }
    //     } else {
    //         // Gestione se 'sponsor_id' non è presente nella richiesta
    //         // Ad esempio, potresti decidere di restituire tutti gli sponsor o una lista di default
    //         $sponsor = null; // Oppure, se necessario, una logica alternativa
    //     }

        // Passa i dati dello sponsor alla vista 'admin.payment.index'
    //     return view('admin.payment.index', compact('sponsor'));
    // }

    // public function make(Request $request)
    // {
    //     $gateway = new Gateway([
    //         'environment' => 'sandbox',
    //         'merchantId' => 'v8v2d8ds6x49rzj5',
    //         'publicKey' => 'sgrgsw6zssyh97z9',
    //         'privateKey' => '5809159dbe8181cd28af60274705452b'
    //     ]);

    //     $data = $request->all();
    //     $sponsorId = $request->input('sponsor');

        // Inizializza $result a null per gestire il caso in cui non ci sia nessun risultato valido
        // $result = null;

        // Effettua il pagamento in base all'ID dello sponsor
        // if ($sponsorId == 3) {
        //     $result = $gateway->transaction()->sale([
        //         'amount' => '2.99',
        //         'paymentMethodNonce' => $data['payment_Method_Nonce'],
        //         'options' => [
        //             'submitForSettlement' => true
        //         ]
        //     ]);
        // } elseif ($sponsorId == 2) {
        //     $result = $gateway->transaction()->sale([
        //         'amount' => '5.99',
        //         'paymentMethodNonce' => $data['payment_Method_Nonce'],
        //         'options' => [
        //             'submitForSettlement' => true
        //         ]
        //     ]);
        // } elseif ($sponsorId == 1) {
        //     $result = $gateway->transaction()->sale([
        //         'amount' => '9.99',
        //         'paymentMethodNonce' => $data['payment_Method_Nonce'],
        //         'options' => [
        //             'submitForSettlement' => true
        //         ]
        //     ]);
        // }

    //     // Verifica se c'è un errore durante il processo di pagamento
    //     if ($result->success) {
    //         // Se il pagamento è andato a buon fine, visualizza la vista 'admin.payment.check' con il risultato
    //         return view('admin.payment.check', compact('result'));
    //     } else {
    //         // Se c'è stato un errore durante il pagamento, gestiscilo di conseguenza
    //         $errorMessage = $result->message ?? 'Errore durante il pagamento con Braintree.';
    //         return back()->withErrors(['error' => $errorMessage]);
    //         // Puoi anche gestire l'errore in altri modi, ad esempio ritornando alla pagina precedente con un messaggio di errore
    //     }
    // }
// }
    
    // return response()->json($result); -->
