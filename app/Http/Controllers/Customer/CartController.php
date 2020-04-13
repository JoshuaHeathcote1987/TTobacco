<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

use Auth;
use Carbon\Carbon;

class CartController extends BaseController
{
    public function __construct() { 
        parent::__construct();
        $this->tablex = "carts";  
        $this->rv = "user/cart/read";
    }

    public function index()
    {   
        $data = DB::table($this->tablex)
            ->join('users', 'users.id', '=', $this->tablex.'.user_id')
            ->join('products', 'products.id', '=', $this->tablex.'.product_id')
            ->select('products.id', 'products.name', 'products.img','products.gram', 'carts.amount', 'products.price')
            ->where($this->tablex.'.user_id', '=', Auth::user()->id)
            ->get();

        if($data)
        {
            return view($this->rv, ['products' => $data]);
        }
        else 
        {
            return abort(404);
        }
    }

    public function create(Request $request, $slug)
    {
        $data = DB::table($this->tablex)->get();

        foreach ($data as $item)
        {
            if ($item->product_id == $slug && Auth::user()->id == $item->user_id) 
            {
                $request->session()->flash('warning-status', 'You already have that item in your shopping cart.');
                return redirect()->route('user-products');
            }
        }     
        
        if(DB::table($this->tablex)->insert(
            [   
                'product_id' => $slug, 
                'user_id' => Auth::user()->id,
                'amount' => $request->input('amount'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
            ))
            {
                $request->session()->flash('success-status', 'The item has been added to your cart.');
                return redirect()->route('user-products');
            }
            else 
            {
                return abort(404);
            }
    }

    public function delete(Request $request, $slug)
    {
        if(DB::table($this->tablex)->where('user_id', '=', Auth::user()->id)->where('product_id', '=', $slug)->delete())
        {
            $request->session()->flash('delete-status', 'You have successfully removed your item.');
            return redirect()->route('user-carts');
        }
        else 
        {
            return abort(404);
        }
    }

    public function removeAll(Request $request)
    {
        if(DB::table($this->tablex)->where('user_id', '=', Auth::user()->id)->delete())
        {
            $request->session()->flash('delete-all-status', 'You have successfully removed everything in your cart.');
            return redirect()->route('user-carts');
        }
        else 
        {
            return abort(404);
        }
    }
}
