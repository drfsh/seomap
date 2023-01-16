<template>
    <PanelLayout>
        <div class="content__card">
            <div class="content__card__head">
                <h2 class="content__card__head__title">ارسال تیکت جدید</h2>
                <Link :href="route('ticket.list')" class="btn btn--outline-primary">
                    بازگشت
                </Link>
            </div>
            <div class="content__card__body">
                <form @submit.prevent="submit">
                    <div class="row gy-4">
                        <div class="col-lg-6">
                            <label class="form-label">دپارتمان</label>
                            <SelectInput v-model="form.dep" :options="dep"></SelectInput>
                            <InputError class="mt-2" :message="form.errors.dep"/>

                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">عنوان تیکت</label>
                            <div class="input-group">
                                <input v-model="form.title" type="text" class="form-control">
                            </div>
                            <InputError class="mt-2" :message="form.errors.title"/>
                        </div>
                        <div class="col-lg-12">
                            <label class="form-label">محتوای تیکت</label>
                            <div class="input-group">
                                <textarea  v-model="form.text" type="text" rows="8" class="form-control"></textarea>
                            </div>
                            <InputError class="mt-2" :message="form.errors.text"/>
                        </div>
                        <div class="col-lg-6 d-flex aling-items-center">
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
                        <div class="col-lg-6 text-start align-self-end">
                            <button type="submit" class="btn btn--primary outline">
                                ارسال تیکت
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </PanelLayout>
</template>

<script setup>
import {Link, useForm} from '@inertiajs/inertia-vue3'
import PanelLayout from "@/Layouts/PanelLayout.vue";
import {ref} from "vue";
import SelectInput from "@/Components/SelectInput.vue";
import InputError from "@/Components/InputError.vue";
const dep = ref([
    'طراحی و توسعه',
    'تیم فنی',
    'پشتیبانی',
    'ارتباط با مدیریت'
])
const form = useForm({
    title:null,
    dep:null,
    text:null,
    file:null
});
const textFile = ref(null)
const submit = () => {
    form.post(route('ticket.store'), {
        forceFormData:true,
    });
};
const selectFile = (event) => {
    if (event.target.files && event.target.files[0]) {
        const file = event.target.files[0];
        form.file = file
        textFile.value = file.name
    }
}

</script>
