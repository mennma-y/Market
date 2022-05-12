<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Stock;

use App\Models\Cart;

use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index()
    {
        $stocks = Stock::Paginate(6);
        return view('shop',compact('stocks'));
    }

    public function mycart(cart $cart)
    {
        
        $data = $cart->showCart();
        return view('mycart',$data);
    }

    public function addmycart(Request $request,Cart $cart)
    {
         //カートに追加の処理
        $stock_id=$request->stock_id;
        $message = $cart->addCart($stock_id);

        //追加後の情報を取得
        $data = $cart->showCart();

        return view('mycart',$data)->with('message' , $message);
    }

    public function deletecart(Request $request,Cart $cart)
    {
        $stock_id = $request->stock_id;
        $message = $cart->deleteCart($stock_id);

        $data = $cart->showCart();

        return view('mycart',$data)->with('message',$message); 
    }

    public function checkout(Cart $cart)
    {
        $checkoutitem = $cart->checkoutCart();
        return view('checkout');

    }
}
