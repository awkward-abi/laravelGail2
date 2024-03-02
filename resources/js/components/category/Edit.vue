<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Update Category</h4>
                </div>
                <div class="card-body">
                    <form @action.prevent="update">
                        <div class="row">
                            <div class="col-12 md-2">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" v-model="category.title">
                                </div>
                                <div class="col-12 mb-2">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <input type="text" class="form-control" v-model="category.description">
                                    </div>
                                </div>
                                <div class="col-12 mb-2">
                                    <button type="button" @click="update(category.id)" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"update-Category",
    data(){
        return{
            category:{
                title:"",
                description:""
            }
        }
    },
    mounted(){
        this.showCategory()
    },
    methods:{
        async showCategory(){
            await axios.get(`/api/category/edit/${this.$route.params.id}`).then(response=>{
                const {title,description} = response.data
                this.category.title = title
                this.category.description = description
            }).catch(error=>{
                console.log(error)
            })
        },
        async update(){
            await axios.put(`/api/category/edit/${this.$route.params.id}`,this.category).then(response=>{
                this.$router.push({name:"List"})
            }).catch(error=>{
                console.log(error)
            })
        }
    }
}
</script>