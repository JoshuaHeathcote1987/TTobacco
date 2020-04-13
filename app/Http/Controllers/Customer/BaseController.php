<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use Auth;

class BaseController extends Controller
{
    protected $tablex;       // Database table-name
    protected $tabley;      // Database table-name
    protected $rv;          // Read view
    protected $rsv;         // Read single view
    protected $sf;          // Search functionality 

    public function __construct() {
        
    }

    public function index()
    {
        $data = DB::table($this->tablex)->get();
        return view($this->rv, [$this->tablex => $data]);
    }

    public function readSingle($slug) 
    {
      if ($data = DB::table($this->tablex)->where('id', $slug)->first())
      {
          return view($this->rsv, [$this->tablex => $data]);
      }
      else 
      {
          return abort(404);
      }
    }

    public function search()
    {
        return view($this->sf);
    }
}
