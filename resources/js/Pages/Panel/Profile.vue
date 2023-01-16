<template>
    <PanelLayout>
        <div class="content__card">
            <div class="content__card__head">
                <h2 class="content__card__head__title">ویرایش اطلاعات</h2>
            </div>

            <div class="content__card__body tabby">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade active show" id="all" role="tabpanel" aria-labelledby="all-tab">
                        <div class="content__card__body">
                            <form @submit.prevent="submit">
                                <div class="row gy-4">
                                    <div class="col-md-6 col-lg-4">
                                        <label class="form-label">نام و نام خانوادگی </label>
                                        <div class="input-group">
                                            <input type="text" v-model="form.name" class="form-control"
                                                   placeholder="مثل:‌ مهدی درفشیده">
                                            <span class="input-group-text">
											<img src="/images/icons/user.svg" alt="">
										</span>
                                        </div>
                                        <InputError class="mt-2" :message="form.errors.name"/>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <label class="form-label">شماره تلفن </label>
                                        <div class="input-group disabled">
                                            <input disabled type="text" v-model="user.mobile" class="form-control"
                                                   placeholder="مثل:‌ 09123456789">
                                            <span class="input-group-text">
											<img src="/images/icons/mobile.svg" alt="">
										</span>

                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <label class="form-label">ایمیل</label>
                                        <div class="input-group">
                                            <input type="email" v-model="form.email" class="form-control"
                                                   placeholder="seomap.ir@gmail.com">
                                            <span class="input-group-text">
									<img src="/images/icons/sms.svg" alt="">
								  </span>
                                        </div>
                                        <InputError class="mt-2" :message="form.errors.email"/>
                                    </div>

                                    <!--                                <hr>-->
                                    <!--                                <div class="col-md-6 col-lg-4">-->
                                    <!--                                    <label class="form-label">رمز عبور قبلی</label>-->
                                    <!--                                    <div class="input-group">-->
                                    <!--                                        <input v-model="form.old_password" type="password" class="form-control" placeholder="********">-->
                                    <!--                                        <span class="input-group-text">-->
                                    <!--                                            <img src="/images/icons/eye.svg" alt="">-->
                                    <!--                                        </span>-->
                                    <!--                                    </div>-->
                                    <!--                                </div>-->
                                    <!--                                <div class="col-md-6 col-lg-4">-->
                                    <!--                                    <label class="form-label">رمز عبور جدید</label>-->
                                    <!--                                    <div class="input-group">-->
                                    <!--                                        <input type="password" v-model="form.new_password" class="form-control" placeholder="********">-->
                                    <!--                                        <span class="input-group-text">-->
                                    <!--                                            <img src="/images/icons/eye.svg" alt="">-->
                                    <!--                                        </span>-->
                                    <!--                                    </div>-->
                                    <!--                                </div>-->
                                    <!--                                <div class="col-md-6 col-lg-4">-->
                                    <!--                                    <label class="form-label">تکرار رمز عبور جدید</label>-->
                                    <!--                                    <div class="input-group">-->
                                    <!--                                        <input type="password" v-model="form.conf_password" class="form-control" placeholder="********">-->
                                    <!--                                        <span class="input-group-text">-->
                                    <!--                                            <img src="/images/icons/eye.svg" alt="">-->
                                    <!--                                        </span>-->
                                    <!--                                    </div>-->
                                    <!--                                </div>-->
                                    <!--                                -->

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
                                                  <label for="upload">
                                                    <img src="/images/icons/export.svg" alt="">
                                                    آپلود تصویر پروفایل
                                                  </label>
                                                  <input id="upload" type="file"
                                                         accept="image/*" @change="selectImage" hidden="">
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-start align-self-end">
                                        <button :disabled="form.processing" type="submit"
                                                class="btn btn--primary outline">
                                            <span v-if="!form.processing">بروزرسانی اطلاعات</span>
                                            <Loading v-else color="#2f5bea"></Loading>
                                        </button>
                                        <Transition enter-from-class="opacity-0" leave-to-class="opacity-0"
                                                    class="transition ease-in-out">
                                            <p v-if="form.recentlySuccessful" class="text-sm text-gray-600"
                                               style="margin-top: 17px;color: #52b229;font-size: 14px;">تغییرات با
                                                موفقیت ذخیره شد.</p>
                                        </Transition>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </PanelLayout>
</template>

<script setup>
import PanelLayout from "@/Layouts/PanelLayout.vue";
import {useForm, usePage} from "@inertiajs/inertia-vue3";
import InputError from "@/Components/InputError.vue";
import Loading from "@/Components/Loading.vue";
import {ref} from "vue";

const user = usePage().props.value.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
    profile : null,
    old_password: null,
    new_password: null,
    conf_password: null,
});

const submit = () => {
    form.post(route('profile.update'), {
        forceFormData:true,
        onFinish: () => {
            form.reset('password', 'password_confirmation')
            window.changeProfile = true
        },
    });
};

const pathProfile = ref(user.profile==='/images/icons/user.svg'?'/images/avatar-placeholder.png':user.profile)
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

<style scoped>

</style>
