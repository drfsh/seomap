<template>
    <div class="content__footer">
        <div class="content__footer__contact">
            <a href="tel:09130904084">
                <ic_phone></ic_phone>
                پشتیبانی :  09123456789
            </a>
        </div>
        <div class="content__footer__socials">
            <a href="#">
                <img
                    src="/images/icons/socials/instagram.svg"
                    alt="instagram"
                />
            </a>
            <a href="#">
                <img
                    src="/images/icons/socials/whatsapp.svg"
                    alt="whatsapp"
                />
            </a>
            <a href="#">
                <img
                    src="/images/icons/socials/telegram.svg"
                    alt="telegram"
                />
            </a>
        </div>
    </div>
</template>

<script>
import Ic_phone from "../svgs/ic_phone.vue";
export default {
    name: "FooterPages",
    components: {Ic_phone}
}
</script>

<style scoped>

</style>