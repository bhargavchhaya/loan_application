@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Loans') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Client ID</th>
                            <th scope="col">EMIs</th>
                            <th scope="col">First EMI Date</th>
                            <th scope="col">Last EMI Date</th>
                            <th scope="col">Loan Amount</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach($loans as $loan)
                            <tr>
                                <th scope="row">{{$loan->id}}</th>
                                <td>{{$loan->clientid}}</td>
                                <td>{{$loan->num_of_payment}}</td>
                                <td>{{$loan->first_payment_date}}</td>
                                <td>{{$loan->last_payment_date}}</td>
                                <td>{{$loan->loan_amount}}</td>
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
