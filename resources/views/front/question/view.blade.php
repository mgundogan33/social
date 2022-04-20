@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <ul class="list-unstyled">

                    <li class="media">
                        <div class="row">
                            <div class="col-md-2">
                                <img class="mr-3 resim "
                                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTPiUWsa1fBVyoxphpF6We9n4v4PUwERqE0IA&usqp=CAU"
                                    alt="Generic placeholder image">
                            </div>
                            <div class="col-md-10">
                                <div class="media-body ">
                                    <div class="title">
                                        <a href=""
                                            class="mt-0">{{ $data[0]['title'] }}</a>{{ \App\Helper\Helpers::time_ago($data[0]['created_at']) }}
                                    </div>
                                    <div class="description">{{ $data[0]['text'] }}
                                    </div>
                                    <div class="detail">
                                        <a href="">1 Yorum</a>-<a href="">101 Görüntülenme</a>
                                        @if (Auth::id() == $data[0]['userId'])
                                            <a href="">Düzenle</a>-<a href="">Sil</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>

                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif
                <div class="card">
                    <div class="card-header">Cevap Yaz</div>
                    <div class="card-body">
                        <form  method="POST" action="{{ route('comment.store',['id'=>$data[0]['id']]) }}">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="">Cevabınız</label>
                                    <textarea name="text" id="" class="form-control" cols="30" rows="10"></textarea>
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
                @include('sidebar.app')
            </div>
        </div>
    </div>
@endsection
