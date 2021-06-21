<template>
  <div class="container">
      <div class="d-flex justify-content-between">
          <h2>All Post</h2>
          <button class="btn btn-dark">
              <router-link :to="{name: 'post.create'}">New Post</router-link>
          </button>
      </div>
      <hr>
    <div class="row">
      <div v-if="posts.length === 0 " class="container">
          <div class="alert alert-danger">
              <h3>There's no post.</h3>
          </div>
      </div>
      <div v-for="post in posts" :key="post.id" class="col-md-4">
        <div class="card mb-4 my-2">
            <div>
                <div class="card-header">
                    <router-link :to="{name: 'post.show', params: {postSlug: post.slug}}">{{post.title}}</router-link>
                </div>
                <div class="card-body">
                    {{post.body.substring(0,100) + "..."}}
                    <router-link :to="{name: 'post.show', params: {postSlug: post.slug}}">Read More</router-link>
                </div>
                <div class="card-footer">
                    <div class="text-secondary">
                        <small> Published on: {{post.published}}</small>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
    <div>
        
    </div>
  </div>
</template>

<script>
import Api from '@/apis/Api.js'
import User from '@/apis/User.js'
export default {
    data() {
        return {
            posts:[],
            user: null,
            errors: ""
        }
    },

    mounted() {
        this.getAuth()
    },

    methods: {
        async getPosts(){

            let { data } = await Api.get('/post');

            this.posts = data.data
            
        },
        getAuth(){
            User.auth().then(response => {
                this.user = response.data;
                this.getPosts()
            })
            .catch(error => {
                if(error.response.status === 401){
                    this.errors = "Log in is required."
                }
            })
        }

        
    },

}
</script>

<style>

button a{
    color: #fff;
}

button a:hover{
    color: #fff;
    text-decoration: none;
}

.card-header a, .card-header a:hover {
    text-decoration: none;
    color: #464648;
}

</style>