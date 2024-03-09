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
                                <div class="col-sm-12">
                                    <div class="form-group" >
                                        <label>Select Parent Category</label>
                                            <select class='form-control' v-model='model.category.parent_id'>
                                                <option value='0' >Select Parent Category</option>
                                                <option v-for='category in model.parent_categories' :value='category.id'>{{ category.title }}</option>
                                        </select>
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
            model: { //model property serves as the source of data for your component
                category: {
                    parent_id: null,
                    title: '',
                    title: [],
                    description:''
                },
                parent_categories: [] //array of titles
            }
        }
    },
    mounted() {
        this.getCategoryTitle();
    },
    methods:{
        async create (){
            await axios.post('/api/category/add', this.model.category).then(response=>{
                this.$router.push({name:"List"})
            }).catch(error=>{
                console.log(error)
            })
        },
        getCategoryTitle: function() {
            axios.get('/api/category/getCategoryTitle')
              .then(function (response) { 
                 this.model.parent_categories = response.data;
                 console.log(this.model.parent_categories)
              }.bind(this));
        }
    }
}




</script>