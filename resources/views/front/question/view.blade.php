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
                                <div class="media-body">
                                    <div class="title">
                                        <a href="" class="mt-0">{{ $data[0]['title'] }}</a>
                                        @foreach (\App\Models\QuestionsCategory::getCategoryList($data[0]['id']) as $k => $v)
                                            <span class="category--item" >{{ $v['name'] }}</a>
                                        @endforeach
                                    </div>
                                    <div class="description">{{ $data[0]['text'] }}
                                    </div>
                                    <div class="detail">
                                        <a href="">{{ \App\Models\Comments::getCount($data[0]['userId']) }} Yorum</a>-<a
                                            href="">{{ \App\Models\Visitor::getCount($data[0]['id']) }} Görüntülenme</a>
                                        -{{ \App\Helper\Helpers::time_ago($data[0]['created_at']) }}
                                        @if (Auth::id() == $data[0]['userId'])
                                            <a href="{{ route('question.edit', ['id' => $data[0]['id']]) }}"><i
                                                    class="fa-solid fa-edit"></i></a>-<a
                                                href="{{ route('question.delete', ['id' => $data[0]['id']]) }}"><i
                                                    class="fa-solid fa-trash"></i></a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <div class="category--list">
                        @foreach (\App\Models\QuestionsTags::where('questionId', $data[0]['id'])->get() as $k => $v)
                            <a href="#">{{ $v['name'] }}</a>
                        @endforeach
                    </div>
                </ul>
                <div class="category--title bg-success d-block text-center p-2 text-white">Cevaplar</div>
                @if (\App\Models\Comments::getCount($data[0]['id']) != 0)
                    <ul class="list-unstyled">
                        @foreach ($comments as $k => $v)
                            <li class="media">
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="media-body ">
                                            <div class="title">
                                                <a
                                                    class="mt-0">{{ \App\Models\User::getName($v['userId']) }}</a>
                                                {{ \App\Helper\Helpers::time_ago($v['created_at']) }}
                                                @if ($v['isCorrect'] == 1)
                                                    <span class="isCorrect">Doğru Cevap</span>
                                                @endif
                                            </div>
                                            <div class="description">
                                                {!! $v['text'] !!}
                                            </div>
                                            <div class="detail">
                                                @if ($v['userId'] != \Illuminate\Support\Facades\Auth::id())
                                                    <img class="mr-3 resim"
                                                        src="{{ \App\Models\User::resim($v['userId']) }}"
                                                        alt="Generic placeholder image">
                                                    <a href="{{ route('comment.LikeOrDiskLike', ['id' => $v['id']]) }}">Beğen
                                                        {{ \App\Models\LikeComment::getCount($v['id']) == 0 ?? '(' . \App\Models\LikeComment::getCount($v['id']) . ')' }}
                                                    </a>
                                                @else
                                                    <a href="{{ route('comment.delete', ['id' => $v['id']]) }}"><i
                                                            class="fa-solid fa-trash"></i></a>
                                                @endif
                                                @if (\Illuminate\Support\Facades\Auth::id() == $data[0]['userId'] and \App\Models\Comments::isCorrectVariable($data[0]['id'] == 0))
                                                    <a href="{{ route('comment.correct', ['id' => $v['id']]) }}"><i
                                                            class="fa-solid fa-check"></i></a>
                                                @endif
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="alert alert-info">Henüz Cevap Girilmemiş.</div>
                @endif


                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif
                <div class="card">
                    <div class="card-header">Cevap Yaz</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('comment.store', ['id' => $data[0]['id']]) }}">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="">Cevabınız</label>
                                    <textarea required name="text" id="" class="form-control" cols="30" rows="10"></textarea>
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
