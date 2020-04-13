<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class OrderController extends BaseController
{
    public function __construct() { 
        parent::__construct();
        $this->table = "orders"; 
        $this->cv = "admin/order/create";
        $this->rv = "admin/order/read";
        $this->rsv = "admin/order/read-order";
        $this->ev = "admin/order/edit";
        $this->uv = "admin/order/update";
    }

    public function create() 
    {
        $data = [
            'users' => DB::table('users')->get(),
            'products' => DB::table('products')->get()
        ];
        return view($this->cv, ['data' => $data]);
    }

    public function edit($slug)
    {
        $data = [
            'orders' => DB::table($this->table)->where('id', $slug)->first(),
            'users' => DB::table('users')->get(),
            'products' => DB::table('products')->get()
        ];
        return view($this->ev, ['data' => $data]);
    }

    public function store(Request $request)
    {
        if(DB::table($this->table)->insert(
            [   
                'user_id' => $request->input('user'), 
                'product_id' => $request->input('product'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now() 
            ]
        ))
        {
            return redirect()->route('orders');
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
                    'user_id' => $request->input('user'), 
                    'product_id' => $request->input('product'),
                    'created_at' => Carbon::now()
                )
            ))
            {
                return redirect()->route('orders');
            }
            else 
            {
                return abort(404);
            }
    }
}
