<template>
    <div class="flex-center position-ref full-height">
        <div class="code">
           Erro - 404
        </div>

        <div class="message" style="padding: 10px;">
            Página não encontrada
        </div>
    </div>
</template>
<script>

    const msgs = [
        `There's nothing here.`,
        `How did we get here?`,
        `That's a Four-Oh-Four.`,
        `Looks like we've got some broken links.`
    ]
    export default {
        methods: {
            getMsg () {
                return msgs[Math.floor(Math.random() * msgs.length)]
            }
        },
        name: "NotFound"
    }
</script>

<style scoped>
    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .code {
        border-right: 2px solid;
        font-size: 26px;
        padding: 0 15px 0 15px;
        text-align: center;
    }

    .message {
        font-size: 18px;
        text-align: center;
    }
</style>