<template>
    <div class="flex flex-col items-center py-4 mb-4 mx-4">
        <p v-if="loading" class="text-white">Loading pairing requests...</p>
        <PairingRequest v-else v-for="pairingRequest in pairingRequests.data" :key="pairingRequest.data.pairing_request_id" :pairingRequest="pairingRequest" />
    </div>
</template>

<script>
import PairingRequest from "../components/PairingRequest";

export default {
    name: "NewsFeed",

    components: {
        PairingRequest
    },

    data: () => {
        return {
            pairingRequests: null,
            loading: true
        }
    },

    mounted() {
        axios.get('/api/pairingRequest')
        .then( res =>{
            this.pairingRequests = res.data;
            this.loading = false;
        })
        .catch( error => {
            console.log('Unable to fetch pairing requests');
            this.loading = false;
        });
    }
}
</script>

<style scoped>

</style>
0
