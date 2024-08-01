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
        rulesProp: {
            type: Object
        }
    });
    const rules = ref(props.rulesProp);
    const deleteRule = reactive({
        rule_id: null,
        name: null
    });
    const isVisibleDeleteModal = ref(false);
    const handleOpenDeleteModal = (rule) => {
        deleteRule.rule_id = rule.rule_id;
        deleteRule.name = rule.name;
        isVisibleDeleteModal.value = true;
    };
    const handleDeleteRule = async() => {
        isVisibleDeleteModal.value = false;
        try {
            router.visit(`/rules/${deleteRule.rule_id}`, { method: 'delete' });
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
                    Normas
                    <Link href="/rules/create">
                        <i class="fas fa-plus w-6 h-6 rounded-full bg-green-500 text-white py-1 ml-2"></i>
                    </Link>
                </h1>
                <table class="border mt-1">
                    <thead>
                        <tr>
                            <th class="border py-2 px-4 bg-slate-600 text-white">Norma</th>
                            <th class="border py-2 px-4 bg-slate-600 text-white"></th>
                            <th class="border py-2 px-4 bg-slate-600 text-white"></th>
                            <th class="border py-2 px-4 bg-slate-600 text-white"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="rule in rules">
                            <td class="border py-2 px-4 bg-slate-100">
                                {{ rule.name }}
                            </td>
                            <td class="border py-2 px-4 bg-slate-100">
                                <Link :href="`/rules/${rule.rule_id}/show`">
                                    <i class="fas fa-eye text-blue-400"></i>
                                </Link>
                            </td>
                            <td class="border py-2 px-4 bg-slate-100">
                                <Link :href="`/rules/${rule.rule_id}/edit`">
                                    <i class="fas fa-edit text-blue-500"></i>
                                </Link>
                            </td>
                            <td class="border py-2 px-4 bg-slate-100">
                                <button
                                    @click="() => handleOpenDeleteModal(rule)">
                                    <i class="fas fa-trash text-white bg-red-500 p-1 rounded-full"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </Col>
        </Row>
        <Modal
            :title="`Eliminar parametro ${deleteRule.name}`"
            v-model:open="isVisibleDeleteModal"
            @ok="handleDeleteRule">

        </Modal>
    </AuthenticatedLayout>
</template>