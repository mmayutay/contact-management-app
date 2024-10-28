<script setup>
const props = defineProps({
    showModal: Boolean,
    title: String,
});

const emit = defineEmits(["close"]);

const handleOk = (e) => {
    open.value = false;
};
</script>

<template>
    <div>
        <a-modal
            :visible="showModal"
            :title="title"
            @ok="handleOk"
            @cancel="emit('close')"
            :footer="false"
            :closable="false"
        >
            <slot></slot>
        </a-modal>
    </div>
</template>
