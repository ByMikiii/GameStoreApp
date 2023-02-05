<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\OwnedGame;
use Illuminate\Http\Request;
use App\Events\NotificationSent;

class PurchaseController extends Controller
{
    /**
     * Make new purchase (create invoice, add items to library, spent balance)
     */
    public function makePurchase()
    {
        $basketitems = Auth::user()->basketitems()->get();
        $totalprice = 0;
        foreach($basketitems as $basketitem){
            if($basketitem->is_sale == 1){
                $totalprice += $basketitem->sale_price;
            }else{$totalprice += $basketitem->original_price;}  
        }

        if($totalprice <= Auth::user()->wallet){
            foreach($basketitems as $basketitem){
                OwnedGame::create([
                    'user_id' => Auth::user()->id,
                    'game_id' => $basketitem->id
                ]);
            }
            Auth::user()->decrement('wallet', $totalprice);

            $invoice = new Invoice();
            $invoice->user_id = Auth::user()->id;
            $invoice->total_price = $totalprice;
            $invoice->type = 1;
            $invoice->save();

            broadcast(new NotificationSent('Purchase successfull!', Auth::user(), 'green'));
        }else{
        broadcast(new NotificationSent('You do not have enough money!', Auth::user(), 'red'));

        }

    }
}
