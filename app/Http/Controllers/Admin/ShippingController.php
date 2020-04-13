<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ShippingController extends BaseController
{
    public function __construct() { 
        parent::__construct();
        $this->table = "shippings"; 
        $this->cv = "admin/shipping/create";
        $this->rv = "admin/shipping/read";
        $this->rsv = "admin/shipping/read-shipping";
        $this->uv = "admin/shipping/update";
    }
}
