@extends('admin.layouts.master')
  
@section('main-content')  
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Order List</h1>
                </div>
                <div class="col-sm-6">
                   
                </div>
            </div>
        </div>
    </div>

   <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0">Order List</h5>
                    </div>
                    <div class="card-body">
                    @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                    @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        {{-- <div class="bg-warning">
                            <p>Max Order product</p>
                            <p><b>Name:</b>{{ $summary->name }}</p>
                            <p><b>Total Order:</b>{{ $summary->total_qty }}</p>
                            <p><b>Total Amount:</b>{{ $summary->total_amount }}</p>
                        </div> --}}
                        <table class="table table-bordered">
                            <tr>
                                <th>ID</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Total amount</th>
                                <th>Customer Phone</th>
                                <th>Deliver Status</th>
                                <th>Action</th>
                            </tr>
                          <tbody>
                            @foreach ($orders as $order)
                               <tr>
                                   <td> {{ $order->id }} </td>
                                   <td> {{ $order->product->name }} </td>
                                   <td> {{ $order->price }} </td>
                                   <td> {{ $order->qty }} </td>
                                   <td> {{ $order->total_amount }} </td>
                                   <td> {{ $order->phone }} </td>
                                   <td> {{ $order->is_deliver?'Delivered':'Pending' }} </td>
                                   <td>
                                       @if(!$order->is_deliver)
                                       <a class="btn btn-sm btn-warning" href="{{ route('orders.change-status',$order->id) }}">Mark as Delivered</a> | 
                                       @else
                                       <button class="btn btn-sm btn-success">Delivered</button> 

                                       @endif                                   
                                    </td>
                               </tr>
                            @endforeach
                          </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
      </div>
   </div>
</div>
@endsection
  

