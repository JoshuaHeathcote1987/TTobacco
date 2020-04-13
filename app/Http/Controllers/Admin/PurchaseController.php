<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends BaseController
{
    var $table_purchases        = 'purchases';
    var $table_users            = 'users';
    var $table_shippings        = 'shippings';
    var $table_products         = 'products';

    var $page_purchase          = '/admin/purchase/read';

    public function index()
    {
        try
        {
            $data = DB::table('purchases')
            ->join('shippings', 'shippings.id', 'purchases.shipping_id')
            ->join('products', 'products.id', 'purchases.item_id')
            ->select('purchases.id', 'products.name', 'shippings.address', 'shippings.address_2', 'shippings.country', 'shippings.zip', 'purchases.amount', 'purchases.sent', 'purchases.created_at')
            ->orderBy('purchases.created_at', 'desc')
            ->get();

            return view($this->page_purchase, [$this->table_purchases => $data]);
        }
        catch (Exception $e)
        {
            return abort(404);
        }
    }

    public function updateSent(Request $request, $id)
    {
        try
        {
            $sent = $request->input('checkbox');
            if ($sent == 1)
            {
                DB::table($this->table_purchases)
                    ->where('id', $id)
                    ->update(['sent' => 1, 'updated_at' => Carbon::now()]);
            }

            if ($sent == 0)
            {
                DB::table($this->table_purchases)
                    ->where('id', $id)
                    ->update(['sent' => 0, 'updated_at' => Carbon::now()]);
            }

            if (!isset($sent))
            {
                DB::table($this->table_purchases)
                    ->where('id', $id)
                    ->update(['sent' => 0, 'updated_at' => Carbon::now()]);
            }
            
            return redirect('purchase');
        }
        catch (Exception $e) 
        {
            return abort(404);
        }
    }

    public function create() { }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
