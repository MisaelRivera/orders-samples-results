<script setup>
    import { useForm } from '@inertiajs/vue3';
    import { Alert, Form, FormItem, Input, InputNumber, Col, Row } from 'ant-design-vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    const props = defineProps({
        errors: Object,
    });
    const formState = useForm({
        name: null,
    });
    const handleSendData = () => {
        formState.post('/units');
    };
    console.log(props.errors);
</script>
<template>
    <AuthenticatedLayout>
        <Row>
            <Col :span="20" :offset="2">
                <div class="bg-white p-5">
                    <h1 class="text-xl font-bold mt-2">Crear Unidad</h1>
                    <Row>
                        <Col :span="24">
                            <Form 
                                :model="formState"
                                name="create_units"
                                @finish="handleSendData"
                                layout="vertical">
                                <Row>
                                    <Col :span="11">
                                        <FormItem
                                            label="Unidad"
                                            name="name"
                                            :rules="[]">
                                            <Input 
                                                v-model:value="formState.name"/>
                                        </FormItem>
                                        <Alert
                                            v-if="Object.keys(errors).includes('name')"
                                            type="error"
                                            :message="errors['name']"
                                            />
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