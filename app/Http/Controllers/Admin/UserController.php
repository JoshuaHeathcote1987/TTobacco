<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class UserController extends BaseController
{
    public function __construct() { 
        parent::__construct();
        $this->table = "users"; 
        $this->cv = "admin/user/create";
        $this->rv = "admin/user/read"; 
        $this->rsv = "admin/user/read-single";
        $this->ev = "admin/user/edit";
    }

    public function store(Request $request)
    {
        if(DB::table($this->table)->insert(
            [   
                'name' => $request->input('name'), 
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'is_admin' => $request->input('is_admin'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now() 
            ]
        ))
        {
            return redirect()->route('read-users');
        }
        else 
        {
            return abort(404);
        }
    }

    public function update(Request $request)
    {
        if(DB::table($this->table)
            ->where('id', $request->input('id'))
            ->update(array
                (
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'password' => bcrypt($request->input('password')),
                    'is_admin' => $request->input('is_admin'),
                    'updated_at' => Carbon::now()
                )
            ))
            {
                return redirect()->route('users');
            }
            else 
            {
                return abort(404);
            }
    }

    public function userCart($id)
    {
        $data = [
            'items' => DB::table('carts')
                ->join('products', 'carts.product_id', '=', 'products.id')
                ->join('users', 'carts.user_id', '=', 'users.id')
                ->where('users.id', $id)
                ->select('users.id', 'products.name', 'products.img', 'carts.amount', 'products.price', 'products.gram')
                ->get(),
            'user_id' => $id,
        ];

        return view('admin.user.cart', ['items' => $data]);
    }

    public function userPurchase($id)
    {
        $data = [
            'items' => DB::table('purchases')
                ->join('products', 'purchases.item_id', '=', 'products.id')
                ->join('users', 'purchases.user_id', '=', 'users.id')
                ->join('shippings', 'purchases.shipping_id', '=', 'shippings.id')
                ->where('users.id', $id)
                ->select('users.id', 'products.name','products.img', 'shippings.address', 'shippings.address_2', 'shippings.country')
                ->get(),

            'user_id' => $id,
        ];

        return view('admin.user.purchase', ['items' => $data]);
    }

    public function userTransaction($id)
    {
        $data = [
            'items' => DB::table('transactions')
                ->where('transactions.user_id', $id)
                ->get(),

            'user_id' => $id,
        ];

        return view('admin.user.transaction', ['items' => $data]);
    }
}
