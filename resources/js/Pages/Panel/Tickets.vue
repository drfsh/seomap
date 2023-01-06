<template>
    <PanelLayout>
        <div class="content__card">
        <div class="content__card__head">
            <h2 class="content__card__head__title">پشتیبانی</h2>
            <a href="tickets-new.html" class="btn btn--outline-primary">
                ارسال تیکت جدید
            </a>
        </div>
        <div class="content__card__body">
            <!-- Widgets - START -->
            <div class="row gy-4">
                <div class="col-md-6 col-lg-3">
                    <div class="ticket-widget">
                        <img src="/images/icons/tickets/all.svg" alt="">
                        <div>
                            <span>7</span>
                            <span>همه تیکت ها</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="ticket-widget">
                        <img src="/images/icons/tickets/answered.svg" alt="">
                        <div>
                            <span>5</span>
                            <span>پاسخ داده شده</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="ticket-widget">
                        <img src="/images/icons/tickets/pending.svg" alt="">
                        <div>
                            <span>2</span>
                            <span>در حال بررسی</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="ticket-widget">
                        <img src="/images/icons/tickets/not-answered.svg" alt="">
                        <div>
                            <span>0</span>
                            <span>پاسخ داده نشده</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Widgets - END -->

            <div class="mt-5">
                <div class="ticket-head">
                    <div class="ticket-head__result-text">
                        نمایش <span>2</span> از <span>7</span>
                    </div>
                    <div class="ticket-head__filter">
                        <label class="form-label form-label--lg">مرتب سازی بر اساس</label>
                        <select id="ticket-filter-select" class="form-select tomselected ts-hidden-accessible" tabindex="-1">
                            <option value="">انتخاب کنید</option>
                            <option value="1">وضعیت</option>
                            <option value="2">تاریخ</option>
                        </select><div class="ts-wrapper form-select single rtl"><div class="ts-control"><input type="select-one" autocomplete="off" size="1" tabindex="0" role="combobox" aria-haspopup="listbox" aria-expanded="false" aria-controls="ticket-filter-select-ts-dropdown" id="ticket-filter-select-ts-control" placeholder="انتخاب کنید"></div><div class="ts-dropdown single" style="display: none;"><div role="listbox" tabindex="-1" class="ts-dropdown-content" id="ticket-filter-select-ts-dropdown"></div></div></div>
                    </div>
                </div>

                <!-- Tickets - START -->
                <div class="ticket">
                    <div class="ticket__body">
                        <p>
                            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ
                            و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه
                            روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای
                            شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف
                            بهبود ابزارهای کاربردی می باشد.
                        </p>
                    </div>
                    <hr>
                    <div class="ticket__footer">
                        <div class="ticket__footer__meta">

                            <div class="ticket__footer__meta__item">
                                <img src="/images/icons/order-list.svg" alt="">
                                عنوان تیکت
                            </div>

                            <div class="ticket__footer__meta__item">
                                <img src="/images/icons/tag.svg" alt="">
                                12085
                            </div>

                            <div class="ticket__footer__meta__item">
                                <img src="/images/icons/calendar.svg" alt="">
                                ۱۴۰۱/۰۱/۰۱
                            </div>

                            <div class="ticket__footer__meta__item">
                                <img src="/images/icons/timer.svg" alt="">
                                12:43
                            </div>

                            <div class="ticket__footer__meta__item">
                                <img src="/images/icons/message-remove.svg" alt="">
                                وضعیت تیکت:
                                <span class="text-green">پاسخ داده شده</span>
                            </div>
                        </div>
                        <a class="ticket__footer__link" href="tickets-detail.html">
                            مشاهده کامل تیکت
                            <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.24988 12.9399L1.35988 8.04987C0.782383 7.47237 0.782383 6.52738 1.35988 5.94988L6.24988 1.05988" stroke="#04102B" stroke-width="1.8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="ticket">
                    <div class="ticket__body">
                        <p>
                            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ
                            و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه
                            روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای
                            شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف
                            بهبود ابزارهای کاربردی می باشد.
                        </p>
                    </div>
                    <hr>
                    <div class="ticket__footer">
                        <div class="ticket__footer__meta">

                            <div class="ticket__footer__meta__item">
                                <img src="/images/icons/order-list.svg" alt="">
                                عنوان تیکت
                            </div>

                            <div class="ticket__footer__meta__item">
                                <img src="/images/icons/tag.svg" alt="">
                                12085
                            </div>

                            <div class="ticket__footer__meta__item">
                                <img src="/images/icons/calendar.svg" alt="">
                                ۱۴۰۱/۰۱/۰۱
                            </div>

                            <div class="ticket__footer__meta__item">
                                <img src="/images/icons/timer.svg" alt="">
                                12:43
                            </div>

                            <div class="ticket__footer__meta__item">
                                <img src="/images/icons/message-remove.svg" alt="">
                                وضعیت تیکت:
                                <span class="text-red">پاسخ داده نشده</span>
                            </div>
                        </div>
                        <a class="ticket__footer__link" href="tickets-detail.html">
                            مشاهده کامل تیکت
                            <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.24988 12.9399L1.35988 8.04987C0.782383 7.47237 0.782383 6.52738 1.35988 5.94988L6.24988 1.05988" stroke="#04102B" stroke-width="1.8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                <!-- Tickets - END -->

                <!-- Pagination - START -->
                <div class="pagination">
                    <div class="page-item">
                        <a href="#" class="page-link previous">
                            <img src="/images/icons/chevron.svg" alt="">
                        </a>
                    </div>
                    <div class="page-item">
                        <a href="#" class="page-link">1</a>
                    </div>
                    <div class="page-item">
                        <a href="#" class="page-link">2</a>
                    </div>
                    <div class="page-item active">
                        <a href="#" class="page-link">3</a>
                    </div>
                    <span>...</span>
                    <div class="page-item">
                        <a href="#" class="page-link">4</a>
                    </div>
                    <div class="page-item">
                        <a href="#" class="page-link next">
                            <img src="/images/icons/chevron.svg" alt="">
                        </a>
                    </div>
                </div>
                <!-- Pagination - END -->
            </div>
        </div>
    </div>
    </PanelLayout>
</template>

<script setup>
import PanelLayout from "@/Layouts/PanelLayout.vue";
</script>

<style scoped>

</style>
