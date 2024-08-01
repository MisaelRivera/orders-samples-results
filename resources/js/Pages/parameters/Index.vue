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
        parametersProp: {
            type: Object
        }
    });
    const parameters = ref(props.parametersProp);
    const deleteParameter = reactive({
        parameter_id: null,
        name: null
    });
    const isVisibleDeleteModal = ref(false);
    const handleOpenDeleteModal = (parameter) => {
        deleteParameter.parameter_id = parameter.parameter_id;
        deleteParameter.name = parameter.name;
        isVisibleDeleteModal.value = true;
    };
    const handleDeleteParameter = async() => {
        isVisibleDeleteModal.value = false;
        try {
            router.visit(`/parameters/${deleteParameter.parameter_id}`, { method: 'delete' });
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
                    Parametro
                    <Link href="/parameters/create">
                        <i class="fas fa-plus w-6 h-6 rounded-full bg-green-500 text-white py-1 ml-2"></i>
                    </Link>
                </h1>
                <table class="border mt-1">
                    <thead>
                        <tr>
                            <th class="border py-2 px-4 bg-slate-600 text-white">Parametro</th>
                            <th class="border py-2 px-4 bg-slate-600 text-white"></th>
                            <th class="border py-2 px-4 bg-slate-600 text-white"></th>
                            <th class="border py-2 px-4 bg-slate-600 text-white"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="parameter in parameters">
                            <td class="border py-2 px-4 bg-slate-100">
                                {{ parameter.name }}
                            </td>
                            <td class="border py-2 px-4 bg-slate-100">
                                <Link :href="`/parameters/${parameter.parameter_id}/show`">
                                    <i class="fas fa-eye text-blue-400"></i>
                                </Link>
                            </td>
                            <td class="border py-2 px-4 bg-slate-100">
                                <Link :href="`/parameters/${parameter.parameter_id}/edit`">
                                    <i class="fas fa-edit text-blue-500"></i>
                                </Link>
                            </td>
                            <td class="border py-2 px-4 bg-slate-100">
                                <button
                                    @click="() => handleOpenDeleteModal(parameter)">
                                    <i class="fas fa-trash text-white bg-red-500 p-1 rounded-full"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </Col>
        </Row>
        <Modal
            :title="`Eliminar parametro ${deleteParameter.name}`"
            v-model:open="isVisibleDeleteModal"
            @ok="handleDeleteParameter">

        </Modal>
    </AuthenticatedLayout>
</template>