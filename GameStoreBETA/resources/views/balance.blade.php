@extends('layouts.master')

@section('title', $title)

@section('content')

<h1 class='text-center text-3xl'>Invoices</h1>

<div id="invoices" class="border w-4/5 mx-auto mt-2 text-center">

<div class="flex flex-wrap">
     <h1 class="text-xl border-b invoice">ID</h1>

     <h1 class="text-xl border-b invoice">PRICE</h1>

     <h1 class="text-xl border-b invoice">TYPE</h1>

     <h1 class="text-xl border-b invoice">DATE</h1>
</div>

<div id="invoices-list" class="flex flex-wrap overflow-hidden scrollbar-thin scrollbar-thumb-gray-800 scrollbar-track-bg-color">
     @foreach ($invoices as $invoice)
        <span class="invoice">{{$invoice->id}}</span>
        <span class="invoice <?php if($invoice->type == 0){echo 'text-green-600';} else echo 'text-red-600';?>">{{$invoice->total_price}}€</span>
        <span class="invoice"><?php if($invoice->type == 0){echo 'Deposit';} else echo 'Purchase';?></span>
        <span class="invoice">{{$invoice->created_at}}</span>
     @endforeach
</div>

</div>

<payment></payment>


@stop