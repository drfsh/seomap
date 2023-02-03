<template>
    <div class="min-title">اطلاعات درخواستی</div>
    <div v-if="prop.attrs.startInfo" class="attrs mt-3" style="flex-wrap: nowrap;min-height: 100%">

        <div class="item w-100" style=";padding: 20px">
            <div>
                <div style="font-size: 14px;margin-top: 8px;">
                    <ic_info style="width: 20px;" class="mx-2"></ic_info>
                    {{prop.attrs.startInfo[0].description}}
                </div>
                <div style="font-size: 13px;margin-right: 35px;margin-top: 10px;">
                    جهت ارسال و ویرایش اطلاعات هر کدام بر روی آن کلیک کنید!
                </div>
                <div class="row m-0 mt-4 px-2 order-detail">
                    <div role="button" @click="sendFile(v)" v-for="v in attrs.startAttrs" class="mb-4 col-12 col-md-6 col-xl-4 col-lg-6">
                        <ic_close_circle v-if="(v.value!=null || v.description!=null) && (v.value2!=1 && v.value2 !=null)" ></ic_close_circle>
                        <ic_tick_blue v-else-if="(v.value!=null || v.description!=null) && v.value2==1" ></ic_tick_blue>
                        <ic_document_uploaded v-else-if="v.value!=null || v.description!=null" ></ic_document_uploaded>
                        <ic_document_upload v-else></ic_document_upload>
                        <strong style="font-size: 13px"> &nbsp; {{ v.name }} </strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div v-else class="attrs" style="flex-wrap: nowrap;min-height: 100%">
        <div class="item w-100" style=";padding: 20px">
            درحال بررسی...
        </div>
    </div>
    <PopupShowFile v-model:visible="showFile" :attr="file"></PopupShowFile>
</template>

<script setup>

import {onMounted, ref} from "vue";
import {useForm} from "@inertiajs/inertia-vue3";
import Ic_tick_blue from "@/Components/svgs/ic_tick_blue.vue";
import Ic_info from "@/Components/svgs/ic_info.vue";
import PopupShowFile from "@/Components/Orders/popupShowFileUser.vue";
import Ic_danger from "@/Components/svgs/ic_danger.vue";
import Ic_document_upload from "@/Components/svgs/ic_document_upload.vue";
import Ic_close_circle from "@/Components/svgs/ic_close_circle.vue";
import Ic_document_tick from "@/Components/svgs/ic_document_tick.vue";
import Ic_document_uploaded from "@/Components/svgs/ic_document_uploaded.vue";

const prop = defineProps(['attrs','project'])
const info = ref(null)

const filesError = ref(0)
const file = ref(null)
const showFile = ref(false)

const isRun = ref(!!prop.attrs.startInfo)
const page = ref(isRun.value?1:0)
onMounted(()=>{
    if (prop.attrs.startAttrs){
        const data = prop.attrs.startAttrs
        for (const i in data) {
            if (data[i].value2!=null && data[i].value2!=1)
                filesError.value++
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
const sendFile = (attr) => {
    showFile.value = true
    file.value = attr
}
</script>
