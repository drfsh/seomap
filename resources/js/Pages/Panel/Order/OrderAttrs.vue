<template>

    <div v-if="attrs.processing">
        <div class="min-title">وضعیت</div>
        <div class="attrs" style="flex-wrap: nowrap;">
            <div class="item" style="white-space: nowrap" role="button">
                <div class="order-detail__item">
                                  <span>
                                    <img src="/images/icons/receipt-2.svg" alt="">
                                    مرحله :
                                  </span>
                    <strong> {{ attrs.processing[0].name }}</strong>
                </div>
            </div>

            <div class="item processing"
                 :style="'--proccess:'+attrs.processing[0].value+'%'" role="button">
                <div class="order-detail__item" style="z-index: 6;position: relative;">
                                  <span>
                                    <img src="/images/icons/receipt-disscount.svg" alt="">
                                    پیشروی :
                                  </span>
                    <strong>% {{ attrs.processing[0].value }} </strong>
                </div>
            </div>
        </div>
    </div>
    <div v-if="attrs.description">
        <div class="min-title">توضیحات سئومپ</div>
        <div class="order-detail mt-3">
            <p class="order-info">
                {{ attrs.description.description }}
            </p>
        </div>
    </div>
    <div>
        <div class="min-title">ویژگی ها</div>
        <div class="attrs">
            <div class="item" v-if="project.attr_new">
                <div class="order-detail__item">
                      <span>
                        <img src="/images/icons/Sitetype.svg" alt="">
                        پیاده سازی با :
                      </span>
                    <strong> &nbsp; {{ project.attr_new.platform.name }} </strong>
                </div>
            </div>
            <AttrItemClient v-for="v in attrs.dev" :key="v.id" :v="v"></AttrItemClient>
            <hr style="width: 100%;color: transparent;margin: 0;">
            <AttrItemClient v-for="v in attrs.lng" :key="v.id" :v="v"></AttrItemClient>
        </div>
    </div>
</template>

<script setup>
import AttrItemClient from "@/Components/Orders/AttrItemClient.vue";
const prop = defineProps(['attrs','project'])
</script>
