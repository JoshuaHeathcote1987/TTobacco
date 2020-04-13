<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

use Auth;
use Carbon\Carbon;

class PaymentController extends BaseController
{
    var $table_carts = 'carts';
    var $table_purchase = 'purchases';
    var $table_shipping ='shippings';
    var $table_transaction = 'transactions';
    var $total = 0;

    function __construct() {}

    public function stripe(Request $request)
    {
        try 
        {
            $shipping_id = 0;

            $payment_form = array(
                'first_name' => $request->input('firstName'),
                'last_name' => $request->input('lastName'),
                'address' => $request->input('address'),
                'address_2' => $request->input('address2'),
                'city' => $request->input('city'),
                'country' => $request->input('country'),
                'zip' => $request->input('postCode'),
                'save_info' => $request->input('saveInfo'),
                'shipping_id' => $request->input('my_shipping_address_id')
            );

            $data = DB::table($this->table_carts)
                ->join('users', 'users.id', '=', $this->table_carts.'.user_id')
                ->join('products', 'products.id', '=', $this->table_carts.'.product_id')
                ->where($this->table_carts.'.user_id', '=', Auth::user()->id)
                ->get();

            foreach ($data as $product) 
            {
                $this->total = $this->total + ($product->price * $product->amount);
            }

            $this->total = $this->total * 100;

            \Stripe\Stripe::setApiKey('sk_test_Q8DKRHdLpZJuY4xIM5B7mKL700nzCg6MAn');

            // Token is created using Stripe Checkout or Elements!
            // Get the payment token ID submitted by the form:
            $token = $_POST['stripeToken'];

            try {
                $charge = \Stripe\Charge::create([
                    'amount' => $this->total,
                    'currency' => 'gbp',
                    'description' => Carbon::now().' '.$request->input('lastName'),
                    'source' => $token,
                ]); 
            } catch(\Stripe\Exception\CardException $e) {
                $request->session()->flash('fail-message', 'Your payment was declined.');
                return redirect()->route('checkout');
            } catch (\Stripe\Exception\RateLimitException $e) {
                $request->session()->flash('fail-message', 'To many requests to the API.');
                return redirect()->route('checkout');
            } catch (\Stripe\Exception\InvalidRequestException $e) {
                $request->session()->flash('fail-message', 'Invalid parameters.');
                return redirect()->route('checkout');
            } catch (\Stripe\Exception\AuthenticationException $e) {
                $request->session()->flash('fail-message', 'There are problems with authentication.');
                return redirect()->route('checkout');
            } catch (\Stripe\Exception\ApiConnectionException $e) {
                $request->session()->flash('fail-message', 'There is a problem with the network.');
                return redirect()->route('checkout');
            } catch (\Stripe\Exception\ApiErrorException $e) {
                $request->session()->flash('fail-message', 'There is a problem with the API.');
                return redirect()->route('checkout');
            } catch (Exception $e) {
                $request->session()->flash('fail-message', 'We don\'t know what happened.');
                return redirect()->route('checkout');
            }

            // Insert shipping address into the DB.
            if ($payment_form['save_info'] == true) 
            {
                DB::table($this->table_shipping)->insert([
                    [
                        'user_id' => Auth::user()->id, 
                        'first_name' => $payment_form['first_name'],
                        'last_name' => $payment_form['last_name'],
                        'address' => $payment_form['address'],
                        'address_2' => $payment_form['address_2'],
                        'city' => $payment_form['city'],
                        'country' => $payment_form['country'],
                        'zip' => $payment_form['zip'],
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(), 
                    ],
                ]);
            }

            DB::table($this->table_transaction)->insert([
                [
                    'user_id' => Auth::user()->id, 
                    'total' => $this->total / 100,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(), 
                ],
            ]);

            $transaction_id = DB::table($this->table_transaction)->count();            

            // Gets the correct shipping ID number to be inserted into the purchase table.
            if ($payment_form['shipping_id'] == 0)
            {
                $payment_form['shipping_id'] = DB::table($this->table_shipping)->count();
            }

            // Takes all data from the cart table and places it into purchase.
            $data = DB::table($this->table_carts)
                ->where('user_id', '=', Auth::user()->id)
                ->get();
        
            
            foreach ($data as $item) {
                DB::table($this->table_purchase)->insert([
                    [
                        'transaction_id' => $transaction_id,
                        'user_id' => Auth::user()->id, 
                        'item_id' => $item->product_id,
                        'shipping_id' => $payment_form['shipping_id'],                            
                        'amount' => $item->amount,  
                        'sent' => false,                   
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ],
                ]);
            }
            
            // Deletes the carts table of any of the users contents.
            DB::table($this->table_carts)
            ->where($this->table_carts.'.user_id', '=', Auth::user()->id)
            ->delete();

            $request->session()->flash('success-status', 'Your payment was successful.');
            return redirect()->route('user-products');
        } 
        catch (Exception $e) 
        {
            $request->session()->flash('warning-status', 'Your payment wasn\'t successful.');
            return redirect()->route('user-products');
        }
    }
    
    public function paypal()
    {
        
    }
}
