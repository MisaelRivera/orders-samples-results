<script setup>
    import { useForm, Link } from '@inertiajs/vue3';
    import { Alert, Form, FormItem, Input, InputNumber, Col, Row } from 'ant-design-vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    const props = defineProps({
        errors: Object,
        parameter: {
            type: Object
        }
    });
    const formState = useForm({
        name: props.parameter.name,
    });
    const handleSendData = (id) => {
        console.log(id);
        formState.put(`/parameters/${id}`);
    };
</script>
<template>
    <AuthenticatedLayout>
        <Row>
            <Col :span="20" :offset="2">
                <div class="bg-white p-5">
                    <h1 class="text-xl font-bold mt-2">
                        <Link href="/parameters">
                            <i class="fas fa-long-arrow-alt-left"></i>
                        </Link>
                        Editar {{ parameter.name }}
                    </h1>
                    <Row>
                        <Col :span="24">
                            <Form 
                                :model="formState"
                                name="edit_orders"
                                @finish="() => handleSendData(parameter.parameter_id)"
                                layout="vertical">
                                <Row>
                                    <Col :span="11">
                                        <FormItem
                                            label="Parametro"
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
                                <button class="bg-blue-600 text-white rounded py-2 px-4">Editar</button>
                            </Form>
                        </Col>
                    </Row>
                </div>
            </Col>
        </Row>
    </AuthenticatedLayout>
</template>