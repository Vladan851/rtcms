@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                    
                    <?php
                        $pom = 'http://radiotrebinje.com/trebinjske-kosarkasice-u-finalu-kupa-srpske/';
                        $x = explode("/", $pom, 5);
                        var_dump($x);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
