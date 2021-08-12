<?php

namespace App\Http\Controllers;

use App\Product;
use PayPal\Api\Item;
use PayPal\Api\Payer;
use App\Facade\PayPal;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Payment;
use PayPal\Api\ItemList;
use PayPal\Api\WebProfile;
use PayPal\Api\InputFields;
use PayPal\Api\Transaction;
use Illuminate\Http\Request;
use PayPal\Api\RedirectUrls;
use App\Mail\SendMailPurchase;
use PayPal\Api\PaymentExecution;
use Illuminate\Support\Facades\Mail;

class ShopController extends Controller
{
    //
    public function index(){
        $products = Product::all();
        return view('shop.index',compact('products'));
    }
    public function show(Product $product){
       
        return view('shop.show',compact('product'));
    }
    public function order($id, Request $request){
      
        $product = Product::findOrFail($id);
        $apiContext = PayPal::apiContext();
      //  dd($apiContext);
       // require __DIR__ . '/../bootstrap.php';

        // ### Payer
        // A resource representing a Payer that funds a payment
        // For paypal account payments, set payment method
        // to 'paypal'.
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        // ### Itemized information
        // (Optional) Lets you specify item wise
        // information
        $item1 = new Item();
        $item1->setName($product->title)
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setSku($product->id) // Similar to `item_number` in Classic API
            ->setPrice($product->price)
            ->setDescription($product->description);
        
        $itemList = new ItemList();
        $itemList->setItems(array($item1));

        // ### Additional payment details
        // Use this optional field to set additional
        // payment information such as tax, shipping
        // charges etc.
        $details = new Details();
        $details->setShipping(2)
            ->setTax(2)
            ->setSubtotal($product->price);
          

        // ### Amount
        // Lets you specify a payment amount.
        // You can also specify additional details
        // such as shipping, tax.
        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal($product->price + 4)
            ->setDetails($details);

        // ### Transaction
        // A transaction defines the contract of a
        // payment - what is the payment for and who
        // is fulfilling it. 
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(uniqid());

        // ### Redirect urls
        // Set the urls that the buyer must be redirected to after 
        // payment approval/ cancellation.
        //$baseUrl = getBaseUrl();
       // $baseUrl = 'http://localhost:8000/';
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('order.execute',$id))
            ->setCancelUrl(route('shop.index'));
        // Add no shipping option....
        $inputFields = new InputFields();
        $inputFields->setNoShipping(1);

        $webProfile = new WebProfile();
        $webProfile->setName('Personal Blog Webshop'.uniqid())->setInputFields($inputFields);
        $webProfileId = $webProfile->create($apiContext)->getId();

        // ### Payment
        // A Payment Resource; create one using
        // the above types and intent set to 'sale'
        $payment = new Payment();
       // $payment->setExperienceProfileId($webProfile); // remove the ships to labels...
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setExperienceProfileId($webProfileId)
            ->setTransactions(array($transaction));


        // For Sample Purposes Only.
        $request = clone $payment;

        // ### Create Payment
        // Create a payment by calling the 'create' method
        // passing it a valid apiContext.
        // (See bootstrap.php for more on `ApiContext`)
        // The return object contains the state and the
        // url to which the buyer must be redirected to
        // for payment approval
        
        try {
            $payment->create($apiContext);
            
        } catch (Exception $ex) {
            // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
            print("Created Payment Using PayPal. Please visit the URL to Approve.". $request);
            exit(1);
        }

        // ### Get redirect url
        // The API response provides the url that you must redirect
        // the buyer to. Retrieve the url from the $payment->getApprovalLink()
        // method
        $approvalUrl = $payment->getApprovalLink();
        
       
        // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
       // print("Created Payment Using PayPal. Please visit the URL to Approve.". "<a href='".$approvalUrl."' >".$approvalUrl."</a>");

        return redirect($approvalUrl) ;
            }
    public function executeOrder(){
      //  dd('sssssss');
        $apiContext = PayPal::apiContext();
        //if (isset($_GET['success']) && $_GET['success'] == 'true') {
            // Get the payment Object by passing paymentId
            // payment id was previously stored in session in
            // CreatePaymentUsingPayPal.php
            $paymentId = $_GET['paymentId'];
            
            $payment = Payment::get($paymentId, $apiContext);
            // ### Payment Execute
            // PaymentExecution object includes information necessary
            // to execute a PayPal account payment.
            // The payer_id is added to the request query parameters
            // when the user is redirected from paypal back to your site
            $execution = new PaymentExecution();
            $execution->setPayerId($_GET['PayerID']);
           // dd($_GET['PayerID']);
            // ### Optional Changes to Amount
            // If you wish to update the amount that you wish to charge the customer,
            // based on the shipping address or any other reason, you could
            // do that by passing the transaction object with just `amount` field in it.
            // Here is the example on how we changed the shipping to $1 more than before.
           // $transaction = new Transaction();
            //dd($transaction);
           // $amount = new Amount();
           // $amount = new Amount();
          //  $transaction->setAmount($amount);
            // Add the above transaction object inside our Execution object.
           // $execution->addTransaction($transaction);
            
            try {
                // Execute the payment
                // (See bootstrap.php for more on `ApiContext`)
                
                $result = $payment->execute($execution, $apiContext);
                
                // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
                print("Executed Payment1".$payment->getId()."Result: ". $result);
                

                try {
                    $payment = Payment::get($paymentId, $apiContext);
                    // Email the purchase details...
                    $paymentInfo = json_decode($payment);
                    
                    Mail::to($paymentInfo->payer->payer_info->email)
                        ->bcc('webshop-admin@localhost:8000')
                        ->send(new SendMailPurchase($paymentInfo));

                } catch (Exception $ex) {
                    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
                    print("Get Payment 1" );
                    return redirect(route('shop.index'));
                    exit(1);
                }
            } catch (Exception $ex) {
                // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
                print("Executed Payment 2");
                return redirect(route('shop.index'));
                
            }
            // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
            print("Get Payment".$payment->getId().",". $payment);
            return $payment;
        
    }
}
