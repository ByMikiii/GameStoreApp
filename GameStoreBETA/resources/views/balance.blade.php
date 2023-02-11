@extends('layouts.master')

@section('title', $title)

@section('content')


<h1 class='text-center text-3xl heading mb-5'>Obejdnávky</h1>

<div class="flex flex-wrap bg-scnd-color rounded-t-md">
     <h1 class="text-xl border-b border-bg-color invoice-header mt-1">ID</h1>

     <h1 class="text-xl border-b border-bg-color invoice-header mt-1">CENA</h1>

     <h1 class="text-xl border-b border-bg-color invoice-header mt-1">TYP</h1>

     <h1 class="text-xl border-b border-bg-color invoice-header mt-1">DÁTUM</h1>
</div>


<div id="invoices" class="bg-scnd-color rounded-b-md mx-auto mb-5 text-center">

<div class="h-full flex flex-wrap content-start overflow-y-scroll scrollbar-thin scrollbar-thumb-gray-800 scrollbar-track-bg-color">
     @foreach ($invoices as $invoice)
        <span class="invoice">{{$invoice->id}}</span>
        <span class="invoice <?php if($invoice->type == 0){echo 'text-green-600';} else echo 'text-red-600';?>">{{$invoice->total_price}}€</span>
        <span class="invoice"><?php if($invoice->type == 0){echo 'Vklad';} else echo 'Nákup';?></span>
        <span class="invoice">{{$invoice->created_at}}</span>
     @endforeach
</div>

</div>

<payment></payment>

@stop