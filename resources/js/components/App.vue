<template>
    <div class="bg-blue-500 flex flex-1 flex-col h-screen overflow-y-hidden">
        <Nav class="fixed"/>

        <div class="flex overflow-y-hidden flex-1">
            <Sidebar class="mt-18"/>

            <div class="scroll-bar-hidden overflow-x-hidden w-2/3 p-4">
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
    .scroll-bar-hidden {
        overflow-y: scroll; /* Add the ability to scroll */
    }

    /* Hide scrollbar for Chrome, Safari and Opera */
    .scroll-bar-hidden::-webkit-scrollbar {
        display: none;
    }

    /* Hide scrollbar for IE, Edge and Firefox */
    .scroll-bar-hidden {
        -ms-overflow-style: none;  /* IE and Edge */
        scrollbar-width: none;  /* Firefox */
    }
</style>
