@extends('layouts.app')
@section('header')
    <link rel="stylesheet" href="{{ asset('plugins/tokenfield/css/bootstrap-tokenfield.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/tokenfield/css/tokenfield-typeahead.css') }}">

    <script src="{{ asset('plugins/tokenfield/bootstrap-tokenfield.js') }}"></script>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Yeni Soru Sor</div>
                    <div class="card-body">
                        <form method="POST" action="">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label>Soru Başlığı</label>
                                    <input type="text" class="form-control" name="title" value="{{ old('title') }}"
                                        required autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for=""><strong>Kategori Seçimi</strong></label>
                                    <div class="row">
                                        @foreach ($category as $key => $value)
                                            <div class="col-md-3 ">
                                                <div class="m-checkbox">
                                                    <input type="checkbox" name="category[]" value="{{ $value['id'] }}">
                                                    {{ $value['name'] }}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="">Sorunuz</label>
                                    <textarea name="text" id="" class="form-control" cols="30" rows="10"></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="">Etiketler</label>
                                    <input type="text" name="tags" id="tokenfield" class="form-control">
                                </div>
                            </div>


                            <div class="row mb-0">
                                <div class="col-md-12 mt-2">
                                    <button type="submit" class="btn btn-primary">
                                        Soruyu Sor
                                    </button>


                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script>
        $("#tokenfield").tokenfield();
    </script>
@endsection
