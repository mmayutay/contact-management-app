<script setup>
import { Inertia } from "@inertiajs/inertia";
import axios from "axios";
import { onMounted, reactive } from "vue";

const emit = defineEmits(['cancel'])
const props = defineProps({
    selectedUser: Object
})
const formState = reactive({
    name: "",
    email: "",
    password: ""
});
const onFinish = (values) => {
    Inertia.put(`user/${props.selectedUser.id}`, values, {
        onFinish: () => {
            emit('cancel')
        }
    })
};

onMounted(() => {
    formState.email = props.selectedUser.email
    formState.name = props.selectedUser.name
})
</script>
<template>
    <h1 style="font-size: 25px; text-align: center;">Edit User</h1>
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
            label="Email"
            name="email"
            :rules="[{ required: true, message: 'Email field is required!' }]"
        >
            <a-input v-model:value="formState.email" />
        </a-form-item>

        <a-form-item
            label="Password"
            name="password"
            :rules="[{ required: true, message: 'Password field is required!' }]"
        >
            <a-input-password v-model:value="formState.password" />
        </a-form-item>
        
        <div style="text-align: right">
            <a-form-item>
                <a-button style="margin-right: 10px;" @click="emit('cancel')">Cancel</a-button>
                <a-button type="primary" html-type="submit">Submit</a-button>
            </a-form-item>
        </div>
    </a-form>
</template>
