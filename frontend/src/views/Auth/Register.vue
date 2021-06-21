<template>
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-6">
              <div class="card">
                  <div class="card-header text-center bg-dark text-light">Register</div>
                  <div class="card-body">
                      <form action="" method="post">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" v-model="form.name" id="name" class="form-control">
                                <span class="text-danger" v-if="errors.name">
                                    {{errors.name[0]}}
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" v-model="form.email" id="email" class="form-control">
                                <span class="text-danger" v-if="errors.email">
                                    {{errors.email[0]}}
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" v-model="form.password" id="password" class="form-control">
                                <span class="text-danger" v-if="errors.password">
                                    {{errors.password[0]}}
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" v-model="form.password_confirmation" id="password_confirmation" class="form-control">
                                <span class="text-danger" v-if="errors.password_confirmation">
                                    {{errors.password_confirmation[0]}}
                                </span>
                            </div>
                            <button @click.prevent="register" type="submit" class="btn btn-dark">Register</button>
                      </form>
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
            form: {
                'name': "",
                'email': "",
                'password': "",
                'password_confirmation': "",
            },
            errors: []
        }
    },
    methods: {
        register(){
                User.register(this.form)
                .then(() => {
                    this.$router.push({ name: 'login' })
                })
                .catch(error =>{
                    if(error.response.status === 422){
                        this.errors = error.response.data.errors;
                    }
                });
            
        }
    },

}
</script>

<style>

</style>