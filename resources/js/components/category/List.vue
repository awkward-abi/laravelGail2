
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
                            <DataTable :value="categories" paginator :rows="5" :rowsPerPageOptions="[5, 10, 20, 50]" tableStyle="min-width: 50rem">
                                <Column field="id" header="Id" style="width: 25%"></Column>
                                <Column field="title" header="Title" style="width: 25%"></Column>
                                <Column field="description" header="Description" style="width: 25%"></Column>
                            </DataTable>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup';   // optional
import Row from 'primevue/row'; 

export default{
    name:"categories",
    components: {
        DataTable,
        Column,
        ColumnGroup,
        Row
    },
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
            // $('#table').DataTable({
            //     "iDisplayLength": 10,
            //     "pageLength": 10,
            //     columnDefs: [{
            //         "defaultContent": "-",
            //         "targets": "_all"
            //     }]
            // });
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

