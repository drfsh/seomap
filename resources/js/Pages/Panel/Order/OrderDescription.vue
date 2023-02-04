<template>
    <div class="row">
        <div class="col-md-6" v-if="attrs.lang">
            <div class="min-title">زبان محتوا</div>
            <div class="order-detail mt-3">
                <p class="order-info">
                    {{ attrs.lang[0].description }}
                </p>
            </div>
        </div>
        <div class="col-md-6" v-if="project.attr_new && project.attr_new.example">
            <div class="min-title" v-if="project.service_id==1">نمونه سایت مشابه</div>
            <div class="order-detail mt-3">
                <p class="order-info ltr">
                    {{ project.attr_new.example }}
                </p>
            </div>
        </div>
        <div v-if="project.access">
            <div class="min-title">دسترسی ها</div>
            <div class="row">
                <div class="col-md-6">
                    <div class="order-detail mt-3">
                        <div style="height: 24px;">
                            هاست :
                            <span style="border-radius: 11px;padding: 0 9px;" class="order-info float-start bg-blue">
                                 username:   {{ project.access.host_username }}
                            </span>
                            <span style="border-radius: 11px;padding: 0 9px;" class="order-info float-start bg-blue ms-2">
                                 password:   {{ project.access.host_password }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class=" order-detail mt-3">
                        <div style="height: 24px;">
                            سایت :
                            <span style="border-radius: 11px;padding: 0 9px;" class="order-info float-start bg-blue">
                                 username:   {{ project.access.web_username }}
                            </span>
                            <span style="border-radius: 11px;padding: 0 9px;" class="order-info float-start bg-blue ms-2">
                                 password:   {{ project.access.web_password }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="project.file">
            <div class="min-title">فایل پیوست</div>
            <div class="order-detail mt-3">
                <ic_link class="ms-2"></ic_link>
                <a target="_blank" :href="project.file" class="order-info">
                    بازکردن فایل
                </a>
            </div>
        </div>
        <div>
            <div class="min-title">توضیحات مشتری</div>
            <div class="order-detail mt-3">
                <p class="order-info">
                    {{ project.description }}
                </p>
            </div>
        </div>

        <div v-if="attrs.attr">
            <div class="min-title">امکانات</div>
            <div class="row mt-4 px-2 order-detail">
                <div v-for="v in attrs.attr" class="mb-4 col-12 col-md-6 col-xl-3 col-lg-6">
                    <ic_tick_blue></ic_tick_blue>
                    <strong style="font-size: 13px"> &nbsp; {{ v.description }} </strong>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import Ic_tick_blue from "@/Components/svgs/ic_tick_blue.vue";
import Ic_link from "@/Components/svgs/ic_link.vue";

defineProps(['project','attrs'])
</script>

<style scoped>

</style>
