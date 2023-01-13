<script setup>
import {Head, useForm} from '@inertiajs/inertia-vue3';
import AuthLayout from "@/Layouts/AuthLayout.vue";
import {onMounted, ref, watch} from "vue";
import Loading from "@/Components/Loading.vue";

defineProps({
    canResetPassword: Boolean,
    status: String,
});
const step = ref(0)

const timer = ref('00:00:00')
const timeoutHandle = ref(null)
const showResend = ref(false)

const mobile = ref(null)
const name = ref(null)
const code = ref(null)
const processing = ref(false)
const res = ref(null)
const c1 = ref(null)
const c2 = ref(null)
const c3 = ref(null)
const c4 = ref(null)
const sendRequest = async () => {
    processing.value = true
    let {data} = await axios.post(route('smsLogin'), {
        mobile: mobile.value,
        name: name.value,
        code: code.value,
        remember: true
    })
    res.value = data
    step.value = data.data.step
    processing.value = false

    if (step.value === 2) {
        setTime(2, 0)
    }
}
const sendAuthRequest = async () => {
    processing.value = true
    let {data} = await axios.post(route('smsLogin.auth'),
        {mobile: mobile.value, code: '' + c1.value + c2.value + c3.value + c4.value, remember: true})
    res.value = data
    step.value = data.data.step
    processing.value = false

    if (step.value === 3)
        useForm().get(route('dashboard'))
}
const setTime = (min, sec) => {
    function tick() {
        timer.value = "00:0" + min.toString() + ":" + (sec < 10 ? "0" : "") + String(sec);
        sec--;
        if (sec >= 0) {
            timeoutHandle.value = setTimeout(tick, 1000)
        } else {
            if (min >= 1) {
                timeoutHandle.value = setTimeout(function () {
                    setTime(min - 1, 59)
                }, 1000)
            } else {
                showResend.value = true
            }
        }
    }

    tick();
}
watch(step, (value) => {
    if (value !== 2) {
        if (timeoutHandle.value) {
            clearTimeout(timeoutHandle.value)
            showResend.value = false
        }
    }
})
const nextInput = (input) => {
    input.focus();
    input.select();
}
const code1 = ref()
const code2 = ref()
const code3 = ref()
const code4 = ref()
watch(c1, () => {
    nextInput(code2.value)
})
watch(c2, () => {
    nextInput(code3.value)

})
watch(c3, () => {
    nextInput(code4.value)

})
watch(c4, () => {
    sendAuthRequest()
})
</script>

<template>
    <AuthLayout>
        <Head title="Log in"/>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>
        <div v-if="step===0 || step===1">
            <div class="text-center">
                <div class="title">ورود / ثبت نام</div>
                <div class="subtitle">لطفا شماره تلفن خود را وارد کنید</div>
            </div>
            <form @submit.prevent="sendRequest">
                <div class="w100">
                    <input placeholder="09123456789" :class="{error:(res!==null&&res.messages.mobile!==undefined)}"
                           type="number" v-model="mobile" class="input">
                </div>

                <div v-if="step===1" class="w100">
                    <input style="margin-top: 11px;direction: rtl;" placeholder="نام و نام خانوادگی" type="text"
                           v-model="name" class="input">
                </div>
                <div class="flex items-center justify-end mt-4">
                    <button class="btn-primary" :disabled="processing">
                        <span v-if="!processing">ورود</span>
                        <loading v-else></loading>
                    </button>
                </div>
            </form>
        </div>
        <div v-else-if="step===2 || step===3">

            <div class="text-center">
                <div class="title">ورود یا ثبت نام</div>
                <div class="subtitle">کد تایید 4 رقمی ارسال شده به شماره همراه زیر را وارد نمایید</div>
            </div>
            <div class="number-edit">
                <span class="number">{{ mobile }}</span>
                <span role="button" class="text" @click="step=0">ویرایش شماره</span>
            </div>
            <form @submit.prevent="sendAuthRequest">
                <div class="input-code">
                    <input :class="{error:(res!==null&&res.messages.code!==undefined)}" type="number" @click="$event.target.select()" ref="code1" min="0" max="9" maxlength="1"
                           v-model="c1">
                    <input :class="{error:(res!==null&&res.messages.code!==undefined)}" type="number" @click="$event.target.select()" min="0" ref="code2" max="9" maxlength="1"
                           v-model="c2">
                    <input :class="{error:(res!==null&&res.messages.code!==undefined)}" type="number" @click="$event.target.select()" min="0" max="9" ref="code3" v-model="c3"
                           maxlength="1">
                    <input :class="{error:(res!==null&&res.messages.code!==undefined)}" type="number" @click="$event.target.select()" min="0" max="9" ref="code4" v-model="c4"
                           maxlength="1">
                </div>
                <div v-if="!showResend" class="timer">{{ timer }}</div>
                <div class="resend-code" v-if="showResend" role="button">
                    <loading v-if="processing" color="#2f5bea"></loading>
                    <span v-else @click="sendRequest">ارسال مجدد کد</span>
                </div>
                <div class="flex items-center justify-end mt-4">
                    <button class="btn-primary" :disabled="processing">
                        <span v-if="!processing">ورود</span>
                        <loading v-if="processing"></loading>
                    </button>
                </div>
            </form>

        </div>
    </AuthLayout>
</template>
