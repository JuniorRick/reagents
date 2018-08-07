@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="content">
                        <div class="title m-b-md crdm">
                          CRDM
                        </div>

                        <div class="links">
                            <a href="/reagents">Reagenti</a>
                            @if(auth()->user()->can('create orders') || auth()->user()->hasRole('admin'))
                              <a href="/orders">Eliberare noua</a>
                            @endif
                            <a href="/orders/all">Eliberari totale</a>
                            @if(Auth::user()->hasRole('admin'))
                              <a href="/people">Persoane</a>
                              <a href="/producers">Producatori</a>
                              <a href="/settings">Setari</a>
                              <a style="color: #6f1c1c" href="/report/usage">Raport Laborator</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
