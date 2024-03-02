<template>
    <main>
        <nav class="navbar navbar-expand-lg navbar-dark bg-info rounded">
            <div class="conatiner-fluid col-lg-12 d-lg-flex">
                
                
                <router-link to="/" class="fw-bold navbar-brand p-3" href="#">Laravel + Vue</router-link>
                    <!--col-lg-3 me-0-->

                <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" >
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                    
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mb-lg-0">
                        <li class="nav-item nav-link">
                            <router-link exact-active-class="active" to="/" class="nav-item nav-link text-white">Home</router-link>
                            </li>
                            <li class="nav-item nav-link">
                            <router-link exact-active-class="active" to="/category/list" class="nav-item nav-link text-white">Category</router-link>
                        </li>
                    </ul>
                </div>
               
            </div>
        </nav>
        <div class="container mt-5">
            <router-view></router-view>
        </div>
    </main>
</template>

<script>
    export default{
    }
</script>