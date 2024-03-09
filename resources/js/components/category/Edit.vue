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
                                    <input type="text" class="form-control" v-model="model.category.title">
                                </div>
                                <div class="col-12 mb-2">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <input type="text" class="form-control" v-model="model.category.description">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group" >
                                        <label>Select Parent Category</label>
                                            <select class='form-control' v-model='selectedTitle'>
                                                <option value='0'>Select Parent Category</option>
                                                <option v-for="
                                                category in model.parent_categories" :value="category.id" 
                                                :selected="selectedTitle == category.id" 
                                                :key="category.id"
                                                >
                                                {{ category.title }}
                                                </option>

                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="col-12 mb-2">
                                    <button type="button" @click="update(model.category.id)" class="btn btn-primary">Update </button>

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
            model: {
                category: {
                    parent_id: null,
                    title: '',
                    title: [],
                    description:''
                },
                parent_categories: []
            },
            selectedTitle: null
        }
    },
    mounted() {
    this.showCategory()
    this.getCategoryTitle();
     },

    methods:{
        async showCategory(){
            await axios.get(`/api/category/edit/${this.$route.params.id}`).then(response=>{
                this.model.category = response.data
                this.selectedTitle = response.data.parent_id
            }).catch(error=>{
                console.log(error)
            })
        },

        async getCategoryTitle() {
            axios.get('/api/category/getCategoryTitle')
              .then(function (response) { 
                 this.model.parent_categories = response.data;
                 console.log(this.model.parent_categories)
              }.bind(this));
        },
        async update(){
            await axios.put(`/api/category/edit/${this.$route.params.id}`,this.model.category).then(response=>{
                this.$router.push({name:"List"})
            }).catch(error=>{
                console.log(error)
            })
        }
    }
}
</script>