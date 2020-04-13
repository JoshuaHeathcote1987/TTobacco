<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class CartController extends BaseController
{
    public function __construct() { 
        parent::__construct();
        $this->table = "carts";  
        $this->cv = "admin/cart/create";
        $this->rv = "admin/cart/read"; 
        $this->rsv = "admin/cart/read-order";
        $this->uv = "admin/cart/update";
    }
}
