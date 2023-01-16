<template>
    <AdminLayout>
        <div class="content__card">
            <div class="content__card__head">
                <h2 class="content__card__head__title">ایجاد سرویس جدید</h2>
                <Link :href="route('admin.services')" class="btn btn--outline-primary">
                    بازگشت
                </Link>
            </div>
            <div class="content__card__body">
                <form @submit.prevent="submit">
                    <div class="row gy-4">
                        <div class="col-lg-6">
                            <label class="form-label">عنوان سرویس</label>
                            <div class="input-group">
                                <input v-model="form.name" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">توضیحات</label>
                            <div class="input-group">
                                <input v-model="form.description" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">ادرس</label>
                            <div class="input-group">
                                <input v-model="form.slug" type="text" class="form-control">
                            </div>
                            <div class="mt-3 text-start" style="color: #15609c;font-size: 13px">https://seomap.ir/service/{{form.slug}}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="avatar-upload">
                                <div class="avatar-upload__src">
                                    <img id="profile" src="/images/icons/add-square.svg" alt="">
                                </div>
                                <div class="avatar-upload__body">
                                    <span class="avatar-upload__body__file">
                          <label for="avatar-upload__body__file__input">
                            <img src="/images/icons/export.svg" alt="">
                            آپلود تصویر
                          </label>
                          <input @change="selectImage" id="avatar-upload__body__file__input" type="file"
                                 accept="image/*" hidden="">
                        </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 text-end align-self-end">
                            <button type="submit" class="btn btn--primary outline">
                                ثبت ایجاد سرویس جدید
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import {Link, useForm} from "@inertiajs/inertia-vue3"
import AdminLayout from "@/Layouts/AdminLayout.vue";
import SelectInput from "@/Components/SelectInput.vue";

const form = useForm({
    name: null,
    description: null,
    slug:null,
    image : null,
});
const submit = () => {
    form.post(route('admin.service.store'), {
        forceFormData:true,
    });
};
const selectImage = (event) => {
    if (event.target.files && event.target.files[0]) {
        const imageFile = event.target.files[0];
        const fileReader = new FileReader();

        fileReader.readAsDataURL(imageFile);

        fileReader.onload = () => {
            form.image = imageFile
            document.getElementById('profile').src = fileReader.result
        };
    }
}
</script>
