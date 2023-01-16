<template>
    <AdminLayout>
        <div class="content__card">

            <div class="content__card__head">
                <h2 class="content__card__head__title"> ویرایش اطلاعات</h2>
                <Link :href="route('admin.users')" class="btn btn--outline-primary">
                    بازگشت
                </Link>
            </div>


            <div class="content__card__body">
                <form @submit.prevent="submit">
                    <div class="row gy-4">
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">نام و نام خانوادگی</label>
                            <div class="input-group">
                                <input v-model="form.name" type="text" class="form-control" placeholder="مثل:‌ یوسف رستمی">
                                <span class="input-group-text">
                        <img src="/images/icons/user.svg" alt="">
                      </span>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">تلفن همراه</label>
                            <div class="input-group">
                                <input v-model="form.mobile" type="number" class="form-control" placeholder="مثل:‌ 09391140414">
                                <span class="input-group-text">
                        <img src="/images/icons/mobile.svg" alt="">
                      </span>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">ایمیل</label>
                            <div class="input-group">
                                <input  v-model="form.email" type="email" class="form-control" placeholder="seomap.ir@gmail.com">
                                <span class="input-group-text">
                        <img src="/images/icons/sms.svg" alt="">
                      </span>
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label">رمز عبور</label>
                            <div class="input-group">
                                <input v-model="form.password" type="password" class="form-control" placeholder="********">
                                <span class="input-group-text">
                        <img src="/images/icons/eye.svg" alt="">
                      </span>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="avatar-upload">
                                <div class="avatar-upload__src">
                                    <img :src="pathProfile" alt="">
                                </div>
                                <div class="avatar-upload__body">
                        <span class="avatar-upload__body__text">
                          حداکثر اندازه فایل ۰.۵MB
                        </span>
                                    <span class="avatar-upload__body__file">
                          <label for="avatar-upload__body__file__input">
                            <img  src="/images/icons/export.svg" alt="">
                            آپلود تصویر پروفایل
                          </label>
                          <input @change="selectImage" id="avatar-upload__body__file__input" type="file" accept="image/*" hidden="">
                        </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 text-end align-self-end">
                            <button type="submit" class="btn btn--primary outline">
                                اضافه کردن کاربر جدید
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import {Link, useForm} from '@inertiajs/inertia-vue3';
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {ref} from "vue";

const prop = defineProps({
    user:Object
})
const form = useForm({
    id: prop.user.id,
    name: prop.user.name,
    email: prop.user.email,
    mobile:prop.user.mobile,
    profile : null,
    password: null,
});
const pathProfile = ref(prop.user.profile==='/images/icons/user.svg'?'/images/avatar-placeholder.png':prop.user.profile)

const submit = () => {
    form.post(route('admin.user.update'), {
        forceFormData:true,
    });
};
const selectImage = (event) => {
    if (event.target.files && event.target.files[0]) {
        const imageFile = event.target.files[0];
        const fileReader = new FileReader();

        fileReader.readAsDataURL(imageFile);

        fileReader.onload = () => {
            form.profile = imageFile
            pathProfile.value = fileReader.result
        };
    }
}
</script>
