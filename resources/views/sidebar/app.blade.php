<h3>Kategoriler</h3>
<ul class="list-group">
    @foreach (\App\Models\Category::all() as $key => $v)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <a href="/kategori/{{ strtolower($v['name']) }}">{{ $v['name'] }}</a>
            <span
                class="badge bg-primary rounded-pill">{{ \App\Models\QuestionsCategory::getCount($v['id']) }}</span>
        </li>
    @endforeach
</ul>
