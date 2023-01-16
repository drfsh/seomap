<template>
    <AdminLayout>
        <div class="content__card">
            <div class="content__card__head">
                <h2 class="content__card__head__title"> تیکت شماره {{ticket.code}} <span style="font-size: 70%;margin-right: 4px;color: #6a6a6a;">({{user.name}})</span>
                <span v-if="ticket.status===3" style="font-size: 70%;margin-right: 4px;color: #ff0f0f;">بسته شده</span>
                </h2>
                <div>
                    <Link method="post" :class="{'bg-blue':ticket.status===1}" :href="route('admin.ticket.status')" :data="{id:ticket.id,status:1}" class="btn btn--outline-primary ms-2">
                        درحال برسی
                    </Link>
                    <a v-if="ticket.project_id" target="_blank" :href="route('admin.order',{code:ticket.project_id+3500})" class="btn btn--outline-primary ms-2">
                        پروژه
                    </a>
                    <a target="_blank" :href="route('admin.user.edit',{id:ticket.user_id})" class="btn btn--outline-primary ms-2">
                        کاربر
                    </a>
                    <Link v-if="ticket.status!==3" method="post" :href="route('admin.ticket.status')" :data="{id:ticket.id,status:3}" class="btn btn--outline-primary">
                        بستن تیکت
                    </Link>
                    <Link v-else method="post" :href="route('admin.ticket.status')" :data="{id:ticket.id,status:2}" class="btn btn--outline-primary">
                        باز کردن تیکت
                    </Link>
                </div>
            </div>
            <div class="content__card__body">
                <div class="ticket__messages">
                    <div class="ticket__messages__outter" :class="{'h-100':ticket.status===3}">
                        <div class="ticket__messages__inner">
                            <TicketMessage v-for="t in messages" :key="t.id" :message="t"></TicketMessage>
                        </div>
                    </div>
                </div>

                <form @submit.prevent="submit" v-if="ticket.status != 3">
                    <div class="row gy-4 mt-1">
                        <div class="col-lg-12">
                            <label class="form-label">محتوای تیکت</label>
                            <InputError :message="form.errors.text"></InputError>
                            <div class="input-group">
                                <textarea v-model="form.text" type="text" rows="8" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex aling-items-center">
                            <div class="file-upload">
                                <label for="file-upload__input">
                                    <img src="/images/icons/export.svg" alt="">
                                    فایلهای خود را آپلود کنید
                                </label>
                                <input @change="selectFile" id="file-upload__input" type="file" multiple="" hidden="">
                                <span class="file-upload__names">{{textFile}}</span>
                            </div>
                            <InputError :message="form.errors.file"></InputError>
                        </div>
                        <div class="col-lg-6 text-start align-self-start">
                            <button type="submit" class="btn btn--primary outline">
                                ارسال تیکت
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>

import TicketMessage from "@/Components/Ticket/TicketMessage.vue";
import {useForm,Link} from "@inertiajs/inertia-vue3";
import {ref} from "vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import InputError from "@/Components/InputError.vue";

const prop = defineProps({
    messages:Object,
    ticket:Object,
    user:Object
});

const form = useForm({
    ticketId:prop.ticket.id,
    text:null,
    file:null,
});
const textFile = ref(null)
const submit = () => {
    form.post(route('admin.ticket.reply'), {
        forceFormData:true,
        onSuccess:()=>{
            form.reset('text')
        }
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
