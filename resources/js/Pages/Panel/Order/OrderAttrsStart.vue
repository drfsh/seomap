<template>
    <div v-if="prop.attrs.startInfo" class="attrs" style="flex-wrap: nowrap;min-height: 100%">
        <div class="item w-100" style=";padding: 20px">
            <div>
                <div style="font-size: 14px;margin-top: 8px;">
                    <ic_info style="width: 20px;" class="mx-2"></ic_info>
                    {{prop.attrs.startInfo[0].description}}
                </div>
                <div style="font-size: 13px;margin-right: 35px;margin-top: 10px;">
                    برای ارسال هر کدام بر روی آن کلیک کنید!
                </div>
                <span class="data-left" style="right: unset; left: 30px; top: 20px;">
                    {{prop.attrs.startInfo[0].created_at_fa}}
                </span>
                <div class="row m-0 mt-4 px-2 order-detail">
                    <div role="button" @click="sendFile(v)" v-for="v in attrs.startAttrs" class="mb-4 col-12 col-md-6 col-xl-4 col-lg-6">
                        <ic_tick_blue v-if="v.value!=null || v.description!=null" ></ic_tick_blue>
                        <ic_document_upload v-else></ic_document_upload>
                        <strong style="font-size: 13px"> &nbsp; {{ v.name }} </strong>
                    </div>
                </div>

                <div style="font-size: 14px;margin-top: 25px;">
                    <ic_danger style="width: 20px;" class="mx-2"></ic_danger>
                    در صورت امکان اگر فایل دیگر ای مدنظر دارین که قرار است در سایت به کاربران نمایش داده شود حتما برای ما ارسال کنید.
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
import Ic_danger from "@/Components/svgs/ic_danger.vue";
import Ic_document_upload from "@/Components/svgs/ic_document_upload.vue";

const prop = defineProps(['attrs','project'])
const info = ref(null)

const files = ref(0)
const file = ref(null)
const showFile = ref(false)

const isRun = ref(!!prop.attrs.startInfo)
const page = ref(isRun.value?1:0)
onMounted(()=>{
    if (prop.attrs.start){
        const data = prop.attrs.start
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
const sendFile = (attr) => {
    showFile.value = true
    file.value = attr
}
</script>
