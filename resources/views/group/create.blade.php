@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                    <h5 class="card-header">{{ __('home.group.create') }}</h5>

                    <div class="card-body">
                        <!--preso da https://getbootstrap.com/docs/4.5/components/forms/#custom-styles-->
                        <form class="needs-validation" action="{{ route('groups.store') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom01">{{ __('home.name') }}</label>
                                    <input type="text" class="form-control" id="validationCustom01" name="name" aria-describedby="nameHelpBlock" required>
                                    <small id="nameHelpBlock" class="form-text text-muted">
                                        {{ __('home.form.name') }}.
                                    </small>
                                    
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom02">{{ __('home.description') }}</label>
                                    <input type="text" class="form-control" id="validationCustom02" name="description" aria-describedby="descHelpBlock">
                                    <small id="descHelpBlock" class="form-text text-muted">
                                        {{ __('home.form.description') }}.
                                    </small>
                                    
                                </div>
                            </div>

                            

                            <button class="btn btn-primary float-right" type="submit">{{ __('home.create') }}</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
