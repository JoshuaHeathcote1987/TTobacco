<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

use Auth;
use Carbon\Carbon;

class CheckoutController extends BaseController
{
    var $input_id = 0;

    public function __construct() { 
        parent::__construct();
        $this->table_carts = "carts";  
        $this->table_shippings = "shippings";
        $this->rv = "user/checkout/read";
    }

    public function checkout(Request $request)
    {
        $data = array(
            $this->table_carts => DB::table($this->table_carts)
            ->join('users', 'users.id', '=', $this->table_carts.'.user_id')
            ->join('products', 'products.id', '=', $this->table_carts.'.product_id')
            ->select('products.name', 'products.price', 'carts.amount')
            ->where($this->table_carts.'.user_id', '=', Auth::user()->id)
            ->get(),

            $this->table_shippings => DB::table($this->table_shippings)
            ->where($this->table_shippings.'.user_id', '=', Auth::user()->id)
            ->get(),

            'my_shipping_address' => 0,

            'input_id' => $this->input_id,
        );

        if(count($data[$this->table_carts]) > 0)
        {
            return view($this->rv, ['datas' => $data]);
        }
        else 
        {
            $request->session()->flash('empty-status', 'Your cart is empty.');
            return redirect()->route('user-carts');
        }
    }

    public function updateAddress(Request $request) 
    {
        $this->input_id = $request->input('select_address');

        $data = array(
            $this->table_carts => DB::table($this->table_carts)
            ->join('users', 'users.id', '=', $this->table_carts.'.user_id')
            ->join('products', 'products.id', '=', $this->table_carts.'.product_id')
            ->where($this->table_carts.'.user_id', '=', Auth::user()->id)
            ->get(),

            $this->table_shippings => DB::table($this->table_shippings)
            ->where($this->table_shippings.'.user_id', '=', Auth::user()->id)
            ->get(),

            'my_shipping_address' => DB::table('shippings')->where('id', $this->input_id)->first(),

            'input_id' => $this->input_id,
        );
        return view($this->rv, ['datas' => $data]);
    }
}
