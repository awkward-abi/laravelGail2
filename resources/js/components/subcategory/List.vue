<template>
    <div class="row">
        <div class="col-12 mb-2 text-end">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex">
                        <h4>{{ parent_title }}<span>-</span></h4> 

                        <h4>Subcategory List</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <DataTable 
                                        v-model:filters="filters"
                                        :value="subcategories" 
                                        dataKey="id"
                                        paginator 
                                        stripedRows
                                        :rows="5" 
                                        :globalFilterFields="['id', 'sub_title', 'category_id']"
                                        :rowsPerPageOptions="[5, 10, 20, 50]" tableStyle="min-width: 50rem">
                                     <InputText v-model="filters['global'].value" placeholder="Keyword Search" />   
                                <template #empty> No customers found. </template>
                                <template #loading> Loading customers data. Please wait. </template>
                                <Column field="id" header="Id" style="width: 5%"></Column>
                                <Column field="sub_title" header="Subcategory Title" style="width: 15%"></Column>
                                <!-- <Column field="action" header="Action" style="width: 25%">
                                    <template #body="slotProps">

                                        <router-link  :to='{name:"Edit",params:{id:slotProps.data.id}}' class="btn btn-success">Edit</router-link>
                                        
                                        <button class="btn-danger btn" @click="deleteCategory(slotProps.data.id)" >delete</button>

                                    </template>    
                                </Column>-->
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
import ColumnGroup from 'primevue/columngroup';   
import Row from 'primevue/row'; 
import InputText from 'primevue/inputtext';
import { ref, onMounted } from 'vue';
import { FilterMatchMode } from 'primevue/api';
import { RouterLink } from 'vue-router';
import { list } from 'postcss';



// const item = ref([
//     { label: 'Edit', route: '/edit' },
//     //{ label: 'Delete', route: '/inputtext' }
// ]);

export default {
    name: "subcategories",
    components: {
        DataTable,
        Column,
        ColumnGroup,
        Row,
        InputText
    },
    data() {  
        return {
            subcategories: [],
            parent_title: "(loading)",
            filters: {
                global: { value: null, matchMode: FilterMatchMode.CONTAINS },  
            }
        }
    },
    mounted() {
        this.getSubCategories();
    },
    methods: {
        async getSubCategories() {
            const id = window.location.pathname.split('/')[2]; //to call the 2nd segment
            axios.get(`http://localhost:8000/api/category/${id}/subcategory`).then(response => {
                this.subcategories = response.data[0]['subcategories']; //to call the array of subcategories base sa index[] ng category
                this.parent_title = response.data[0]['title'];
                console.log(this.subcategories)
            }).catch(error => {
                console.log(error);
            })
        },
    
        // deleteSubCategory(id) {
        //     console.log(id)
        //     if (confirm("Are you sure to delete this category?")) {
        //         axios.delete(`/api/subcategory/delete/${id}`).then(response => {
        //             this.getCategories();
        //             console.log(this);
        //         }).catch(error => {
        //             console.log(error);
        //         });
        //     }
        // }
        
    }
}

</script>

