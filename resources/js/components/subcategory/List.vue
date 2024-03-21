<template>
    <div class="row">
        <div class="col-12 mb-2 text-end">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>SubCategory</h4>
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
                                        :globalFilterFields="['id', 'sub_title']"
                                        :rowsPerPageOptions="[5, 10, 20, 50]" tableStyle="min-width: 50rem">
                                     <InputText v-model="filters['global'].value" placeholder="Keyword Search" />   
                                <template #empty> No subcategory found. </template>
                                <template #loading> Loading subcategory data. Please wait. </template>
                                <Column field="id" header="Id" style="width: 5%"></Column>
                                <Column field="sub_title" header="Title" style="width: 15%"></Column>
                                <Column field="action" header="Action" style="width: 25%">
                                    <template #body="slotProps">

                                        <button class="btn-danger btn m-2" @click="deleteSubCategory(slotProps.data.id)">Delete</button>

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
    name: "subcategories",
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
            subcategories: [],
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
            try {
                const currentUrl = window.location.pathname;
                const categoryId = currentUrl.split('/')[2];
                const response = await axios.get(`http://localhost:8000/api/category/${categoryId}/subcategory`);
                this.subcategories = response.data[0]['subcategories'];
                console.log(this.subcategories);
            } catch (error) {
                console.log(error);
                this.subcategories = [];
            }
        },
    
        deleteSubCategory(id) {
            console.log(id);
            // if (confirm("Are you sure to delete this category?")) {
            //     axios.delete(`/api/category/delete/${id}`).then(response => {
            //         this.getCategories();
            //         console.log(this);
            //     }).catch(error => {
            //         console.log(error);
            //     });
            // }
        }
        
    }
}

</script>