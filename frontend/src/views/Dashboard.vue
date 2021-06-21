<template>
  <div class="container">
      <h3 class="m-3">Your Dashboard</h3>
      <div class="row ">
          <div class="col-md-8 m-3">
                <div class="card" v-if="user">
                    <div class="card-header">Hello, {{ user.name }}</div>
                    <div class="card-body">
                        <p>Your Email: {{ user.email }} </p>
                    </div>
                </div>
          </div>
      </div>
      
  </div>
</template>

<script>
import User from '@/apis/User.js'
export default {
    data() {
        return {
            user: null
        }
    },

    mounted() {
        this.getAuth()
    },

    methods: {
        getAuth(){
            User.auth().then(response => {
                this.user = response.data;
            })
        }
    },

}
</script>

<style>

</style>