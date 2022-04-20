<ul class="list-group">
    @foreach (\App\Models\Category::all() as $key => $v)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <a href="">{{ $v['name'] }}</a>
            <span
                class="badge bg-primary rounded-pill">{{ \App\Models\QuestionsCategory::getCount($v['id']) }}</span>
        </li>
    @endforeach
</ul>
