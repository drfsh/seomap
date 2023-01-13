<template>
    <PanelLayout>
        <div class="content__card">
            <div class="content__card__head">
                <h2 class="content__card__head__title">ثبت سفارشات</h2>
            </div>
            <div class="content__card__body">

                <div class="row gy-4">
                    <div v-for="v in services" class="col-md-4 col-lg-4">
                        <div class="demo-all">
                            <img :src="v.image" alt="" style="width: 148px;border-radius: 8px;height: 82px;">
                            <div>
                                <p class="sample-service t-blue">{{v.name}}</p>
                                <p class="info-service">{{v.description}}</p>
                                <Link :href="route('order.create',{slug:v.slug})" class="btn btn--outline-primary cart">  سفارش  </Link>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </PanelLayout>
</template>

<script setup>
import PanelLayout from "@/Layouts/PanelLayout.vue";
import {Link} from "@inertiajs/inertia-vue3";
defineProps(['services'])
</script>

<style scoped>

</style>
