<script setup>
import { Inertia } from "@inertiajs/inertia";
import { reactive } from "vue";
const formState = reactive({
    email: "",
    password: "",
    remember: true,
});
const onFinish = (values) => {
    Inertia.post('login', values)
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
        <h1 style="font-size: 40px; text-align: center">Login</h1>
        <a-form
            :model="formState"
            name="basic"
            autocomplete="off"
            layout="vertical"
            @finish="onFinish"
        >
            <a-form-item
                label="Email"
                name="email"
                :rules="[
                    { required: true, message: 'Email is required!' },
                ]"
            >
                <a-input v-model:value="formState.email" />
            </a-form-item>

            <a-form-item
                label="Password"
                name="password"
                :rules="[
                    { required: true, message: 'Password is required!' },
                ]"
            >
                <a-input-password v-model:value="formState.password" />
            </a-form-item>

            <div style="margin-top: 50px">

                Not a user? Click <a href="register">this</a> to register!
                <br><br>

                <a-form-item>
                    <a-button
                        style="width: 100%"
                        type="primary"
                        html-type="submit"
                        >Submit</a-button
                    >
                </a-form-item>
            </div>
        </a-form>
    </div>
</template>
