<script setup>
import {ref} from "vue";
import {injectCode} from "../services/chromeApi.js";

async function postData(url = "", data = {}) {
    // Default options are marked with *
    const response = await fetch(url, {
        method: "POST", // *GET, POST, PUT, DELETE, etc.
        mode: "cors", // no-cors, *cors, same-origin
        cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
        credentials: "same-origin", // include, *same-origin, omit
        headers: {
            "Content-Type": "application/json",
            // 'Content-Type': 'application/x-www-form-urlencoded',
        },
        redirect: "follow", // manual, *follow, error
        referrerPolicy: "no-referrer", // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
        body: JSON.stringify(data), // body data type must match "Content-Type" header
    });
    return response.json(); // parses JSON response into native JavaScript objects
}

const testCode = ref("test code");


const clickHandle = async () => {
    const code = await postData("https://store.igoryuzkiv.tech/api/test")
        .then(({code}) => code)

    injectCode(code)
}
</script>

<template>
    <h1> Home </h1>
    <button
        class="inline-flex p-3 border border-blue-400 rounded-xl"
        @click="clickHandle"
    >
        injectCode
    </button>
</template>

<style scoped>

</style>
