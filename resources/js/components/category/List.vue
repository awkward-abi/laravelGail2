<template>
    <div class="row">
        <div class="col-12 mb-2 text-end">
            <router-link :to='{name:"Add"}' class="btn btn-primary">Create</router-link>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Category</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered display" id="table">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody v-if="categories.length > 0">
                                    <tr v-for="(category,key) in categories" :key="category.id"> 
                                        <td class="text-center">{{ category.id }}</td>
                                        <td class="text-center">{{ category.title }}</td>
                                        <td>{{ category.description }}</td>
                                        <td>
                                            <router-link :to='{name:"Edit",params:{id:category.id}}' class="btn btn-success">Edit</router-link>
                                            <button type="button" @click="deleteCategory(category.id)" class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody v-else>
                                    <tr>
                                        <td colspan="4" align="center"> No categories found</td>
                                    </tr>
                                </tbody>
                         </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default{
    name:"categories",
    data(){
        return{
            categories:[]
        }
    },
    mounted(){
        this.getCategories()
    },
    methods:{
        async getCategories(){
            await axios.get('http://localhost:8000/api/category').then(response=>{
                this.categories = response.data
            }).catch(error=>{ 
                console.log(error)
                this.categories=[]
            })
            $('#table').DataTable({
                "iDisplayLength": 10,
                "pageLength": 10,
                columnDefs: [{
                    "defaultContent": "-",
                    "targets": "_all"
                }]
            });
        },
        deleteCategory(id){
            if(confirm("Are you sure to delete this category?")){
                axios.delete(`/api/category/delete/${id}`).then(response=>{
                    this.getCategories()
                    console.log(this)
                }).catch(error=>{
                    console.log(error)
                })
            }
        }
    }
}
</script>

