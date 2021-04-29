<template>
    <div class="bg-blue-500 flex flex-1 flex-col h-screen overflow-y-hidden">
        <Nav class="fixed"/>

        <div class="flex overflow-y-hidden flex-1">
            <Sidebar/>

            <div class="overflow-x-hidden w-2/3">
                <router-view></router-view>
            </div>
        </div>
        <div>
            <Footer />
        </div>
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
