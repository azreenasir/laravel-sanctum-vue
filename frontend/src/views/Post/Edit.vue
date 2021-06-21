<template>
  <div class="container">
      <div class="row">
          <div class="col-md-6">
              
              <div class="card">
                  <div class="card-header">Create New Post</div>
                  <div class="card-body">
                      <form action="" method="post" @submit.prevent="update">
                         <div class="form-group">
                           <label for="title">Title</label>
                           <input type="text" v-model="form.title" id="title" class="form-control">
                           <div v-if="theErrors.title" class="mt-2 text-danger">
                               {{ theErrors.title[0] }}
                           </div>
                         </div>
                         <div class="form-group">
                             <label for="category">Category</label>
                             <select @change="selectedCategory" id="category" class="form-control" >
                                 <option :value="form.categoryId" v-text="form.category"></option>
                                 <template v-for="category in categories">
                                     <option v-if="form.categoryId !== category.id" :key="category.id" :value="category.id">{{category.name}}</option>
                                 </template>
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
                         <button class="btn btn-dark">Update</button>
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
            form: [],
            categories: [],
            theErrors: [],
            selected: '',
        }
    },

    mounted() {
        this.getCategories();
        this.getPost();
    },

    methods: {
        async getCategories(){

            let response = await Api.get('category')

            if(response.status === 200){
                this.categories = response.data
            }
        },

        async getPost(){

            let response = await Api.get(`/post/${this.$route.params.postSlug}`);

            this.form = response.data.data

        },

        selectedCategory(e){
            this.selected = e.target.value
        },

        async update(){

            try {
                this.form['category'] = this.selected || this.form.categoryId

                let response = await Api.patch(`/post/${this.$route.params.postSlug}/edit`, this.form)

                if(response.status === 200){               
                    this.$toasted.show(response.data.message,{
                        type: 'success',
                        duration: 3000
                    })

                    this.$router.push('/post')
                }
            } catch (e) {
                
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