<script setup>
import {dispatchEvent}         from "@/utils/chromeApi.js";
import {postRequest} from "@/utils/http.js";


const clickHandle = async () => {
    const code = await postRequest("chrome-extension/test/inject").then(({code}) => code)
    dispatchEvent("injectCode", {code});
}
</script>

<template>
    <button
        class="inline-flex p-3 border border-blue-400 rounded-xl"
        @click="clickHandle"
    >
        test inject
    </button>
</template>

<style scoped>

</style>