<script setup>
import { Inertia } from "@inertiajs/inertia";
import { onMounted, reactive } from "vue";

const emit = defineEmits(['cancel'])
const props = defineProps({
    selectedContact: Object
})

const formState = reactive({
    name: "",
    company: "",
    phone: "",
    email: ""
});
const onFinish = (values) => {
    Inertia.put(`contacts/${props.selectedContact.id}`, values, {
        onFinish: () => {
            emit('cancel');
        }
    })
};

onMounted(() => {
    formState.name = props.selectedContact.name
    formState.email = props.selectedContact.email
    formState.phone = props.selectedContact.phone
    formState.company = props.selectedContact.company    
})
</script>
<template>
    <h1 style="font-size: 25px; text-align: center;">Edit Contact</h1>
    <a-form
        :model="formState"
        name="basic"
        layout="vertical"
        autocomplete="off"
        @finish="onFinish"
    >
        <a-form-item
            label="Name"
            name="name"
            :rules="[{ required: true, message: 'Name is required!' }]"
        >
            <a-input v-model:value="formState.name" />
        </a-form-item>

        <a-form-item
            label="Company"
            name="company"
            :rules="[{ required: true, message: 'Company field is required!' }]"
        >
            <a-input v-model:value="formState.company" />
        </a-form-item>

        <a-form-item
            label="Phone"
            name="phone"
            :rules="[{ required: true, message: 'Phone field is required!' }]"
        >
            <a-input v-model:value="formState.phone" />
        </a-form-item>

        <a-form-item
            label="Email"
            name="email"
            :rules="[
                { required: true, message: 'Email field is required!' },
                { type: 'email' },
            ]"
        >
            <a-input v-model:value="formState.email" />
        </a-form-item>

        <div style="text-align: right">
            <a-form-item>
                <a-button style="margin-right: 10px;" @click="emit('cancel')">Cancel</a-button>
                <a-button type="primary" html-type="submit">Submit</a-button>
            </a-form-item>
        </div>
    </a-form>
</template>
