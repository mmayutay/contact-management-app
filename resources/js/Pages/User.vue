<script setup>
import { onMounted, reactive, ref } from "vue";
import AuthenticatedLayout from "../Components/AuthenticatedLayout.vue";
import { EditOutlined, DeleteOutlined } from '@ant-design/icons-vue'
import Modal from "../Components/Modal.vue";
import AddContact from "../Components/ContactsComponents/AddContact.vue";
import EditContact from "../Components/ContactsComponents/EditContact.vue";
import { Inertia } from "@inertiajs/inertia";
import AddUser from "../Components/UserComponents/AddUser.vue";
import EditUser from "../Components/UserComponents/EditUser.vue";

const props = defineProps({
    users: Object,
});
const showModal = ref(false)
const isEditContact = ref(false)
const selectedUser = ref({})

const columns = [
    {
        title: "Name",
        dataIndex: "name",
    },
    {
        title: "Email",
        dataIndex: "email",
    },
    {
        title: "Action",
        dataIndex: 'action'
    }
];


</script>

<template>
    <AuthenticatedLayout>
        <div style="text-align: right; margin: 20px;">
            <a-button @click="showModal = true">Add User</a-button>
        </div>        
        <div style="margin: 20px;">
            <a-table :columns="columns" :data-source="props.users" bordered>
            <template #bodyCell="{ column, record }">
                <template v-if="column.dataIndex === 'action'">
                    <a-button type="primary" @click="isEditContact = true, showModal = true, selectedUser = record">
                        <template #icon>
                            <EditOutlined/>
                        </template>
                    </a-button>

                    <a-popconfirm
                        title="Are you sure do you want to delete this Reseller?"
                        ok-text="Yes"
                        cancel-text="No"    
                        @confirm="confirmDelete(record)"
                    >
                        <a-button type="danger"> 
                            <template #icon>
                                <DeleteOutlined/>
                            </template>
                        </a-button>
                    </a-popconfirm>
                </template>
            </template>
        </a-table>
        </div>

        <Modal v-model:showModal="showModal" @close="showModal = false">
            <AddUser v-if="!isEditContact" @cancel="showModal = false" />
            <EditUser v-else @cancel="showModal = false" :selectedUser="selectedUser" />
        </Modal>
    </AuthenticatedLayout>
</template>