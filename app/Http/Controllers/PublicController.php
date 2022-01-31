<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Item;
use Session;

class PublicController extends Controller
{
    //

    public function index()
    {

        if (request()->category){

            $items = Item::where('category_id','=', request()->id); 
        }else{
        $categories = Category::orderBy('name','ASC')->paginate(10);
       // $items = Item::all()->sortBy('category_id');
        $items = Item::all();
        }

        return view('public.index')->with('categories',$categories)->with('items', $items);
    }

    public function show($id)
    {

        $categories = Category::orderBy('name','ASC')->paginate(10);

        $items = Item::where('category_id',$id)->get();
        
        return view('public.index')->with('categories',$categories)->with('items', $items);
    }

}
