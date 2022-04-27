@extends('layouts.app')
@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-8">
                @if (session('status'))
                    <div class="alert alert-info">{{ session('status') }}</div>
                @endif
                <div class="card">
                    <div class="card-header">Profili Düzenle</div>
                    <div class="card-body">
                        <form enctype="multipart/form-data" method="POST" action="{{ route('settings.store') }}">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input type="file" name="photo" class="form-group">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="">Adınız</label>
                                    <input type="text" name="first_name" required class="form-control"
                                        value="{{ Auth::user()->first_name }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Soyadınız</label>
                                    <input type="text" name="last_name" required class="form-control"
                                        value="{{ Auth::user()->last_name }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Email</label>
                                    <input type="text" name="email" required class="form-control"
                                        value="{{ Auth::user()->email }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Doğum Tarihi</label>
                                    <input type="date" name="birthdate" required class="form-control"
                                        value="{{ Auth::user()->birthdate }}">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-12 mt-2">
                                    <button type="submit" class="btn btn-primary">
                                        Cevabı Gönder
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                @include('sidebar.settings')
            </div>
        </div>


    </div>
@endsection
