<template>
    <div class="attrs" style="flex-wrap: nowrap;min-height: 100%">
        <div class="item w-100" style=";padding: 20px">
            <div class="order-detail__item flex-wrap justify-content-between"
                 style="z-index: 6;position: relative">
                <div class="d-flex flex-wrap">
                    <div class="item-processing ms-3">
                        <label class="switch-toggles">
                            <input type="checkbox" disabled v-model="isRun">
                            <span class="slider round"></span>
                        </label>
                        <div class="me-2">اعلام بررسی</div>
                    </div>
                    <div role="button" class="item-processing me-3" @click="page=0" :class="{active:page===0}">
                        <ic_list></ic_list>
                        <div class="me-2">آدرس دمو</div>
                    </div>
                    <div role="button" class="position-relative item-processing me-3" @click="prop.attrs.demoCheck?page=1:undefined" :class="{active:page===1}">
                        <ic_document_tick> </ic_document_tick>
                        <div class="me-2">بازخورد</div>
                    </div>
                    <div v-if="isRun" class="item-processing me-3">
                        <img src="/images/icons/calendar.svg" alt="">
                        <div class="me-2">{{prop.attrs.demoCheck[0].created_at_fa}}</div>
                    </div>

                </div>
                <div class="me-3">
                    <button  @click="setStatus" style="padding: 11px 18px;" class="me-2 btn btn--primary outline">
                        <b v-if="!form.processing">
                            ارسال به مشتری
                        </b>
                        <Loading v-else color="#2f5bea"></Loading>
                    </button>
                </div>
            </div>
            <div v-if="page===0">
                <div class="mt-4 order-detail__item flex-wrap justify-content-between"
                     style="z-index: 6;position: relative">
                    <div class="col-12">
                        <div class="input-group">
                            <input v-model="form.url" type="text" class="form-control" placeholder="آدرس">
                        </div>
                        <InputError :message="form.errors.url"></InputError>
                    </div>
                </div>
                <div class="mt-4 order-detail__item flex-wrap justify-content-between"
                     style="z-index: 6;position: relative">
                    <div class="col-12">
                        <div class="input-group">
                            <textarea style="height: 140px;" v-model="form.info" type="text" class="form-control" placeholder="توضیحات"></textarea>
                        </div>
                        <InputError :message="form.errors.info"></InputError>
                    </div>
                </div>
            </div>
            <div v-else-if="attrs.demoCheck [0].name" class="order-detail mt-4 position-relative">
                <span class="data-left" style="right: unset; left: 30px; top: 20px;">
                    {{prop.attrs.demoCheck[0].updated_at_fa}}
                </span>
                {{attrs.demoCheck[0].name}}
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
const isRun = ref(!!prop.attrs.demoCheck)
const page = ref(0)
const form = useForm({
    url:prop.attrs.demoCheck?prop.attrs.demoCheck[0].value:null,
    info:prop.attrs.demoCheck?prop.attrs.demoCheck[0].description:null,
    project_id:prop.project.id,
    type:'demoCheck'
})
const setStatus = async () => {
    form.post(route('admin.demo.store'))
}
</script>
