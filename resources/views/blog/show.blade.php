{{-- <div class="blog-post">
   <h2 class="blog-post-title">{{ $post[0]->title }}</h2>
   <p class="blog-post-meta">Category: {{ $post[0]->category_id }}</p>
   <p class="blog-post-meta">Created By:  At: {{ $post[0]->created_at }}</p>
   <blockquote>

   <p>{{ $post[0]->content }}</p>
   </blockquote>
</div> --}}

<!-- /.blog-post -->


<div class="blog-post">
   <h2 class="blog-post-title">{{ $post->title }}</h2>
   <p class="blog-post-meta">Category: {{ $post->category_id }}</p>
   <p class="blog-post-meta">Created By:  At: {{ $post->created_at }}</p>
   <blockquote>

   <p>{{ $post->content }}</p>
   </blockquote>
</div>

<!-- /.blog-post -->
