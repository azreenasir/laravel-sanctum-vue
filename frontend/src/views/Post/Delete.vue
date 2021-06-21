<template>
  <button @click="destroyPost">Delete</button>
</template>

<script>
import Api from '@/apis/Api.js'
export default {
    props: [ 'endpoint' ],
    mounted() {
        
    },
    methods: {
        async destroyPost(){
            let q = window.confirm("Are you sure?");

            if(q === true){
                let response = await Api.delete(`/post/${this.endpoint}/delete`)

                if(response.status === 200){

                    this.$router.push('/post')

                    this.$toasted.show(response.data.message,{
                        type: 'success',
                        duration: 3000
                    })

                    
                }
            }else{
                this.$toasted.show("Delete Unsuccessfull",{
                        type: 'error',
                        duration: 3000
                    })
            }
            
        }
    },
}
</script>

<style>

</style>