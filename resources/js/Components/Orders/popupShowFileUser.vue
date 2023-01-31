<!-- overlay.vue -->
<script setup>
import moment from "jalali-moment";
import InputError from "@/Components/InputError.vue";
import {useForm} from "@inertiajs/inertia-vue3";
import {ref, watch} from "vue";
import Loading from "@/Components/Loading.vue";
import Ic_danger from "@/Components/svgs/ic_danger.vue";
import Ic_close_circle from "@/Components/svgs/ic_close_circle.vue";
import Ic_tick_blue from "@/Components/svgs/ic_tick_blue.vue";

const props = defineProps(['visible', 'attr'])
const emit = defineEmits(['update:visible']);
const dataFormat = (date, format) => {
    return moment(date, 'YYYY-MM-DDTH:mm:ss.000000Z').locale('fa').format(format)
}
const textFile = ref(null)

const form = useForm({
    file:null,
    info:null,
    attr_id:null,
})
const sendFile = async () => {
    if (form.file==null && (form.info==null || form.info==''))
        return
    form.attr_id = props.attr.id
    form.post(route('file.send'),{
        forceFormData:true,
        onFinish:()=>{
            form.file=null
            form.info=null
            edit.value = false
            emit('update:visible', false)
        }
    })
}
const selectFile = (event) => {
    if (event.target.files && event.target.files[0]) {
        const file = event.target.files[0];
        form.file = file
        textFile.value = file.name
    }
}

const edit = ref(false)
const openEdit = () => {
    edit.value = true
}
const close = () => {
    emit('update:visible', false)
    edit.value = false
}
</script>

<template>
    <transition name="modal">
        <div class="modal-mask" v-if="visible">
            <div class="modal-wrapper">
                <div class="shadow" @click="close"></div>
                <div class="modal-container">
                    <div v-if="(attr.value!=null||attr.description!=null) && !edit">
                        <div class="title">{{ attr.name }}
                            <ic_close_circle v-if="(attr.value2!=1 && attr.value2 !=null)"></ic_close_circle>
                            <ic_tick_blue v-else-if="attr.value2==1"></ic_tick_blue>
                        </div>
                        <div v-if="(attr.value2!=1 && attr.value2 !=null)" class="mt-4">
                            <div class="" style="font-size: 13px;">فایل یا توضیحات خود را ویرایش کنید</div>
                            <div class="mb-3 c-red" style="font-size: 13px;">
                                <ic_danger class="st-red" style="width: 13px;"></ic_danger>
                                {{attr.value2}}
                            </div>
                        </div>
                        <span style="right: unset;left: 30px;top: 20px"
                              class="data-left">{{ dataFormat(attr.updated_at, 'DD MMMM') }}</span>
                        <div v-if="attr.description" class="row m-0 mt-4 px-4 order-detail position-relative">
                            {{ attr.description }}
                        </div>
                        <div v-if="attr.value" class="row m-0 mt-4 px-4 order-detail position-relative">
                            <a target="_blank" :href="attr.value">
                                بازکردن فایل
                            </a>
                        </div>
                        <div class="mt-3 text-start">
                            <button @click="close" type="button" class="btn mx-2 btn--primary outline">
                                <span>لغو</span>
                            </button>
                            <button  @click="openEdit" style="padding: 11px 18px;" class="me-2 btn btn--primary outline">
                                ویرایش
                            </button>
                        </div>
                    </div>
                    <div v-else>
                        <div class="title">{{ attr.name }}</div>
                        <div class="mt-4 order-detail__item flex-wrap justify-content-between"
                             style="z-index: 6;position: relative">
                            <div class="" style="font-size: 13px;">فایل یا توضیحات خود را ارسال کنید</div>
                            <div class="mb-3" style="font-size: 13px;">
                                <ic_danger style="width: 13px;"></ic_danger>
                                 فایل و توضیحات ارسالی قابل ویرایش نمیباشد پس در ارسال آن دقت فرمایید
                            </div>
                            <div class="col-12">
                                <div class="input-group">
                                    <textarea style="width: 120px" v-model="form.info" type="text" class="form-control" placeholder="توضیحات"></textarea>
                                </div>
                                <InputError :message="form.errors.info"></InputError>
                            </div>
                        </div>
                        <div class=" d-flex aling-items-center mt-3">
                            <div class="file-upload">
                                <label for="file-upload__input">
                                    <img src="/images/icons/export.svg" alt="">
                                    فایلهای خود را آپلود کنید
                                </label>
                                <input @change="selectFile" id="file-upload__input" type="file" multiple="" hidden="">
                                <span class="file-upload__names">{{ textFile }}</span>
                            </div>
                            <InputError class="mt-2" :message="form.errors.file"/>
                        </div>
                        <div class=" text-start align-self-end">
                            <button @click="close" type="button" class="btn mx-2 btn--primary outline">
                                <span>لغو</span>
                            </button>
                            <button @click="sendFile" type="button" class="btn btn--primary outline">
                                <span v-if="!form.processing">ارسال</span>
                                <Loading v-else color="#2f5bea"></Loading>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>
