<script setup>
import { Inertia } from "@inertiajs/inertia";
import { computed, onMounted, ref } from "vue";
import {
    LogoutOutlined,
    MenuUnfoldOutlined,
    MenuFoldOutlined,
} from "@ant-design/icons-vue";

const props = defineProps({
    user: Object,
    resellers: Object,
    filters: String,
    users: Object,
});

const links = [
    {
        route: "dashboard",
        title: "DASHBOARD",
        icon: "Dashboard.svg",
    },
    {
        route: "contacts",
        title: "CONTACTS",
        icon: "List.svg",
    },
    {
        route: "user",
        title: "USER",
        icon: "List.svg",
    }
];
const collapsed = ref(false);
</script>

<template>
    <div class="min-h-screen w-full">
        <a-layout class="w-full" style="min-height: 100vh">
            <div class="fixed h-full">
                <a-layout-sider
                    style="background: #004271; height: 100%"
                    width="270"
                    v-model:collapsed="collapsed"
                    collapsible
                >
                    <div style="text-align: center" class="mt-6"></div>
                    <br><br><br><br><br><br><br>
                    <div class="p-6">
                        <ul>
                            <li
                                v-for="link in links"
                                :key="link.key"
                                class="my-4"
                                style="border: 1px solid gray; color: white; border-right: none; border-left: none;"
                            >
                                <a :href="link.route">
                                    <button
                                        class="text-white border-none rounded-md bg-none cursor-pointer flex items-center"
                                        as="button"
                                    >
                                        <span
                                            :class="collapsed ? 'ml-8' : 'ml-6'"
                                            >{{ link.title }}</span
                                        >
                                    </button>
                                </a>
                            </li>
                        </ul>
                    </div>
                </a-layout-sider>
            </div>
            <a-layout>
                <a-layout-header
                    :class="{
                        'ml-[270px]': !collapsed,
                        'ml-[80px]': collapsed,
                    }"
                    class="fixed w-full z-10"
                    style="background: white"
                >
                    <div
                        class="flex justify-between items-center"
                        style="text-align: right"
                    >
                        <a
                            @click="Inertia.post('logout')"
                            method="post"
                            as="button"
                            type="button"
                            :class="{
                                'mr-[270px]': !collapsed,
                                'mr-[80px]': collapsed,
                            }"
                            class="bg-white border-none cursor-pointer hover:bg-slate-100 h-1/2"
                        >
                            <span class="text-md">
                                Logout
                                <logout-outlined style="color: #004271" />
                            </span>
                        </a>
                    </div>
                </a-layout-header>
                <a-layout-content style="background: #f4f4f4">
                    <div
                        class="p-4 mt-20"
                        :class="{ 'ml-72': !collapsed, 'ml-[85px]': collapsed }"
                    >
                        <slot></slot>
                    </div>
                </a-layout-content>
                <a-layout-footer>
                    <slot name="footer"> </slot>
                </a-layout-footer>
            </a-layout>
        </a-layout>
    </div>
</template>

<style scoped>
ul {
    padding: 0;
    margin: 0;
}

ul li {
    list-style-type: none;
    padding: 20px;
}

.active-link {
    background-color: #36688b !important;
}

.link {
    background-color: #004271 !important;
}
</style>
