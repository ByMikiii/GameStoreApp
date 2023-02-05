<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Invoice_item;
use App\Models\User;
use App\Models\OwnedGame;
use Illuminate\Http\Request;
use App\Events\NotificationSent;
use App\Models\Invoice;



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

            $invoice = new Invoice();
            $invoice->user_id = Auth::user()->id;
            $invoice->total_price = $totalprice;
            $invoice->type = 1;
            $invoice->save();

            foreach($basketitems as $basketitem){
                OwnedGame::create([
                    'user_id' => Auth::user()->id,
                    'game_id' => $basketitem->id
                ]);

                Invoice_item::create([
                'invoice_id' => $invoice->id,
                'game_id' => $basketitem->id,
                'quantity' => 1,
                ]);

            }
            Auth::user()->decrement('wallet', $totalprice);

            broadcast(new NotificationSent('Purchase successfull!', Auth::user(), 'green'));
        }else{
        broadcast(new NotificationSent('You do not have enough money!', Auth::user(), 'red'));

        }

    }
}
