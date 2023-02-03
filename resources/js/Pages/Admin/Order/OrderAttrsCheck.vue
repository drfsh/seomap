<template>
    <div class="order-detail p-0 mt-3" style="flex-wrap: nowrap;min-height: 100%">
        <div style="padding:0 20px;margin-top: 20px;font-weight: 500;">
            <ic_list class="mx-2"></ic_list>
            جناب <a :href="route('admin.user.edit',{id:project.user.id})">{{project.user.name}}</a>
            مشخصات پروژه شما به شرح ذیل بررس گردید
        </div>
        <div class="item w-100" style=";padding: 20px">
            <div v-if="page===0">
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
                    <button @click="page=1" style="padding: 11px 18px;" class="me-2 btn btn--primary outline">
                        لغو
                    </button>
                    <button  @click="setStatus" style="padding: 11px 18px;" class="me-2 btn btn--primary outline">
                        <b v-if="!form.processing">
                            ذخیره
                        </b>
                        <Loading v-else color="#2f5bea"></Loading>
                    </button>
                </div>
            </div>
            <div v-else>
                <div>
                    <ic_info class="mx-2"></ic_info>
                    محتوا زیر توسط مشتری جهت برسی ارسال گردیده است.
                </div>
                <div class="row m-0 mt-4  p-3 order-detail">
                    <div :role="(v.value!=null || v.description!=null)?'button':''" @click="(v.value!=null || v.description!=null)?openFile(v):undefined" v-for="v in attrs.startAttrs" class="my-3 col-12 col-md-6 col-xl-3 col-lg-4 border-0">
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
    <div>
        <div class="min-title">توضیحات کارشناس فنی
        </div>
        <div class="order-detail mt-3">
            <div>
                <div class="col-12">
                    <div class="input-group">
                        <textarea style="height: 160px;" v-model="formDe.description" type="text" class="form-control" placeholder="توضیحات"></textarea>
                    </div>
                    <InputError :message="formDe.errors.description"></InputError>
                    <InputError :message="formDe.errors.description"></InputError>
                </div>
            </div>
        </div>
    </div>
    <div v-if="project.status===2" class="mt-3 text-start">
        <button  @click="submit" style="padding: 11px 18px;" class="me-2 btn btn--primary outline">
            <b v-if="!formDe.processing">
                شروع پروژه
            </b>
            <Loading v-else color="#2f5bea"></Loading>
        </button>
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
import Ic_edit from "@/Components/svgs/ic_edit.vue";

const prop = defineProps(['attrs','project'])
const info = ref(null)

const files = ref(0)
const file = ref(null)
const showFile = ref(false)

const page = ref(1)

const form = useForm({
    attrs:[],
    info:prop.attrs.startInfo?prop.attrs.startInfo[0].description:'لطفا محتوای زیر را جهت بررسی اولیه و طراحی باری ما ارسال نمایید.',
    project_id:prop.project.id
})
const setStatus = async () => {
    form.post(route('admin.start.store'),{
        onSuccess:()=>{
            page.value=1
        }
    })
}
const formDe = useForm({
    description:prop.attrs.startDescription?prop.attrs.startDescription[0].description:null,
    id:prop.project.id
})
const submit = async () => {
    formDe.post(route('admin.order.start'),{
        onSuccess:()=>{
            location.reload()
        }
    })
}
const openFile = (attr) => {
    showFile.value = true
    file.value = attr
}
</script>
