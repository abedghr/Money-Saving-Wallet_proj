@extends('layouts.admin-app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-light">All Users List</div>

                <div class="card-body">
                    
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Birth Date</th>
                            <th scope="col">Total Expenses</th>
                            <th scope="col">Total Incomes</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->phone}}</td>
                                    <td>{{$user->birth_date}}</td>
                                    @foreach ($users_inc_expenses as $item)
                                        @if ($item['id'] == $user->id)
                                            <td>{{$item['total_incomes']}} {{$user->wallet}}</td>
                                            <td>{{$item['total_expenses']}} {{$user->wallet}}</td>
                                        @endif
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
