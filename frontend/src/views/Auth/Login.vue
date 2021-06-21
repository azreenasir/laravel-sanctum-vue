<template>
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-6">
              <div class="card">
                  <div class="card-header text-center bg-dark text-light">Login</div>
                  <div class="card-body">
                      <form action="" method="post">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" v-model="form.email" id="email" class="form-control">
                                <span v-if="errors.email" class="text-danger">
                                    {{errors.email[0]}}
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" v-model="form.password" id="password" class="form-control">
                                <span v-if="errors.password" class="text-danger">
                                    {{errors.password[0]}}
                                </span>
                            </div>
                            <button @click.prevent="login" type="submit" class="btn btn-dark">Log in</button>
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
                'email': "",
                'password': ""
            },
            errors: []

        }
    },
    methods: {
        login(){
            User.login(this.form)
            .then(() => {
                this.$root.$emit("login", true)
                localStorage.setItem("auth", "true")
                this.$router.push({ name: 'dashboard' })
                this.$toasted.show("Login Successfull",{
                        type: 'success',
                        duration: 3000
                })
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