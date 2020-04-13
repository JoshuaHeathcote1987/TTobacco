<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class TransactionController extends BaseController
{
    public function __construct() { 
        parent::__construct();
        $this->table = "transactions"; 
        $this->cv = "admin/transaction/create";
        $this->rv = "admin/transaction/read";
        $this->rsv = "admin/transaction/read-transactions";
        $this->uv = "admin/transaction/update";
    }
}
