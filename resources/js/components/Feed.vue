<template>
<div class="post-comments">
    <header>
        <h3 class="h6">Post Comments<span class="no-of-comments">({{ comments.length }})</span></h3>
    </header>
    <Comment :key="comment.id" v-for="comment in comments" :comment="comment"></Comment>

    <span v-if="userId!==undefined">

      <div class="card my-4">
        <h5 class="card-header">Leave a Comment:</h5>
        <div class="card-body">
          <form @keyup.enter="postComment">
            
                <div class="form-group">
                    <textarea class="form-control" autocomplete="true" v-model="body" rows="3"></textarea>
                </div>
                <button type="submit" :class="{'is-loading': submit}" class="btn btn-primary" :disabled="!isValid" @click.prevent="postComment">Submit</button>
            </form>
        </div>
    </div>
    </span>
</div>
</template>

<script>
    import Comment from './Comment'

    export default {
        components: {Comment},
        props: ["postId", "userId"],
        data: () => ({
            comments: [],
            errors: [],
            submit: false,
            body: '',
        }),
        mounted() {
            this.fetchComments();
        },
        methods: {
            fetchComments: function() {
                axios
                    .get("/api/post/" + this.postId + "/comments")
                    .then(response => {
                        this.comments = response.data.comments;
                    })
                    .catch(error => {
                        this.errors.push(error);
                    });
            },
            postComment() {
                this.submit = true;
                const res = { 
                    comment: this.body,
                    post_id: this.postId,
                    user_id: this.userId
                };

                axios.post('/api/comment', res)
                    .then(response => {
                        this.submit = false;
                        this.body = "";
                        this.fetchComments();
                        if (response.data === 'ok')
                            console.log('success')
                        }).catch(err => {
                        this.submit = false
                    })
            },
        },
        computed: {
            isValid() {
                return this.body !== '';
            }
        }

      }
    </script>
