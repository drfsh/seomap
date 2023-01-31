<template>
    <div class="attrs" style="flex-wrap: nowrap;min-height: 100%">
        <div class="item w-100" style=";padding: 20px">
            <div>
                <div style="font-size: 15px;margin-top: 8px;">
                    <ic_info style="width: 20px;" class="mx-2"></ic_info>
                    {{prop.attrs.demoCheck[0].description}}
                </div>
                <div v-if="!attrs.demoCheck[0].name" style="font-size: 15px;margin-right: 35px;margin-top: 10px;">
                    پس از مشاهده دمو,  تاییدیه و نظر خود را در رابطه با دموی اولیه ارسال کنید.
                </div>
                <span class="data-left" style="right: unset; left: 17px; top: 17px;">
                    {{prop.attrs.demoCheck[0].created_at_fa}}
                </span>
                <div class="mt-4 order-detail__item flex-wrap justify-content-between"
                     style="z-index: 6;position: relative">
                    <div class="col-12">
                        <div class="">
                            <a class="btn py-3 btn--primary outline w-100" target="_blank" :href="prop.attrs.demoCheck[0].value">
                                مشاهده دمو
                            </a>
                        </div>
                        <InputError :message="form.errors.url"></InputError>
                    </div>
                </div>
                <div v-if="!attrs.demoCheck[0].name">
                    <div class="mt-4 order-detail__item flex-wrap justify-content-between"
                         style="z-index: 6;position: relative">
                        <div class="col-12">
                            <div class="input-group">
                                <textarea style="height: 70px;" v-model="form.info" type="text" class="form-control" placeholder="توضیحات"></textarea>
                            </div>
                            <InputError :message="form.errors.info"></InputError>
                        </div>
                    </div>
                    <div class="mt-3 text-start align-self-end">
                        <button @click="setStatus" type="button" class="btn btn--primary outline">
                            <span v-if="!form.processing">تایید و ارسال نظر</span>
                            <Loading v-else color="#2f5bea"></Loading>
                        </button>
                    </div>
                </div>
                <div v-else class="order-detail mt-4 py-4 position-relative">
                    <span class="data-left" style="right: unset; left: 17px; top: 12px;">
                    {{prop.attrs.demoCheck[0].updated_at_fa}}
                </span>

                    {{attrs.demoCheck[0].name}}
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import Loading from "@/Components/Loading.vue";
import VueTagsInput from "@sipec/vue3-tags-input";
import {onMounted, ref} from "vue";
import Ic_circle from "@/Components/svgs/ic_circle.vue";
import Ic_document_tick from "@/Components/svgs/ic_document_tick.vue";
import Ic_list from "@/Components/svgs/ic_list.vue";
import {useForm} from "@inertiajs/inertia-vue3";
import Ic_tick_blue from "@/Components/svgs/ic_tick_blue.vue";
import InputError from "@/Components/InputError.vue";
import Ic_info from "@/Components/svgs/ic_info.vue";

const prop = defineProps(['attrs','project'])
    const page = ref(0)
const form = useForm({
    info:prop.attrs.demoCheck?prop.attrs.demoCheck[0].name:null,
    attr_id:prop.attrs.demoCheck[0].id,
    type:'demoCheck'
})
const setStatus = async () => {
    form.post(route('demo.checked'))
}
</script>
