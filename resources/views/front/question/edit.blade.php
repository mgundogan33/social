@extends('layouts.app')
@section('header')
    <link rel="stylesheet" href="{{ asset('plugins/tokenfield/css/bootstrap-tokenfield.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/tokenfield/css/tokenfield-typeahead.css') }}">
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif
                <div class="card">
                    <div class="card-header">{{ $data[0]['title'] }} Düzenle</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('question.update', ['id' => $data[0]['id']]) }}">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label>Soru Başlığı</label>
                                    <input type="text" class="form-control" name="title" value="{{ $data[0]['title'] }}"
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
                                                    <input type="checkbox" @if (\App\Models\QuestionsCategory::isChecked($value['id'], $data[0]['id'])) checked @endif
                                                        name="category[]" value="{{ $value['id'] }}">
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
                                    <textarea name="text" id="texteditor" class="form-control tinymce" cols="30" rows="10">{{ $data[0]['text'] }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="">Etiketler</label>
                                    <input type="text" name="tags" id="tokenfield" class="form-control" value="{{\App\Models\QuestionsTags::getImplode($data[0]['id'])}}">
                                </div>
                            </div>


                            <div class="row mb-0">
                                <div class="col-md-12 mt-2">
                                    <button type="submit" class="btn btn-primary">
                                        Düzenle
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
    <script type="text/javascript" src="{{ asset('plugin/tinymce/tinymce.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugin/tinymce/init-tinymce.js') }}"></script>
    <script>
        $("#get-data-form").submit(function(e) {
            var content = tinymce.get("texteditor").getContent();
            $("#data-container").html(content);
            return false;
        });
    </script>
    <style>
        #mceu_33-body {
            display: none !important;
        }

    </style>
@endsection
