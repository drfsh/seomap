<template>
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
</template>

<script>
export default {
    name: "InputSelectTwo"
}
</script>

<style scoped>

</style>
