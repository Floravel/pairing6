<template>
    <div class="bg-blue-500">
        <Nav class="fixed-top"></Nav>

        <div class="flex overflow-y-hidden flex-1">
            <Sidebar/>

            <div class="overflow-x-hidden w-2/3 mr-9">
                <router-view></router-view>
            </div>
        </div>
        <Footer/>

    </div>
</template>

<script>
import Nav from './Nav'
import Sidebar from "./Sidebar"
import Footer from "./Footer";
export default {
    name: "App",
    components: {
        Nav,
        Sidebar,
        Footer
    }
}
</script>

<style scoped>

</style>
