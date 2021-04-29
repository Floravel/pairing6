<template>
    <div class="mt-12">rggrgrgaegerg</div>
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

    }

}
</script>

<style scoped>

</style>
