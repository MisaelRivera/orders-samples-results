<script setup>
    import { useForm } from '@inertiajs/vue3';
    import { Alert, Form, FormItem, Input, InputNumber, Col, Row } from 'ant-design-vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { createRange } from '../../helpers/general';
    const props = defineProps({
        samples_number: {
            type: Number
        },
        starting_number: {
            type: Number
        },
        order_id: {
            type: Number
        },
    });
    const formState = useForm({
        samples: []
    });
    for (let i = props.starting_number; i < props.starting_number + props.samples_number; i++) {
        formState.samples.push({
            tipo_muestra: null,
            paramettros: null,
        });
    }

    const handleSendData = () => {
        formState.post('/samples');
    };
</script>
<template>
    <AuthenticatedLayout>
        <Row>
            <Col :span="20" :offset="2">
                <div class="bg-white p-5">
                    <h1 class="text-xl font-bold mt-2">Crear Orden</h1>
                    <Row>
                        <Col :span="24">
                            <Form 
                                :model="formState"
                                name="create_orders"
                                @finish="handleSendData"
                                layout="vertical">
                                <div class="bg-white p-5 rounded m-3" v-for="i in createRange(starting_number, samples_number)">
                                    <Row>
                                        <Col :span="11">
                                            <FormItem
                                                :label="`Tipo de muestra ${i}`"
                                                :name="`tipo_muestra_${i}`"
                                                :rules="[{ required: true, message: 'Ingrese el tipo de muestra' }]">
                                                <Input 
                                                    v-model:value="formState.samples[i].tipo_muestra"/>
                                            </FormItem>
                                        </Col>
                                        <Col :span="11" :offset="1">
                                            <FormItem
                                                :label="`Parametros ${i}`"
                                                :name="`parametros_${i}`"
                                                :rules="[{ required: true, message: 'ingrese los parametros' }]">
                                                <Input 
                                                    v-model:value="formState.samples[i].parametros"/>
                                            </FormItem>
                                        </Col>
                                    </Row>
                                </div>
                                <button class="bg-green-500 text-white rounded py-2 px-4">Crear</button>
                            </Form>
                        </Col>
                    </Row>
                </div>
            </Col>
        </Row>
    </AuthenticatedLayout>
</template>