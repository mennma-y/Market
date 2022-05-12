<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    use HasFactory;
    protected $fillable =[
        'stock_id',
        'user_id',
    ];

    public function showcart()
    {
        $user = \Auth::user();
        $data['mycarts'] = $this->where('user_id',$user['id'])->get();

        $data['count']=0;
        $data['sum']=0;

        foreach($data['mycarts'] as $mycart){
            $data['count']++;
            $data['sum'] +=$mycart->stock['fee'];
        }

        return $data;

    }

    public function stock()
    {
        return $this->belongsTo('\App\Models\Stock');
    }

    public function addCart($stock_id)
    {
        $user_id = Auth::id(); 
        $cartaddinfo = Cart::firstOrCreate(['stock_id' => $stock_id,'user_id' => $user_id]);

        if($cartaddinfo->wasRecentlyCreated){
            $message = 'カートに追加しました';
        }
        else{
            $message = 'カートに登録済みです';  
        }

        return $message;

    }

    public function deleteCart($stock_id)
    {
        $user_id = \Auth::id();
        $delete = $this->where('user_id',$user_id)->where('stock_id',$stock_id)->delete();
        if($delete > 0){
            $message = 'カートから一つの商品を削除しました';
        }else{
            $message = '削除に失敗しました';
        }
        return $message;
    }

    public function checkoutCart()
    {
        $user_id = \Auth::id();
        $checkoutitem = $this->where('user_id',$user_id)->get();
        $this->where('user_id',$user_id)->delete();

        return $checkoutitem;
    }
}

        
            
    

