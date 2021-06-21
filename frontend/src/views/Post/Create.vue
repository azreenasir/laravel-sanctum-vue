<template>
  <div class="container">
      <div class="row">
          <div class="col-md-6">
              
              <div class="card">
                  <div class="card-header">Create New Post</div>
                  <div class="card-body">
                      <form action="" method="post" @submit.prevent="store">
                         <div class="form-group">
                           <label for="title">Title</label>
                           <input type="text" v-model="form.title" id="title" class="form-control">
                           <div v-if="theErrors.title" class="mt-2 text-danger">
                               {{ theErrors.title[0] }}
                           </div>
                         </div>
                         <div class="form-group">
                             <label for="category">Category</label>
                             <select v-model="form.category" id="category" class="form-control" >
                                 <option v-for="category in categories" :key="category.id" :value="category.id">{{category.name}}</option>
                             </select>
                             <div v-if="theErrors.category" class="mt-2 text-danger">
                               {{ theErrors.category[0] }}
                           </div>
                         </div>
                         <div class="form-group">
                           <label for="body">Body</label>
                           <textarea type="text" v-model="form.body" id="body" class="form-control" rows="5" />
                           <div v-if="theErrors.body" class="mt-2 text-danger">
                               {{ theErrors.body[0] }}
                           </div>
                         </div>
                         <button class="btn btn-dark">Save</button>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
</template>

<script>
import Api from '@/apis/Api.js'
export default {

    data() {
        return {
            form: {
                title: '',
                body: '',
                category: ''
            },
            categories: [],
            theErrors: [],
        }
    },

    mounted() {
        this.getCategories();
    },

    methods: {
        async getCategories(){

            let response = await Api.get('category')

            if(response.status === 200){
                this.categories = response.data
            }
        },

        async store(){
            try {
                let response = await Api.post('post-create', this.form)

                if(response.status === 200){
                    this.form.title = ""
                    this.form.categories = ""
                    this.form.body = ""
                    this.theErrors = []

                    this.$toasted.show(response.data.message,{
                        type: 'success',
                        duration: 3000
                    })

                    this.$router.push('post')
                }
            }
            catch(e){
                this.$toasted.show("Something went wrong",{
                    type: 'error',
                    duration: 3000
                })

                this.theErrors = e.response.data.errors ;
            }
            
        }
    },

}
</script>

<style>

</style>