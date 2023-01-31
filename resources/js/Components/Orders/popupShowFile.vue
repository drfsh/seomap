<script setup>
import moment from "jalali-moment";
import {useForm} from "@inertiajs/inertia-vue3";
import Loading from "@/Components/Loading.vue";
import Ic_tick_blue from "@/Components/svgs/ic_tick_blue.vue";
import Ic_close_circle from "@/Components/svgs/ic_close_circle.vue";

const props = defineProps(['visible', 'attr'])
const emit = defineEmits(['update:visible']);
const dataFormat = (date, format) => {
    return moment(date, 'YYYY-MM-DDTH:mm:ss.000000Z').locale('fa').format(format)
}
const form = useForm({
    value2: null,
    attr_id: null,
    info: null,
})
const changeStatus = (i) => {
    form.value2 = i
    form.attr_id = props.attr.id
    form.post(route('admin.file.ok'), {
        onSuccess: () => {
            if (i === 0)
                props.attr.value2 = form.info
            else
                props.attr.value2 = i
            form.info = null
        }
    })
}
</script>

<template>
    <transition name="modal">
        <div class="modal-mask" v-if="visible">
            <div class="modal-wrapper">
                <div class="shadow" @click="$emit('update:visible', false)"></div>
                <div class="modal-container">
                    <div>
                        <div class="title">{{ attr.name }}
                            <ic_close_circle v-if="(attr.value2!=1 && attr.value2 !=null)"></ic_close_circle>
                            <ic_tick_blue v-else-if="attr.value2==1"></ic_tick_blue>
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
                        <hr>
                        <div class="mt-3 text-start">
                            <div class="col-12 mb-2">
                                <div class="input-group">
                                    <input style="width: 120px" v-model="form.info" type="text" class="form-control"
                                           :placeholder="(attr.value2!=1 && attr.value2!=null)?attr.value2:'توضیحات'"/>
                                </div>
                            </div>
                            <button @click="changeStatus(0)" style="padding: 11px 18px;"
                                    class="me-2 btn btn-outline-danger outline">
                                <b v-if="!form.processing">
                                    رد
                                </b>
                                <Loading v-else color="#2f5bea"></Loading>
                            </button>
                            <button @click="changeStatus(1)" style="padding: 11px 18px;"
                                    class="me-2 btn btn--primary outline">
                                <b v-if="!form.processing">
                                    تایید
                                </b>
                                <Loading v-else color="#2f5bea"></Loading>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>
