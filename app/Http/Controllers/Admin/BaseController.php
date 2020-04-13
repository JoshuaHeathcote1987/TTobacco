<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    protected $table;       // Database table name
    protected $cv;          // Create view
    protected $rv;          // Read view
    protected $rsv;         // Read single view
    protected $ev;          // Edit view
    protected $sf;          // Search functionality

    public function __construct() {
        
    }

    public function create() 
    {
        return view($this->cv);
    }

    public function read() 
    {
        if ($data = DB::table($this->table)->simplePaginate(15))
        {
            return view($this->rv, [$this->table => $data]);
        }
        else 
        {
            return abort(404);
        }
    }

    public function readSingle($slug) 
    {
      if ($data = DB::table($this->table)->where('id', $slug)->first())
      {
          return view($this->rsv, [$this->table => $data]);
      }
      else 
      {
          return abort(404);
      }
    }

    public function edit($slug) 
    {
        if ($data = DB::table($this->table)->where('id', $slug)->first())
        {
            return view($this->ev, [$this->table => $data]);
        }
        else 
        {
            return abort(404);
        }
    }

    public function delete($slug)
    {
        if (DB::table($this->table)->where('id', '=', $slug)->delete())
        {
            return redirect()->route($this->table);
        } 
        else 
        {
            return abort(404);
        }
    }

    public function search(Request $request)
    {
        if ($data = DB::table($this->table)->where('name', $request->input('search'))->first())
        {
            return view($this->rsv, [$this->table => $data]);
        }
        else 
        {
            return abort(404);
        }
    }
}