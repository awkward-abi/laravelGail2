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

                                <div class="col-12 mb-2">
                                    <div class="form-group"> 
                                        <Button label="Add Subcategory" @click="addNewSubcategory" />
                                        <div class="sub_container"> 
                                            <template v-for="(group, index) in model.subcategories" :key="index">
                                                <InputGroup class="m-2 w-75" v-if="group.visible">
                                                    <InputText v-model="group.subcategory" placeholder="Input Subcategory" />
                                                    <Button icon="pi pi-times" severity="danger" @click="removeSubcategory(index)"/>
                                                </InputGroup> 
                                            </template>
                                        </div>
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

import { ref } from 'vue'
import Dialog from 'primevue/dialog';
import Button from 'primevue/button';
import Checkbox from 'primevue/checkbox';
import InputGroup from 'primevue/inputgroup';
import InputText from 'primevue/inputtext';

const open = ref(false)

export default {
    name:"update-Category",
    components: {
      Button,
      Dialog,
      Checkbox,
      InputGroup,
      InputText
    },
    data(){
        return{
            model: {
                category: {
                    parent_id: null,
                    title: '',
                    title: [],
                    description:''
                },
                subcategories: [],
            },
            selectedTitle: null
        }
    },
    mounted() {
    this.showCategory()
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
        addNewSubcategory() {
            this.model.subcategories.push({ visible: true }); 
        },
        removeSubcategory(index) {
            this.model.subcategories.splice(index, 1);
        },
        async update(){ 
            console.log(this.model.subcategories);


            await axios.put(`/api/category/edit/${this.$route.params.id}`,this.model).then(response=>{
                this.$router.push({name:"List"})
            }).catch(error=>{
                console.log(error)
            })
        }
    }
}
</script>