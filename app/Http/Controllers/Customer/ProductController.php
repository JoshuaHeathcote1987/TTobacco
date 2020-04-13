<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Auth;

class ProductController extends BaseController
{
    public function __construct() { 
        parent::__construct();
        $this->tablex = "products";       
        $this->rv = "user/product/read";
        $this->rsv = "user/product/read-single";
    }

    public function index()
    {
        $data = DB::table($this->tablex)
        ->orderBy('gram', 'desc')
        ->get();
        return view($this->rv, [$this->tablex => $data]);
    }
}