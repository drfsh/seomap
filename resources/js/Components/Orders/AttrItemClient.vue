<template>
    <div  class="item position-relative">
        <div class="order-detail__item" role="button">
              <span>
                <img v-if="v.type==='dev'" src="/images/icons/Sitetype.svg" alt="">
                <img v-if="v.type==='lng'" src="/images/icons/language.svg" alt="">
                {{ v.name }} :
              </span>
            <strong>{{ v.description }}</strong>
        </div>
    </div>
</template>

<script setup>
import Ic_times_square from "@/Components/svgs/ic_times_square.vue";
import {ref} from "vue";

const prop = defineProps(['v','icon'])
const show = ref(true)

</script>
