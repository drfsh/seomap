<template>
<AdminLayout>
    <div class="content__card">
        <div class="content__card__head">
            <h2 class="content__card__head__title">پشتیبانی</h2>
            <Link :href="route('admin.ticket.create')" class="btn btn--outline-primary">
                ارسال تیکت جدید
            </Link>
        </div>
        <div class="content__card__body">
            <!-- Widgets - START -->
            <div class="row gy-4">
                <div class="col-md-6 col-lg-3">
                    <div class="ticket-widget">
                        <img src="/images/icons/tickets/all.svg" alt="">
                        <div>
                            <span>{{tickets.total}}</span>
                            <span>همه تیکت ها</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="ticket-widget">
                        <img src="/images/icons/tickets/answered.svg" alt="">
                        <div>
                            <span>{{tOk}}</span>
                            <span>پاسخ داده شده</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="ticket-widget">
                        <img src="/images/icons/tickets/pending.svg" alt="">
                        <div>
                            <span>{{tProcess}}</span>
                            <span>در حال بررسی</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="ticket-widget">
                        <img src="/images/icons/tickets/not-answered.svg" alt="">
                        <div>
                            <span>{{tComing}}</span>
                            <span>پاسخ داده نشده</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Widgets - END -->

            <div class="mt-5">
                <div v-if="tickets.total>0" class="ticket-head">
                    <div class="ticket-head__result-text">
                        نمایش <span>{{tickets.from-tickets.to+1}}</span> از <span>{{tickets.total}}</span>
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
                <div v-else class="text-center ">
                    <div class="mb-3">هنوز تیکتی ندارید</div>
                </div>
                <!-- Tickets - START -->
                <TicketItem :admin="true" v-for="t in tickets.data" :data="t" :key="t.id"></TicketItem>
                <!-- Tickets - END -->

                <Paginate :data="tickets"></Paginate>

            </div>
        </div>
    </div>
</AdminLayout>
</template>

<script setup>
import {Link} from '@inertiajs/inertia-vue3'
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Paginate from "@/Components/Paginate.vue";
import TicketItem from "@/Components/Ticket/TicketItem.vue";

const prop = defineProps({
    tickets:Object,
    tComing:Number,
    tProcess:Number,
    tOk:Number,
    tFinish:Number,
})
</script>

<style scoped>

</style>
