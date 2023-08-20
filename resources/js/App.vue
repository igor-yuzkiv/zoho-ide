<script setup>
import {computed} from "vue";
import {useStore} from "vuex";
import ConfirmDialogWrapper from "@/components/confirm-dialog/ConfirmDialogWrapper.vue";

const store = useStore();
const darkTheme = computed(() => store.state.darkTheme);

</script>
<template>
    <div id="x__application" :class="{dark:darkTheme}">
        <confirm-dialog-wrapper></confirm-dialog-wrapper>
        <router-view></router-view>
    </div>
</template>
<style scoped>

</style>
