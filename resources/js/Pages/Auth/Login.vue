<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import AuthLayout from "@/Layouts/AuthLayout.vue";
import {ref} from "vue";

defineProps({
    canResetPassword: Boolean,
    status: String,
});
const step = ref(0)
const form = useForm({
    mobile: '',
    code: '',
    remember: false,
});

const sendCode = () => {
    form.post(route('smsLogin'), {
        // onFinish: () => form.reset('password'),
        onSuccess: (data) =>{
            console.log(data)
        }
    });
};

</script>

<template>
    <AuthLayout>
        <Head title="Log in" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>
        <div v-if="step===0">
            <div class="text-center">
                <div class="title">ورود / ثبت نام</div>
                <div class="subtitle">لطفا شماره تلفن خود را وارد کنید</div>
            </div>
            <form @submit.prevent="sendCode">
                <div class="w100">
                    <input placeholder="09123456789" type="number" class="input">
                    <InputError class="mt-2"  :message="form.errors.mobile" />
                </div>
                <div class="flex items-center justify-end mt-4">
                    <button class="btn-primary" :disabled="form.processing">
                        ورود
                    </button>
                </div>
            </form>
        </div>
        <div v-else-if="step===2">

            <div class="text-center">
                <div class="title">ورود یا ثبت نام</div>
                <div class="subtitle">کد تایید 4 رقمی ارسال شده به شماره همراه زیر را وارد نمایید</div>
            </div>
            <div class="number-edit">
                <span class="number">{{ $parent.mobile }}</span>
                <span role="button" class="text" @click="step=0">

                <span>ویرایش شماره</span>
            </span>
            </div>
            <form @submit.prevent="sendCode">
                <div class="w100">
                    <input placeholder="09123456789" type="number" class="input">
                    <InputError class="mt-2"  :message="form.errors.mobile" />
                </div>
                <div class="flex items-center justify-end mt-4">
                    <button class="btn-primary" type="button" @click="step=2" :disabled="form.processing">
                        ورود
                    </button>
                </div>
            </form>
            <div class="block mt-4">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

        </div>
    </AuthLayout>
</template>
