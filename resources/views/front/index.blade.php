@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <ul class="list-unstyled">
                    @foreach ($data as $key => $v)
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
                                            <a href="" class="mt-0">{{ $v['title'] }}</a> {{\App\Helper\Helpers::time_ago($v['created_at'])}}
                                        </div>
                                        <div class="description">
                                            {{ \App\Helper\Helpers::split($v['text'], 120) }}
                                        </div>
                                        <div class="detail">
                                            <a href="">1 Yorum</a>-<a href="">101 Görüntülenme</a>-<a href="">Devamını
                                                Oku</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                {!! $data->links() !!}
            </div>

            <div class="col-md-4">
                <ul class="list-group">
                    @foreach (\App\Models\Category::all() as $key => $v)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="">{{ $v['name'] }}</a>
                            <span
                                class="badge bg-primary rounded-pill">{{ \App\Models\QuestionsCategory::getCount($v['id']) }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>


    </div>
@endsection
