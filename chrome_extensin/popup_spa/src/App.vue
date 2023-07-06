<template>
    <button @click="clickHandle"> Test </button>
</template>

<script setup>
const clickHandle = () => {
    chrome.tabs.query({active: true, currentWindow: true}, function (tabs) {
        async function insertCode() {
            const code = await fetch("https://store.igoryuzkiv.tech/api/test", {
                method:  "GET",
                headers: {
                    Accept:         "application/json",
                    "Content-Type": "application/json;charset=UTF-8",
                }
            })
                .then((response) => response.json())
                .then((data) => data?.code ?? '');

            const event = new CustomEvent("zohoLazyAss__insertInCurrentPosition", {"detail": code});
            document.dispatchEvent(event);
        };

        chrome.scripting.executeScript({
            target: {tabId: tabs[0].id},
            func:   insertCode,
        }).then(() => console.log('Injected a function!'));
    });
}
</script>