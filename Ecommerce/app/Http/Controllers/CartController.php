<?php

namespace App\Http\Controllers;

use App\Cart_model;
use App\ProductAtrr_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index(){
        $session_id=Session::get('session_id');
        $cart_datas=Cart_model::where('session_id',$session_id)->get();
        $total_price=0;
        foreach ($cart_datas as $cart_data){
            $total_price+=$cart_data->price*$cart_data->quantity;
        }
        return view('frontEnd.cart',compact('cart_datas','total_price'));
    }

    public function addToCart(Request $request){
        $inputToCart=$request->all();
        Session::forget('discount_amount_price');
        Session::forget('coupon_code');
        $email=Session::get('frontSession');
        if($inputToCart['size']==""){
            return back()->with('message','Please select Size');
        }else{
            $stockAvailable=DB::table('product_att')->select('products_id','stock','sku')->where(['products_id'=>$inputToCart['products_id']
            ])->first();
			//echo "Study PHP at " . $inputToCart['products_id2'] . "<br>";
            if($stockAvailable->stock>=$inputToCart['quantity']){
                $inputToCart['user_email']=$email;
                $session_id=Session::get('session_id');
                if(empty($session_id)){
                    $session_id=str_random(40);
                    Session::put('session_id',$session_id);
                }
                $inputToCart['products_id']=$stockAvailable->products_id;
                $inputToCart['session_id']=$session_id;
                $sizeAtrr=explode("-",$inputToCart['size']);
                $inputToCart['size']=$sizeAtrr[1];
                $inputToCart['product_code']=$stockAvailable->sku;
              
                $count_duplicateItems=Cart_model::where(['products_id'=>$inputToCart['products_id'],
                    'user_email'=>$inputToCart['user_email'],
                    'product_color'=>$inputToCart['product_color'],
                    'size'=>$inputToCart['size']])->count();
               if($count_duplicateItems>0){
                  return back()->with('message','This Item Added already');
                  
                }else{
                    Cart_model::create($inputToCart);
                    //echo "Study PHP at " . $stockAvailable['stock'] . "<br>";
                    return back()->with('message','This Item Added to Cart');
              }
            }else{
				//echo "Study PHP at " . $stockAvailable['stock'] . "<br>";
                return back()->with('message','Stock is not Available!');
            }
        }
    }
    public function deleteItem($id=null){
        $delete_item=Cart_model::findOrFail($id);
        Session::forget('discount_amount_price');
        Session::forget('coupon_code');
        $delete_item->delete();
        return back()->with('message','Deleted Success!');
    }
    public function updateQuantity($id,$quantity){
        Session::forget('discount_amount_price');
        Session::forget('coupon_code');
        $sku_size=DB::table('cart')->select('product_code','size','quantity')->where('id',$id)->first();
        $stockAvailable=DB::table('product_att')->select('stock')->where(['sku'=>$sku_size->product_code,
            'size'=>$sku_size->size])->first();
        $updated_quantity=$sku_size->quantity+$quantity;
        DB::table('cart')->where('id',$id)->increment('quantity',$quantity);
        return back()->with('message','Update Quantity already');
       
        /*
        if($stockAvailable->stock>=$updated_quantity){
        {

        }  
        }else{
			
            return back()->with('message','Stock is not Available!');
        }
*/

    }
}
