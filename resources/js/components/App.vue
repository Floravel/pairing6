<template>
    <div class="bg-blue-500">
        <Nav></Nav>

        <div class="flex overflow-y-hidden flex-1">
            <Sidebar/>

            <div class="overflow-x-hidden w-2/3 mr-9">
                <router-view></router-view>
            </div>
        </div>

        <footer class="bg-gray-800 pt-16 mx-9">
            <div class="container mx-auto px-6">
                <div class="flex flex-col sm:flex-row items-center justify-end">
                    <div class="sm:w-2/3">
                        <h4 class="text-3xl text-white leading-tight text-center sm:text-left">Nulla mollis, odio ac imperdiet <br class="hidden sm:block"> aliquet, nulla <span class="font-bold underline">ante vulputate elit</span></h4>
                    </div>
                    <div class="sm:w-1/3 mt-12 sm:mt-0 flex justify-end">
                        <button class="bg-blue-600 hover:bg-blue-500 text-white rounded py-3 px-8 shadow-lg text-xl">Contact us</button>
                    </div>
                </div>
                <div class="flex justify-center sm:justify-end border-t border-gray-700 py-10 mt-16 mb-8">
                    <a href="#" class="text-white mx-2">Home</a>
                    <a href="#" class="text-white mx-2">Link1</a>
                    <a href="#" class="text-white mx-2">Link2</a>
                    <a href="#" class="text-white mx-2">Link3</a>
                    <a href="#" class="text-white mx-2">Link4</a>
                </div>
            </div>
        </footer>
    </div>
</template>

<script>
import Nav from './Nav'
import Sidebar from "./Sidebar";
export default {
    name: "App",
    components: {
        Nav,
        Sidebar
    }
}
</script>

<style scoped>

</style>
