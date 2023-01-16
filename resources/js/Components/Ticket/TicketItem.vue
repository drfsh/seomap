<template>
    <div class="ticket">
        <div class="ticket__body">
            <p>
                {{data.body}}
            </p>
        </div>
        <hr>
        <div class="ticket__footer">
            <div class="ticket__footer__meta">

                <div class="ticket__footer__meta__item">
                    <img src="/images/icons/order-list.svg" alt="">
                    {{data.title}}
                </div>

                <div class="ticket__footer__meta__item">
                    <img src="/images/icons/tag.svg" alt="">
                    {{data.code}}
                </div>

                <div class="ticket__footer__meta__item">
                    <img src="/images/icons/calendar.svg" alt="">
                    {{data.updated_at[0]}}
                </div>

                <div class="ticket__footer__meta__item">
                    <img src="/images/icons/timer.svg" alt="">
                    {{data.updated_at[1]}}
                </div>

                <div class="ticket__footer__meta__item">
                    <img src="/images/icons/message-remove.svg" alt="">
                    وضعیت تیکت:
                    <span :class="{'c-red':data.status===0,'c-gold':data.status===1,'c-green':data.status===2}" style="font-weight: 600;">{{data.status_fa}}</span>
                </div>
            </div>
            <Link class="ticket__footer__link" :href="route(admin?'admin.ticket.view':'ticket.view',{code:data.code})">
                مشاهده کامل تیکت
                <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6.24988 12.9399L1.35988 8.04987C0.782383 7.47237 0.782383 6.52738 1.35988 5.94988L6.24988 1.05988" stroke="#04102B" stroke-width="1.8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </Link>
        </div>
    </div>
</template>

<script setup>
import {Link} from '@inertiajs/inertia-vue3'
defineProps(['data','admin'])

</script>
