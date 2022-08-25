<div class="list-group">
    <a href="{{route('home')}}" class="list-group-item list-group-item-action">Home</a>
    <a href="{{route('test')}}" class="list-group-item list-group-item-action">Test Page</a>
</div>

<p class="mb-1">Manage Categories</p>
<div class="list-group">
    <a href="{{route('category.index')}}" class="list-group-item list-group-item-action">Categories</a>
    <a href="{{route('category.create')}}" class="list-group-item list-group-item-action">Create Category</a>
</div>

<p class="mb-1">Manage Posts</p>
<div class="list-group">
    <a href="{{route('post.index')}}" class="list-group-item list-group-item-action">Posts</a>
    <a href="{{route('post.create')}}" class="list-group-item list-group-item-action">Create Post</a>
</div>

@admin
<p class="mb-1">Manage Users</p>
<div class="list-group">
    <a href="{{route('user.index')}}" class="list-group-item list-group-item-action">Users</a>
</div>
@endadmin
