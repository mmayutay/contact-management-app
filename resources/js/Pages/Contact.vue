<script setup>
import { onMounted, reactive, ref } from "vue";
import AuthenticatedLayout from "../Components/AuthenticatedLayout.vue";
import { EditOutlined, DeleteOutlined } from '@ant-design/icons-vue'
import Modal from "../Components/Modal.vue";
import AddContact from "../Components/ContactsComponents/AddContact.vue";
import EditContact from "../Components/ContactsComponents/EditContact.vue";
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
    contacts: Object,
});
const showModal = ref(false)
const isEditContact = ref(false)
const selectedContact = ref({})

const columns = [
    {
        title: "Name",
        dataIndex: "name",
    },
    {
        title: "Company",
        dataIndex: "company",
    },
    {
        title: "Phone",
        dataIndex: "phone",
    },
    {
        title: "Email",
        dataIndex: "email"
    },
    {
        title: "Action",
        dataIndex: "action"
    }
];

const confirmDelete = (value) => {
    Inertia.delete(`contacts/${value.id}`)
}

</script>

<template>
    <AuthenticatedLayout>
        <div style="text-align: right; margin: 20px;">
            <a-button @click="showModal = true">Add Contact</a-button>
        </div>        
        <div style="margin: 20px;">
            <a-table :columns="columns" :data-source="props.contacts" bordered>
            <template #bodyCell="{ column, record }">
                <template v-if="column.dataIndex === 'action'">
                    <a-button type="primary" @click="isEditContact = true, showModal = true, selectedContact = record">
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
            <AddContact v-if="!isEditContact" @cancel="showModal = false" />
            <EditContact v-else @cancel="showModal = false" :selectedContact="selectedContact" ></EditContact>
        </Modal>
    </AuthenticatedLayout>
</template>