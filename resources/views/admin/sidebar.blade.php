<div class="col-md-3">
    <div class="card">
        <div class="card-header">
            Sidebar
        </div>

        <div class="card-body">
            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/admin') }}">
                        Dashboard
                    </a>
                    <a href="{{ url('admin/posts') }}">
                        Post
                    </a>
                    <a href="{{ url('/todo') }}">
                        Todo
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
