@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-light">Add Your Own Category</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                        <form method="post" action="{{route('category.store')}}" class="row">
                            @csrf
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Category Type:</label>
                                    <select name="cat_type" id="" class="form-control">
                                        @foreach($category_type as $cat)
                                        <option value="{{$cat->id}}">{{$cat->type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Category Name:</label>
                                    <input type="text" name="category_name" class="form-control" placeholder="Enter Category Name">
                                    @error('category_name')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Create">
                                </div>
                            </div>
                            @if (session('success') != null) 
                                <div class="col-md-12 alert alert-success alert-block" style="margin-bottom:0px !important">{{ session('success') }} </div>
                            @endif
                        </form>
                </div>
            </div>
        </div>
    </div>
    

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-light">Add Transaction</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                        <form method="post" action="{{route('trans.store')}}" class="row">
                            @csrf
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Choose Category:</label>
                                    <select name="category" id="" class="form-control">
                                        @foreach($categories as $cat)
                                        <option value="{{$cat->id}}">{{$cat->cat_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Amount:</label>
                                    <input type="text" name="amount" class="form-control" placeholder="Enter Amount">
                                    @error('amount')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Note:</label>
                                    <textarea name="note" id="" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Create">
                                </div>
                            </div>
                            @if (session('success_trans') != null) 
                                <div class="col-md-12 alert alert-success alert-block" style="margin-bottom:0px !important">{{ session('success_trans') }} </div>
                            @elseif (session('failed_trans') != null)
                            <div class="col-md-12 alert alert-danger alert-block" style="margin-bottom:0px !important">{{ session('failed_trans') }} </div>
                            @endif
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
