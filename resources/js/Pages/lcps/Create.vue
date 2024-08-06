<script setup>
    import { useForm } from '@inertiajs/vue3';
    import { Alert, Form, FormItem, Input, InputNumber, Checkbox, Col, Row } from 'ant-design-vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    const props = defineProps({
        errors: Object,
    });
    const formState = useForm({
        value: null,
        is_numeric: true
    });
    const handleSendData = () => {
        formState.post('/lcps');
    };
    console.log(props.errors);
</script>
<template>
    <AuthenticatedLayout>
        <Row>
            <Col :span="20" :offset="2">
                <div class="bg-white p-5">
                    <h1 class="text-xl font-bold mt-2">Crear LCP</h1>
                    <Row>
                        <Col :span="24">
                            <Form 
                                :model="formState"
                                name="create_lcps"
                                @finish="handleSendData"
                                layout="vertical">
                                <Row
                                    :gutter="8">
                                    <Col :span="11" class="gutter-row">
                                        <FormItem
                                            label="Lcp"
                                            name="value"
                                            :rules="[{ required: true, message: 'Ingrese el valor' }]">
                                            <a-input-number
                                                v-if="formState.is_numeric"
                                                 v-model:value="formState.value"
                                                min="0.0000001"
                                                class="w-full"/>
                                            <Input 
                                                v-model:value="formState.value"
                                                v-else/>
                                        </FormItem>
                                        <p
                                            v-if="Object.keys(errors).includes('name')">
                                            {{ errors['name'] }}
                                        </p>
                                    </Col>
                                    <Col :span="4" class="flex justify-center items-center">
                                        <Checkbox v-model:checked="formState.is_numeric">Es numerico?</Checkbox>
                                    </Col>
                                </Row>
                                <button class="bg-green-500 text-white rounded py-2 px-4">Crear</button>
                            </Form>
                        </Col>
                    </Row>
                </div>
            </Col>
        </Row>
    </AuthenticatedLayout>
</template>
<style scoped>
    .gutter-row {
        padding: 0 8px;
    }
</style>