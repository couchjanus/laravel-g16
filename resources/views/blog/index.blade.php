<!-- views/blog.blade.php -->
<h1>{{ $title }}</h1>

<?php foreach ($posts as $post):?>
  <div class="blog-post">
    <h2 class="blog-post-title">
      <a href="{{ url("blog", $post->id) }}">{{ $post->title }}</a>
    </h2>               
    <p class="blog-post-meta">Category: {{ $post->category_id }}</p>
    <p class="blog-post-meta">Created By: Author At: {{ $post->created_at }}</p>
  </div><!-- /.blog-post -->
<?php endforeach;?>
