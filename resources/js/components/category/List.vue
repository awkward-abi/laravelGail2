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
                            <DataTable 
                                        v-model:filters="filters"
                                        :value="categories" 
                                        dataKey="id"
                                        paginator 
                                        stripedRows
                                        :rows="5" 
                                        :globalFilterFields="['id', 'title', 'description']"
                                        :rowsPerPageOptions="[5, 10, 20, 50]" tableStyle="min-width: 50rem">
                                     <InputText v-model="filters['global'].value" placeholder="Keyword Search" />   
                                <template #empty> No customers found. </template>
                                <template #loading> Loading customers data. Please wait. </template>
                                <Column field="id" header="Id" style="width: 5%"></Column>
                                <Column field="title" header="Title" style="width: 15%"></Column>
                                
                                <Column field="description" header="Description" style="width: 25%"></Column>
                                <Column field="action" header="Action" style="width: 25%">
                                    <template #body="slotProps">

                                        <router-link  :to='{name:"Edit",params:{id:slotProps.data.id}}' class="btn btn-success m-2">Edit</router-link>
                                        
                                        <button class="btn-danger btn m-2" @click="deleteCategory(slotProps.data.id)">Delete</button>

                                        <router-link class="btn-primary btn m-2" :to='{name:"SubcategoryList",params: { id: slotProps.data.id }}'>View Subcategory List</router-link>

                                    </template>   
                                </Column>
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


import Breadcrumb from 'primevue/breadcrumb';

const item = ref([
    { label: 'Edit', route: '/edit' },
    { label: 'SubcategoryList', route: '/subcategory' },
]);

export default {
    name: "categories",
    components: {
        DataTable,
        Column,
        ColumnGroup,
        Row,
        InputText,
        Breadcrumb
    },
    data() {  
        return {
            categories: [],
            filters: {
                global: { value: null, matchMode: FilterMatchMode.CONTAINS },  
            }
        }
    },
    mounted() {
        this.getCategories();
    },
    methods: {
        async getCategories() {
            try {
                const response = await axios.get('http://localhost:8000/api/category');
                this.categories = response.data;
            } catch (error) {
                console.log(error);
                this.categories = [];
            }
        },
    
        deleteCategory(id) {
            if (confirm("Are you sure to delete this category?")) {
                axios.delete(`/api/category/delete/${id}`).then(response => {
                    this.getCategories();
                }).catch(error => {
                    console.log(error);
                });
            }
        }
        
    }
}

</script>