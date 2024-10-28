<script setup>
import { Inertia } from "@inertiajs/inertia";
import axios from "axios";
import { reactive } from "vue";

const formState = reactive({
    name: "",
    password: "",
    email: "",
});
const onFinish = (values) => {
    Inertia.post("register", values);
};
</script>
<template>

    <div
        style="
            width: 500px;
            margin-left: auto;
            margin-right: auto;
            background-color: #e2dcdb;
            padding: 20px;
            margin-top: 100px;
            border-radius: 15px;
        "
    >
    <h1 style="font-size: 40px; text-align: center">Register Now</h1>
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
                :rules="[
                    { required: true, message: 'Email field is required!' },
                    { type: 'email' }
                ]"
            >
                <a-input v-model:value="formState.email" />
            </a-form-item>

            <a-form-item
                label="Password"
                name="password"
                :rules="[
                    { required: true, message: 'Password field is required!' },
                ]"
            >
                <a-input-password v-model:value="formState.password" />
            </a-form-item>

            <div style="margin-top: 50px;">

                Already had an account? Click <a href="login">this</a> to login!
                <br><br>

                <a-form-item>
                    <a-button type="primary" html-type="submit" style="width: 100%;"
                        >Submit</a-button
                    >
                </a-form-item>
            </div>
        </a-form>
    </div>
</template>
