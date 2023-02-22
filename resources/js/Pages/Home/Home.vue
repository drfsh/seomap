<template>
<div class="container home">
    <div class="d-flex top">
        <div class="texts">
            <div class="name">SEOMAP</div>
            <div class="info">تیم طراحی و برنامه نویسی سئومپ</div>
            <div class="btns">
                <Link :href="route('dashboard')" > ورود به پشتیبانی </Link>
                <a href="https://seomap.ir" class="back"> بازگشت به سئومپ </a>
            </div>
        </div>
        <div class="slide">
            <img src="/images/home/bg-slider.svg">
        </div>
    </div>
    <div class="text-center">
        <div class="info-t">مجموعه تیم طراحی و برنامه نویسی سئومپ</div>
        <div class="info-t">ضمانت موفقیت مشتریان در توسعه کسب و کار آنلاین</div>
        <img class="mt-4" src="/images/home/dot.svg">
    </div>
    <div class="boxes row">
        <div class="col-md-3">
            <div class="item">
                <img src="/images/home/programing.svg">
                <div class="name">پشتیبانی و مشاوره</div>
                <div class="info">بصورت 24 ساعته</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="item">
                <img src="/images/home/developer.svg">
                <div class="name">طراحی و توسعه</div>
                <div class="info">CMS wordpress</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="item">
                <img src="/images/home/seo%20&%20optimization.svg">
                <div class="name">سئو و بهینه سازی</div>
                <div class="info">SEO & OPTIMIZATION</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="item">
                <img src="/images/home/supporting.svg">
                <div class="name">برنامه نویسی</div>
                <div class="info">PHP - Laravel - Vue</div>
            </div>
        </div>
    </div>
    <div class="text-center">
        <img width="98%" src="/images/home/div%23services-items_after.svg">
    </div>
    <div class="text-center bottom">
        کلیه حق و حقوق این وب سایت برای <span> سئومپ </span> محفوظ می باشد.
    </div>
</div>
</template>

<script setup>
import {Link} from '@inertiajs/inertia-vue3'
</script>
