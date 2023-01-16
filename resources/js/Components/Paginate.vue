<template>
    <div v-if="data.last_page>1" class="pagination">
        <div  class="page-item">
            <Link :href="data.prev_page_url" class="page-link previous" :class="{disable:!data.prev_page_url}">
                <img src="/images/icons/chevron.svg" alt="">
            </Link>
        </div>

        <div class="page-item" :class="{active:1===data.current_page}">
            <Link :href="data.first_page_url" :data="{page:1}" class="page-link">1</Link>
        </div>

        <span v-if="pages[0]>2">...</span>

        <div class="page-item" v-for="v in pages" :class="{active:v===data.current_page}">
            <Link :href="data.path" :data="{page:v}" class="page-link">{{ v }}</Link>
        </div>

        <span v-if="pages[pages.length-1]<data.last_page-1">...</span>

        <div class="page-item" :class="{active:data.last_page===data.current_page}">
            <Link :href="data.last_page_url" class="page-link">{{ data.last_page }}</Link>
        </div>

        <div class="page-item">
            <Link :href="data.next_page_url" class="page-link next" :class="{disable:!data.next_page_url}">
                <img src="/images/icons/chevron.svg" alt="">
            </Link>
        </div>
    </div>
</template>

<script setup>
import {onMounted, ref} from "vue";
import {Link} from "@inertiajs/inertia-vue3";

const prop = defineProps({
    data: Object,
});
console.log(prop.data)
const pages = ref([]);
const setupPage = () => {
    pages.value = []
    if (prop.data.last_page > 1 && prop.data.last_page < 4) {
        for (let i = 2; i < prop.data.last_page; i++) {
            pages.value.push(i)
        }
    } else {
        if (prop.data.current_page <= 2)
            for (let i = 2; i < 4; i++) {
                pages.value.push(i)
            }
        else if (prop.data.current_page < prop.data.last_page-1) {
            for (let i = prop.data.current_page-1; i < prop.data.current_page+2; i++) {
                pages.value.push(i)
            }
        }else {
            for (let i = prop.data.current_page-1; i < prop.data.last_page; i++) {
                pages.value.push(i)
            }
        }
    }

}
onMounted(() => {
    setupPage()
})
</script>

<style scoped>

</style>