@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <ul class="list-unstyled">
                    @foreach ($data as $key => $v)


                        <li class="media">
                            <div class="row">
                                <div class="col-md-2 vurgun">

                                  <img class="mr-3 resim"
                                src="{{ \App\Models\User::resim($v['userId']) }}" alt="Generic placeholder image">
                                </div>
                                <div class="col-md-10">
                                    <div class="media-body ">
                                        <div class="title">
                                            <a href="{{route('view',['selflink'=>$v['selflink'],'id'=>$v['id']]) }}" class="mt-0">{{ $v['title'] }}</a> {{\App\Helper\Helpers::time_ago($v['created_at'])}}
                                        </div>
                                        <div class="description">
                                            {{ \App\Helper\Helpers::split($v['text'], 120) }}
                                        </div>
                                        <div class="detail">
                                            <a href="">{{ \App\Models\Comments::getCount($v['id']) }} Yorum</a>-<a href="">{{\App\Models\Visitor::getCount($v['id'])}} Görüntülenme</a>-<a href="{{route('view',['selflink'=>$v['selflink'],'id'=>$v['id']]) }}">Devamını Oku</a>
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
                @include('sidebar.app')
            </div>
        </div>


    </div>
@endsection
