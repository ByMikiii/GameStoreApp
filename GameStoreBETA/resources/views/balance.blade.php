@extends('layouts.master')

@section('title', $title)

@section('content')

<?php
if(Auth::check()){
App::setLocale(Auth::user()->locale);
}else App::setLocale('sk');
?>

<h1 class='text-center text-3xl heading mb-5 '>{{__('balance.orders')}}</h1>

<div class="flex flex-wrap bg-scnd-color rounded-t-md">
     <h1 class="text-xl border-b border-bg-color invoice-header mt-1">Id</h1>

     <h1 class="text-xl border-b border-bg-color invoice-header mt-1">{{__('balance.price')}}</h1>

     <h1 class="text-xl border-b border-bg-color invoice-header mt-1">{{__('balance.type')}}</h1>

     <h1 class="text-xl border-b border-bg-color invoice-header mt-1">{{__('balance.date')}}</h1>
</div>


<div id="invoices" class="bg-scnd-color rounded-b-md mx-auto mb-5 text-center">

<div class="h-full flex flex-wrap content-start overflow-y-scroll scrollbar-thin scrollbar-thumb-gray-800 scrollbar-track-bg-color">
     @foreach ($invoices as $invoice)
        <span class="invoice">{{$invoice->id}}</span>
        <span class="invoice <?php if($invoice->type == 0){echo 'text-green-600';} else echo 'text-red-600';?>">{{$invoice->total_price}}€</span>
        <span class="invoice"><?php if($invoice->type == 0){echo __('balance.deposit');} else echo __('balance.purchase');?></span>
        <span class="invoice">{{$invoice->created_at->format('d. m. Y')}}</span>
     @endforeach
</div>

</div>

<h2 class="text-3xl heading mb-2">{{__('balance.deposit')}}</h2>
<payment></payment>

@stop