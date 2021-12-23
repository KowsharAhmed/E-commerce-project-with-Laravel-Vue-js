@extends('admin.layouts.master')
  
@section('main-content')  
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Categories | <a href="{{ route('categories.create') }}">Add New</a></h1>
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
                        <h5 class="m-0">Category List</h5>
                    </div>
                    <div class="card-body">
                    @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                    @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        <table class="table table-bordered">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                          <tbody>
                            @foreach ($categories as $singleCategory)
                               <tr>
                                   <td> {{ $singleCategory->id }} </td>
                                   <td> {{ $singleCategory->name }} </td>
                                   <td>
                                       <a class="btn btn-sm btn-info" href="{{ route('categories.edit',$singleCategory->id) }}">Edit</a>|
                                       <form onsubmit="confirm('Do you really want to delete this?');" class="d-inline" action="{{ route('categories.destroy', $singleCategory->id) }}" method="POST">
                                       @method('DELETE')
                                       @csrf
                                       <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                       </form>
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
  

