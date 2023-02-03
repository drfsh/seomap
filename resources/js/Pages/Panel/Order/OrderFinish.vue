<template>

    <div class="order-detail mt-3">
        <div style="font-weight: 500;">
            <ic_list class="mx-2"></ic_list>
            جناب <a :href="route('profile.edit')">{{project.user.name}}</a>
            مرحله تحویل پروژه شما به شرح زیر میباشد
        </div>
        <div class="mt-5 position-relative">
            <div class="row">
                <div class="col-md-6">
                    <div class="order-detail p-3 mt-3 order-info">
                        آدرس سایت :
                        <a target="_blank" :href="project.access.web">{{project.access.web}}</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="order-detail p-3 mt-3 order-info d-flex flex-row justify-content-center">
                        <div class="text-start w-100">
                            username:
                            <span> {{project.access.web_username}}</span>
                        </div>
                        <div class="text-start w-100">
                            password:
                            <span> {{project.access.web_password}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="order-detail p-3 mt-3 order-info">
                        آدرس هاست :
                        <a target="_blank" :href="project.access.host">{{project.access.host}}</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="order-detail p-3 mt-3 order-info d-flex flex-row justify-content-center">
                        <div class="text-start w-100">
                            username:
                            <span> {{project.access.host_username}}</span>
                        </div>
                        <div class="text-start w-100">
                            password:
                            <span> {{project.access.host_password}}</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="order-detail p-3 mt-3 order-info">
                        آدرس ایمیل سازمانی :
                        <a target="_blank">{{JSON.parse(attrs.finish[0].value).email}}</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="order-detail p-3 mt-3 order-info d-flex flex-row justify-content-center">
                        <div class="text-start w-100">
                            username:
                            <span> {{JSON.parse(attrs.finish[0].value).username}}</span>
                        </div>
                        <div class="text-start w-100">
                            password:
                            <span> {{JSON.parse(attrs.finish[0].value).password}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="order-detail p-3 mt-3 order-info">
                        آدرس ایمیل سازمانی :
                        <a target="_blank">{{JSON.parse(attrs.finish[0].value2).email}}</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="order-detail p-3 mt-3 order-info d-flex flex-row justify-content-center">
                        <div class="text-start w-100">
                            username:
                            <span> {{JSON.parse(attrs.finish[0].value2).username}}</span>
                        </div>
                        <div class="text-start w-100">
                            password:
                            <span> {{JSON.parse(attrs.finish[0].value2).password}}</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="mt-5 position-relative">
            <span class="data-left" style="right: unset; left: 17px; top: -1px;">
                        {{attrs.demo[0].created_at_fa}}
            </span>
            <div class="">توضیحات کارشناس فنی</div>
            <div class="order-detail mt-3 order-info" v-html="prop.attrs.demo[0].description"></div>
        </div>


        <div class="mt-4 text-start">
            <a >
                <button style="padding: 11px 18px;" class="me-2 btn btn--primary">
                    نظر سنجی درباره پروژه
                </button>
            </a>
        </div>

        <div v-if="project.status===4" class="mt-5 text-start">
            <a :href="route('order.finish',{id:project.id})">
                <button style="padding: 11px 18px;" class="me-2 btn btn--primary">
                    تایید و پرداخت هزینه پایانی
                </button>
            </a>
        </div>
    </div>

</template>

<script setup>
import Ic_list from "@/Components/svgs/ic_list.vue";
import {onUnmounted, ref} from "vue";
import moment from "jalali-moment";
import Ic_info from "@/Components/svgs/ic_info.vue";
const prop = defineProps(['attrs','project'])
</script>
