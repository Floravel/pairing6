<template>
    <div class="flex flex-col items-center">
        <PairingRequest v-for="pairingRequest in pairingRequests.data" :key="pairingRequest.data.pairing_request_id" :pairingRequest="pairingRequest" />
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
            pairingRequests: []
        }
    },

    mounted() {
        axios.get('/api/pairingRequest')
        .then( res =>{
            this.pairingRequests = res.data
        })
        .catch( error => {
            console.log('Unable to fetch pairing requests')
        });
    }
}
</script>

<style scoped>

</style>
0
