<template>
    <button :class="classes" @click="click(data)" title="Update">
        <span>
            <i  :class="classesicon" aria-hidden="true"></i>
        </span>
        &nbsp;
        {{ name }}
    </button>
</template>

<script>
    export default {
        name: "BtnDanger",
        props: {
            data: {},
            name: {},
            click: {
                type: Function,
                default: () => {}
            },
            classesicon:{
                type: Object,
                default: () => ({
                    'fa': true,
                    'fa-times-circle': true,
                }),
            },
            classes: {
                type: Object,
                default: () => ({
                    'btn': true,
                    'btn-danger': true,
                    'btn-sm': true,
                }),
            },
        }
    }
</script>

<style scoped>

</style>