<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Category</h4>
                </div>
                <div class="card-body">
                    <form @action.prevent="create">
                        <div class="row">
                            <div class="col-12 md-2">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" v-model="model.category.title">
                                </div>
                                <div class="col-12 mb-2">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <input type="text" class="form-control" v-model="model.category.description">
                                    </div>
                                </div>
                                <div class="col-12 mb-2">
                                    <button type="button" class="btn btn-primary" @click="create">Save</button>
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
    name:"add-Category",
    data(){
        return{
            model: {
                category: {
                    title:'',
                    description:''
            }
            }
        }
    },
    methods:{
        async create (){
            await axios.post('/api/category/add', this.model.category).then(response=>{
                this.$router.push({name:"List"})
            }).catch(error=>{
                console.log(error)
            })
        }
    }
}



</script>