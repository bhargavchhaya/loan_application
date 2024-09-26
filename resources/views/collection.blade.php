@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 text-center">
            <form action="{{ route('loan_collection_schedule') }}" method="post" id="collectionData">
                @csrf
                <button type="submit" class="btn btn-medium btn-primary">Process Data</button>
            </form>
        </div>
        <br><br><br>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Loans Collection Schedule') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered" id="collectionDataTable">
                            <thead id="collectionDataTableHeader">
                            </thead>
                            <tbody class="table-group-divider" id="collectionDataTableBody">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
