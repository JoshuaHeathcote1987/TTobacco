<?php

namespace App\Http\Controllers\Customer;

use App\Purchase;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

use Auth;
use Carbon\Carbon;

class PurchaseController extends BaseController
{
    var $page = '/user/purchase/read';
    var $table = 'purchases';
    
    public function index()
    {
        $data = DB::table('products')
        ->join($this->table, 'item_id', '=', 'products.id')
        ->where($this->table.'.user_id', '=', Auth::user()->id)
        ->get();

        foreach ($data as $item)
        {
            $date = date_create($item->created_at);
            $item->created_at = date_format($date, "d/m/Y");
        }

        if(!empty($data))
        {
            return view($this->page, ['items' => $data]);
        }
        else
        {
            return abort(404);
        }
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        
    }

    public function show(Purchase $purchase)
    {
        
    }

    public function edit(Purchase $purchase)
    {
        
    }

    public function update(Request $request, Purchase $purchase)
    {
        
    }

    public function destroy(Purchase $purchase)
    {
        
    }
}
