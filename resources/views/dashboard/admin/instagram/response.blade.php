@extends('layouts.dashboard.admin', ['title' => 'Freezolar Refrigeração - Administração - Dashboard'])

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">Dashboard</h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">App</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">Dashboard</a>
                        </li>
                    </ol>
                </nav>
            </div>
       </div>
    </div>

    <div class="content">
        <div class="row justify-content-center">
            <div class="col-md-6 col-xl-5">
                <div class="block">
                    <div class="block-header">
                        <h3 class="block-title">Integração com o Instagram</h3>
                    </div>
                    <div class="block-content">
                        @if($was_successful)
                        <div class="alert alert-success">
                            <p>Yes, we can now use your instagram feed</p>
                        </div>
                        @else
                        <div class="alert alert-danger">
                            <p>Sorry, we failed to get permission to use your insagram feed.</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
