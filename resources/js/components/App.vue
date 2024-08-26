<template>
    <div>
        <app-navbar></app-navbar>
        <div class="container">
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
import { onMounted } from 'vue';
import { useStore } from 'vuex';
import Navbar from './Navbar.vue';

export default {
    name: 'App',
    setup() {
        const store = useStore();
        onMounted(() => {
            store.dispatch('getProducts')
                .then(() => {
                })
                .catch(error => {
                    console.log(error);
                });
        });
        return {
        };
    },
    components: {
        appNavbar: Navbar
    }
};
</script>