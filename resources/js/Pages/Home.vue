<script setup>
import AuthenticatedLayout from '../Components/AuthenticatedLayout.vue';

const props = defineProps({
    user: Object
})
</script>
<template>
    <AuthenticatedLayout>
        <p style="padding: 20px; font-size: 40px;">
            Hello {{ props.user.name }}!!
        </p>        
    </AuthenticatedLayout>    
</template>