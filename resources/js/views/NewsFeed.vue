<template>
    <div className="flex flex-col items-center py-4">
        <PairingRequest/>
    </div>
</template>

<script>
import PairingRequest from "../components/PairingRequest";

export default {
    name: "NewsFeed",

    components: {
        PairingRequest
    }
}
</script>

<style scoped>

</style>
