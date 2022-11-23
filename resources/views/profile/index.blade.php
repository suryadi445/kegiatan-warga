@extends('template.admin')

@section('container-admin')
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card">
                        <img src="https://source.unsplash.com/profile/w=600" class="card-img-top" alt="...">
                        <div class="card-body text-center">
                            <p class="text-uppercase">{{ auth()->user()->nama }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="position-relative">

                        <div class="card">
                            <ul class="list-group list-group-flush p-2">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    Username
                                                </div>
                                                <div class="col-sm-8">
                                                    {{ auth()->user()->username }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
