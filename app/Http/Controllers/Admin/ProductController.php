<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ProductController extends BaseController
{
    public function __construct() { 
        parent::__construct();
        $this->table = "products"; 
        $this->cv = "admin/product/create";
        $this->rv = "admin/product/read";
        $this->rsv = "admin/product/read-single";
        $this->uv = "admin/product/update";
        $this->ev = "admin/product/edit";
    }

    public function read() 
    {
        if ($data = DB::table($this->table)->orderBy('gram', 'desc')->orderBy('price', 'desc')->simplePaginate(15))
        {
            return view($this->rv, [$this->table => $data]);
        }
        else 
        {
            return abort(404);
        }
    }

    public function store(Request $request, $id)
    {
        $fileNameToStore;

        if($request->hasFile('image')) 
        {
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/img/product', $fileNameToStore);
        }
        else 
        {
            $fileNameToStore = 'noimage.png';
        }

        if(DB::table($this->table)->insert(
            [   
                'name' => $request->input('name'), 
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'gram' => $request->input('kilogram'),
                'type' => $request->input('type'),
                'img' => $fileNameToStore,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now() ,
            ]
        ))
        {
            return redirect()->route('products');
        }
        else 
        {
            return abort(404);
        }
    }

    public function update(Request $request, $id)
    {
        if($request->hasFile('image') != true)
        {
            if(DB::table($this->table)
                ->where('id', $id)
                ->update([
                    'name' => $request->input('name'), 
                    'description' => $request->input('description'),
                    'price' => $request->input('price'),
                    'gram' => $request->input('kilogram'),
                    'type' => $request->input('type'),
                    'created_at' => Carbon::now(),
                ]))
                {
                    return redirect()->route($this->table);
                }
                else 
                {
                    return abort(404);
                }
        }
        else
        {
            if(DB::table($this->table)
                ->where('id', $request->input('id'))
                ->update(array
                (
                    'name' => $request->input('name'), 
                    'description' => $request->input('description'),
                    'price' => $request->input('price'),
                    'gram' => $request->input('kilogram'),
                    'type' => $request->input('type'),
                    'img' => $request->input('image'),
                    'created_at' => Carbon::now(),
                )
                ))
                {
                    return redirect()->route($this->table);
                }
                else 
                {
                    return abort(404);
                }
        }
    }
}
