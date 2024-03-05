
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
                                        :loading="loading"
                                        paginator 
                                        stripedRows
                                        :rows="5" 
                                        :globalFilterFields="['id', 'title', 'description']"
                                        :rowsPerPageOptions="[5, 10, 20, 50]" tableStyle="min-width: 50rem">
                                     <InputText v-model="filters['global'].value" placeholder="Keyword Search" />   
                                <template #empty> No customers found. </template>
                                <template #loading> Loading customers data. Please wait. </template>
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
import ColumnGroup from 'primevue/columngroup';   
import Row from 'primevue/row'; 
import InputText from 'primevue/inputtext';
import { ref, onMounted } from 'vue';
import { FilterMatchMode } from 'primevue/api';

const filters = ref({
    
});

export default {
    name: "categories",
    components: {
        DataTable,
        Column,
        ColumnGroup,
        Row,
        InputText
    },
    data() {  
        return {
            categories: [],
            filters: {
                global: { value: null, matchMode: FilterMatchMode.CONTAINS },  
            },
            searchValue: ''
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
                    console.log(this);
                }).catch(error => {
                    console.log(error);
                });
            }
        }
        
    }
}

</script>

