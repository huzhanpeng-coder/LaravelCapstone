<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Item;
use App\Models\Items_sold;
use App\Models\Orders;
use Session;
use Cookie;
use App\shopping_cart;

class PublicController extends Controller
{
    //

    public function index(Request $request)
    {   
        
        $session_id = Session::getId();
        $ip_address = $request->ip();
        //$ip_address = Request::getClientIp();

        Session::put('session_id', $session_id);
        Session::put('ip_address', $ip_address);

        if (request()->category){

            $items = Item::where('category_id','=', request()->id); 
        }else{
        $categories = Category::orderBy('name','ASC')->paginate(10);
       // $items = Item::all()->sortBy('category_id');
        $items = Item::all();
        }

        return view('public.index')->with('categories',$categories)->with('items', $items)->with('session_id', $session_id)->with('ip_address', $ip_address);
    }

    public function single($id)
    {   
        
        $session_id = Session::get('session_id');
        $ip_address = Session::get('ip_address');

        $item = Item::find($id);

        return view('public.singleItem')->with('item', $item)->with('session_id',$session_id)->with('ip_address', $ip_address);
    }

    public function shopping_store($id)
    {   
        
        $session_id = Session::get('session_id');
        $ip_address = Session::get('ip_address');

        $shop_item = new shopping_cart;
        $shop_item->item_id = $id;
        $shop_item->session_id = $session_id;
        $shop_item->ip_address = $ip_address;
        $shop_item->quantity_of_1 = 1;        

        $shop_items = shopping_cart::orderBy('id','ASC')->where('session_id','=',$session_id)->paginate(100);
        $items = Item::orderBy('title','ASC')->paginate(100);

        $flag=true;
        foreach($shop_items as $single_item){
            if($single_item->item_id == $id) {
                   $flag=false;
            }
        }

        if($flag){
            $shop_item->save();
        }    	 	

        $shop_items = shopping_cart::orderBy('id','ASC')->where('session_id','=',$session_id)->paginate(100);
        $items = Item::orderBy('title','ASC')->paginate(100);

        return view('public.shoppingCart')->with('shop_items',$shop_items)->with('items', $items);
    }

    

    public function update_cart(Request $request, $id)
    {   
        $session_id = Session::get('session_id');
        Session::forget('error');

        $shop_item = shopping_cart::find($id);
        $shop_item->quantity_of_1 = $request->quantity_of_1;

        $shop_items = shopping_cart::orderBy('id','ASC')->where('session_id','=',$session_id)->paginate(100);
        $items = Item::orderBy('title','ASC')->paginate(100);
        
        
        foreach($items as $item){
            if($shop_item->item_id == $item->id){
                if($shop_item->quantity_of_1>$item->quantity){
                    Session::flash('error','Not enough items in stock!');
                    return view('public.shoppingCart')->with('shop_items',$shop_items)->with('items', $items);
                }else{
                    Session::flash('success','Cart updated successfully');
                }
            }
        }
        
        //if item quantity is 0 then delete
        if ($shop_item->quantity_of_1 <= 0){
            $shop_item->delete();
        }else{    
            $shop_item->save();
        }

        $shop_items = shopping_cart::orderBy('id','ASC')->where('session_id','=',$session_id)->paginate(100);
        $items = Item::orderBy('title','ASC')->paginate(100);
        
        return view('public.shoppingCart')->with('shop_items',$shop_items)->with('items', $items);
    }

    public function remove_item($id)
    {   
        $session_id = Session::get('session_id');
        
        $shop_item = shopping_cart::find($id);
        $shop_item->delete();
        
        $shop_items = shopping_cart::orderBy('id','ASC')->where('session_id','=',$session_id)->paginate(100);
        $items = Item::orderBy('title','ASC')->paginate(100);
        
        return view('public.shoppingCart')->with('shop_items',$shop_items)->with('items', $items);
    }

    public function check_order(Request $request){

        
        $this->validate($request, ['first_name'=>'required|string|max:255',
                                   'last_name'=>'required|string|max:255',
                                   'email'=>'required|string|max:255',
                                   'phone'=>'required|string']); 

        $order = new Orders;
        $order->First_name = $request->first_name;
        $order->Last_name = $request->last_name;
        $order->Email = $request->email;
        $order->Phone_number = $request->phone;
        $order->Session = Session::get('session_id');

        $order->save();
               
        $shop_items = shopping_cart::orderBy('id','ASC')->where('session_id','=',$order->Session)->paginate(100);
        
        foreach ($shop_items as $shop_item){
            
            $item_sold = new Items_sold;
            $item_sold->item_id = $shop_item->item_id;
            $item_sold->order_id = $order->id;
            $ind_item = Item::find($item_sold->item_id);
            $item_sold->item_price = $ind_item->price; 
            $item_sold->quantity = $shop_item->quantity_of_1;
            $item_sold->save();
            
        }
        
        $items = Item::orderBy('title','ASC')->paginate(100);
        $items_sold = Items_sold::orderBy('id','ASC')->where('order_id','=',$order->id)->paginate(100);
        $customer_orders = Orders::orderBy('id','ASC')->where('session','=',$order->Session)->paginate(100);
        
        return view('public.thankYou')->with('items',$items)->with('items_sold', $items_sold)->with('customer_orders', $customer_orders)->with('current_order',$order);
        
        
    }


    public function view_orders(){

        $all_orders = Orders::orderBy('id','ASC')->paginate(100);
        
        return view('public.view_orders')->with('all_orders', $all_orders);
    }

    public function check_receipt($id){

        
        $order = Orders::find($id);
        
        $items = Item::orderBy('title','ASC')->paginate(100);
        
        $items_sold = Items_sold::orderBy('id','ASC')->where('order_id','=',$order->id)->paginate(100);
        
        $customer_orders = Orders::orderBy('id','ASC')->where('Session','=',$order->Session)->paginate(100);
        
        return view('public.thankYou')->with('items',$items)->with('items_sold', $items_sold)->with('customer_orders', $customer_orders)->with('current_order',$order);
    }

    public function edit($id)
    {   
        return view('public.singleItem');
    }


    public function show($id)
    {
        $session_id = Session::get('session_id');
        $ip_address = Session::get('ip_address');

        $categories = Category::orderBy('name','ASC')->paginate(10);

        $items = Item::where('category_id',$id)->get();
        
        return view('public.index')->with('categories',$categories)->with('items', $items)->with('session_id',$session_id)->with('ip_address', $ip_address);
    }

    public function create(Request $request){

        $session_id = Session::get('session_id');
        $ip_address = Session::get('ip_address');

        dd ($request);

        return view('public.shoppingCart')->with('session_id',$session_id)->with('ip_address', $ip_address);
    }    

}
