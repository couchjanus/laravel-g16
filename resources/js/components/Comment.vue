<template>
    <div class="comment">
        <div class="comment-header d-flex justify-content-between">
            <div class="user d-flex align-items-center">
                <div class="image"><img src="/images/user.svg" class="img-fluid rounded-circle"></div>
                <div class="title"><strong>{{ creator_name }}</strong> | <span class="date">{{ posted_at }}</span></div>
            </div>
        </div>
        <div class="comment-body">
            <p>{{ comment.body }}</p>
        </div>
    </div>
</template>

<script>
  
  export default {
        // name: "Comment",
        props: ['comment'],
        computed: {
          creator_name(){
            return this.comment.creator.name;
          },
          posted_at() {
            return this.comment.created_at;
          },
        }
  }
</script>
