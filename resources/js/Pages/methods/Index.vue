<script setup>
    import { ref, reactive } from 'vue';
    import { Link, usePage, router } from '@inertiajs/vue3';
    import { Alert, Modal, Col, Row } from 'ant-design-vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { createRange } from '@/helpers/general';
    const pageUse = usePage();
    const props = defineProps({
        totalItemsProp: {
            type: Number
        },
        methodsProp: {
            type: Object
        }
    });
    const methods = ref(props.methodsProp);
    const deleteMethod = reactive({
        method_id: null,
        name: null
    });
    const isVisibleDeleteModal = ref(false);
    const handleOpenDeleteModal = (method) => {
        deleteMethod.method_id = method.method_id;
        deleteMethod.name = method.name;
        isVisibleDeleteModal.value = true;
    };
    const handleDeleteMethod = async() => {
        isVisibleDeleteModal.value = false;
        try {
            router.visit(`/methods/${deleteMethod.method_id}`, { method: 'delete' });
        } catch (e) {
            console.log(e);
        }
    }
</script>
<template>
    <AuthenticatedLayout>
        <Row>
            <Col :span="20" :offset="2">
                <Alert
                    v-if="pageUse.props.flash.message"
                    type="success"
                    :message="pageUse.props.flash.message"
                    closable/>
                <h1 class="font-bold text-center flex items-center">
                    Metodos
                    <Link href="/methods/create">
                        <i class="fas fa-plus w-6 h-6 rounded-full bg-green-500 text-white py-1 ml-2"></i>
                    </Link>
                </h1>
                <table class="border mt-1">
                    <thead>
                        <tr>
                            <th class="border py-2 px-4 bg-slate-600 text-white">Metodo</th>
                            <th class="border py-2 px-4 bg-slate-600 text-white"></th>
                            <th class="border py-2 px-4 bg-slate-600 text-white"></th>
                            <th class="border py-2 px-4 bg-slate-600 text-white"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="method in methods">
                            <td class="border py-2 px-4 bg-slate-100">
                                {{ method.name }}
                            </td>
                            <td class="border py-2 px-4 bg-slate-100">
                                <Link :href="`/methods/${method.method_id}/show`">
                                    <i class="fas fa-eye text-blue-400"></i>
                                </Link>
                            </td>
                            <td class="border py-2 px-4 bg-slate-100">
                                <Link :href="`/methods/${method.method_id}/edit`">
                                    <i class="fas fa-edit text-blue-500"></i>
                                </Link>
                            </td>
                            <td class="border py-2 px-4 bg-slate-100">
                                <button
                                    @click="() => handleOpenDeleteModal(method)">
                                    <i class="fas fa-trash text-white bg-red-500 p-1 rounded-full"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </Col>
        </Row>
        <Modal
            :title="`Eliminar parametro ${deleteMethod.name}`"
            v-model:open="isVisibleDeleteModal"
            @ok="handleDeleteMethod">

        </Modal>
    </AuthenticatedLayout>
</template>