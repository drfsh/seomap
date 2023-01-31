<template>
    <div class="attrs" style="flex-wrap: nowrap;min-height: 100%">
        <div class="item w-100" style=";padding: 20px">
            <div class="order-detail__item flex-wrap justify-content-between"
                 style="z-index: 6;position: relative">
                <div class="d-flex flex-wrap">
                    <div role="button" class="item-processing me-3" @click="page=0" :class="{active:page===0}">
                        <ic_list></ic_list>
                        <div class="me-2">توضیحات</div>
                    </div>
                    <div role="button" class="position-relative item-processing me-3" @click="isRun?page=1:undefined" :class="{active:page===1}">
                        <ic_document_tick> </ic_document_tick>
                        <div class="me-2">اطلاعات دریافتی</div>
                        <span style="left: -2px;top: -3px;" v-if="files>0" class="count">{{files}}</span>
                    </div>

                </div>

                <div v-if="isRun" class="item-processing me-3">
                    <img src="/images/icons/calendar.svg" alt="">
                    <div class="me-2">{{prop.attrs.startInfo[0].created_at_fa}}</div>
                </div>
            </div>
            <div v-if="page===0">
                <div class="mt-4 order-detail__item flex-wrap justify-content-between"
                     style="z-index: 6;position: relative">
                    <div class="col-12">
                        <div class="input-group">
                            <input v-model="form.info" type="text" class="form-control" placeholder="توضیحات">
                        </div>
                        <InputError :message="form.errors.info"></InputError>
                    </div>
                </div>
                <div class="mt-4 order-detail__item flex-wrap justify-content-between"
                     style="z-index: 6;position: relative">
                    <div class="col-12">
                        <div class="input-group">
                            <vue-tags-input
                                :tags="form.attrs"
                                class="form-control"
                                placeholder="ویژگی ها"
                                allow-edit-tags="true"
                                @tags-changed="newTags => form.attrs = newTags">
                            </vue-tags-input>
                        </div>
                    </div>
                </div>

                <div class="mt-3 text-start">
                    <button  @click="setStatus" style="padding: 11px 18px;" class="me-2 btn btn--primary outline">
                        <b v-if="!form.processing">
                            ارسال به مشتری
                        </b>
                        <Loading v-else color="#2f5bea"></Loading>
                    </button>
                </div>
            </div>
            <div v-else>
                <div style="font-size: 14px;margin-top: 35px;">
                    <ic_info class="mx-2"></ic_info>
                    {{prop.attrs.startInfo[0].description}}
                </div>

                <div class="row m-0 mt-4 px-2 order-detail">
                    <div :role="(v.value!=null || v.description!=null)?'button':''" @click="(v.value!=null || v.description!=null)?openFile(v):undefined" v-for="v in attrs.startAttrs" class="mb-4 col-12 col-md-6 col-xl-4 col-lg-6">
                        <ic_close_circle v-if="(v.value!=null || v.description!=null) && (v.value2!=1 && v.value2 !=null)" ></ic_close_circle>
                        <ic_tick_blue v-else-if="(v.value!=null || v.description!=null) && v.value2==1" ></ic_tick_blue>
                        <ic_document_uploaded v-else-if="v.value!=null || v.description!=null" ></ic_document_uploaded>
                        <ic_circle v-else></ic_circle>
                        <strong style="font-size: 13px"> &nbsp; {{ v.name }} </strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <PopupShowFile v-model:visible="showFile" :attr="file"></PopupShowFile>
</template>

<script setup>
import Loading from "@/Components/Loading.vue";
import VueTagsInput from "@sipec/vue3-tags-input";
import {onMounted, ref, watch} from "vue";
import Ic_circle from "@/Components/svgs/ic_circle.vue";
import Ic_document_tick from "@/Components/svgs/ic_document_tick.vue";
import Ic_list from "@/Components/svgs/ic_list.vue";
import {useForm} from "@inertiajs/inertia-vue3";
import Ic_tick_blue from "@/Components/svgs/ic_tick_blue.vue";
import InputError from "@/Components/InputError.vue";
import Ic_info from "@/Components/svgs/ic_info.vue";
import Ic_timer from "@/Components/svgs/ic_timer.vue";
import PopupShowFile from "@/Components/Orders/popupShowFile.vue";
import Ic_tick from "@/Components/svgs/ic_tick.vue";
import Ic_close_circle from "@/Components/svgs/ic_close_circle.vue";
import Ic_document_uploaded from "@/Components/svgs/ic_document_uploaded.vue";

const prop = defineProps(['attrs','project'])
const info = ref(null)

const files = ref(0)
const file = ref(null)
const showFile = ref(false)

const isRun = ref(!!prop.attrs.startInfo)
const page = ref(isRun.value?1:0)
onMounted(()=>{
    if (prop.attrs.startAttrs){
        const data = prop.attrs.startAttrs
        for (const i in data) {
            if (data[i].value!=null || data[i].description!=null)
                files.value++
        }
    }
})

const form = useForm({
    attrs:[],
    info:prop.attrs.startInfo?prop.attrs.startInfo[0].description:null,
    project_id:prop.project.id
})
const setStatus = async () => {
    form.post(route('admin.start.store'))
}
const openFile = (attr) => {
    showFile.value = true
    file.value = attr
}
</script>
