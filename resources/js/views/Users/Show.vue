<template>
    <div class="flex flex-col items-center">
        <div class="relative">
            <div class="w-100 h-64 overflow-hidden z-50 rounded">
                <img src="https://www.technocrazed.com/wp-content/uploads/2015/12/Landscape-wallpaper-7.jpg" alt="user background-image" class="object-cover w-full">
            </div>
            <div class="absolute bottom-0 left-0 -mb-8 ml-12 z-20 flex items-center">
                <div class="w-32">
                    <img src="https://i.pinimg.com/originals/7c/e9/bf/7ce9bf4925f798487d8a09271af891ab.jpg" alt="user profile image" class="object-cover w-32 h-32 rounded-full border-4 border-gray-200 shadow-2xl">
                </div>
                <p v-if="! userLoading" class="ml-4 text-2xl text-gray-200">
                    {{ user.data.attributes.name }}
                </p>
            </div>
        </div>

        <p v-if="pairingRequestLoading">
            Loading Pairing Requests
        </p>
        <pairingRequest v-else v-for="pairingRequest in pairingRequests.data" :key="pairingRequest.data.attributes.pairing_request_id" :pairingRequest="pairingRequest"/>

        <p v-if="!pairingRequestLoading && pairingRequests.data.length < 1">No pairing Requests found. Get started!</p>
    </div>
</template>

<script>
import PairingRequest from "../../components/PairingRequest";

export default {
    name: "Show",

    components: {
        PairingRequest
    },
    data: function () {
        return {
            user: null,
            pairingRequests: null,
            userLoading: true,
            pairingRequestLoading: true,
        }
    },
    mounted()
    {
        axios.get('/api/users/' + this.$route.params.userId )
        .then( res => {
            this.user = res.data;
        })
        .catch(
            error => {
                console.log('unable to fetch the users data from server')
            }
        )
        .finally(() => {
            this.userLoading = false
        })

        axios.get('/api/users/' + this.$route.params.userId + '/pairingRequests')
        .then( res => {
            this.pairingRequests = res.data;
        })
        .catch(
            error => {
                console.log('unable to fetch the pairing request data')
            }
        )
        .finally(() => {
            this.pairingRequestLoading = false;
        })

    }

}
</script>

<style scoped>

</style>
