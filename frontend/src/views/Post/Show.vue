<template>
  <div class="container">
    <h1>{{post.title}}</h1>
    <div class="text-secondary">
      {{post.published}} - 
      <router-link :to="{ name: 'category'}">{{ post.category }}</router-link>
      
    </div>
    <hr>

    <div class="my-3 text-justify" style="white-space: pre-line">
      {{ post.body }}
    </div>

    <div>
      <button class="btn btn-primary mr-1">
        <router-link :to="{name: 'post.edit'}">Edit</router-link>
      </button>
      <delete-post :endpoint="post.slug" class="btn btn-danger"/>
    </div>
    
  </div>
</template>

<script>
import Api from '@/apis/Api.js'
import DeletePost from './Delete'
export default {
  components: {
    DeletePost
  },
  data() {
    return {
      post: [],
    }
  },

  mounted() {
    this.getPost();
  },

  methods: {
    async getPost(){
      let response = await Api.get('/post/' + this.$route.params.postSlug)

      this.post = response.data.data

    },
  },
}
</script>

<style>

</style>