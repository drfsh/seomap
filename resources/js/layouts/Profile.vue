<template>
    <div class="content__card">
        <div class="content__card__head">
            <h2 class="content__card__head__title">ویرایش اطلاعات</h2>
        </div>

        <div class="content__card__body tabby">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade active show" id="all" role="tabpanel" aria-labelledby="all-tab">
                    <div class="content__card__body">
                        <form action="#">
                            <div class="row gy-4">
                                <div class="col-md-6 col-lg-4">
                                    <label class="form-label">نوع کاربر</label>

                                    <div class="radios-1">
                                        <div role="button" class="item" :class="{active:type===1}" @click="type=1">
                                            حقیقی
                                        </div>
                                        <div role="button" class="item" :class="{active:type===2}" @click="type=2">
                                            حقوقی
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <label class="form-label">نام {{ nameTitle }} </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" :placeholder="'مثل:‌'+nameExample">
                                        <span class="input-group-text">
											<img src="/images/icons/user.svg" alt="">
										</span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <label class="form-label">شماره تلفن </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="مثل:‌ 09123456789">
                                        <span class="input-group-text">
											<img src="/images/icons/mobile.svg" alt="">
										</span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <label class="form-label">ایمیل</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" placeholder="seomap.ir@gmail.com">
                                        <span class="input-group-text">
									<img src="/images/icons/sms.svg" alt="">
								  </span>
                                    </div>
                                </div>

                                <hr>
                                <div class="col-md-6 col-lg-4">
                                    <label class="form-label">رمز عبور قبلی</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" placeholder="********">
                                        <span class="input-group-text">
                                            <img src="/images/icons/eye.svg" alt="">
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <label class="form-label">رمز عبور جدید</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" placeholder="********">
                                        <span class="input-group-text">
                                            <img src="/images/icons/eye.svg" alt="">
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <label class="form-label">تکرار رمز عبور جدید</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" placeholder="********">
                                        <span class="input-group-text">
                                            <img src="/images/icons/eye.svg" alt="">
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-12 text-center align-self-end">
                                    <button type="submit" class="btn btn--primary outline">
                                        بروزرسانی اطلاعات
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Profile",
    data() {
        return {
            type: 1
        }
    },
    computed: {
        nameTitle() {
            if (this.type === 1)
                return 'کاربر'
            else
                return 'شرکت'
        },
        nameExample() {
            if (this.type === 1)
                return 'مهدی درفشیده'
            else
                return 'سئومپ'
        },
    }
}
</script>

<style scoped>

</style>