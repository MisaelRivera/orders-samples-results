<script setup>
    import { ref } from 'vue';
    import { Link, usePage, useForm } from '@inertiajs/vue3';
    import { Alert, Form, FormItem, Input, Col, Row, Select, Modal } from 'ant-design-vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    const props = defineProps({
        rule: {
            type: Object
        },
        parameters: {
            type: Object
        }   
    });
    const page = usePage();
    const deleteParam = ref(null);
    const addParam = ref(null);
    const selectedOptions = ref([]);
    const optionParams = ref(props.parameters);
    const isVisibleAddModal = ref(false);
    const isVisibleDeleteModal = ref(false);
    const handleDeselectParam = (value, option) => {
        deleteParam.value = option;
        isVisibleDeleteModal.value = true;
    };

    const handleConfirmRemoveParam = async () => {
        isVisibleDeleteModal.value = false;

        deleteParam.value = null;
    };

    const handelCancelDeleteParam = ()=> {
        selectedOptions.value.push(deleteParam.value);
        deleteParam.value = null;
        isVisibleDeleteModal.value = false;
    };

    const handleSelectParam = (value, option) => {
        addParam.value = option;
        isVisibleAddModal.value = true;
    };

    const handleConfirmAddParam = async() => {};
    const handleCancelAddParam = () => {
        selectedOptions.value = selectedOptions.value.filter(option => option.id !== addParam.value.id);
        addParam.value = null;
        isVisibleAddModal.value = false;
    };
</script>
<template>
    <AuthenticatedLayout>
        <Row>
            <Col :span="20" :offset="2">
                <Alert 
                    type="success"
                    v-if="page.props.flash.message"
                    :message="page.props.flash.message"
                    closable/>
                <div class="bg-white p-5 rounded-lg mt-2">
                    <h1 class="text-center text-xl font-semibold">
                        <Link href="/rules">
                            <i class="fas fa-long-arrow-alt-left"></i>
                        </Link>
                        Detalles de la norma {{ rule.name }}
                    </h1>
                    <Select
                    @deselect="handleDeselectParam"
                    placeholder="Please select"
                    v-model:value="selectedOptions"
                    mode="multiple"
                    class="w-full"
                    :options="optionParams"
                    @select="handleSelectParam">

                    </Select>
                </div>
            </Col>
        </Row>
        <Modal
            v-model:open="isVisibleDeleteModal"
            :title="`Remover parametro ${deleteParam}`"
            @cancel="handelCancelDeleteParam"
            @ok="handleConfirmRemoveParam">
            {{ `Estas seguro que deseas remover ${deleteParam} de la norma ${rule.name}` }}
        </Modal>
        <Modal
            v-model:open="isVisibleAddModal"
            :title="`Remover parametro ${addParam}`"
            @cancel="handleCancelAddParam"
            @ok="handleConfirmRemoveParam">
            {{ `Estas seguro que deseas agregar ${addParam} de la norma ${rule.name}` }}
        </Modal>
    </AuthenticatedLayout>
</template>