<script setup>
    import { useForm } from '@inertiajs/vue3';
    import { Alert, Form, FormItem, Input, InputNumber, Col, Row } from 'ant-design-vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    const props = defineProps({
        errors: Object,
    });
    const formState = useForm({
        folio: null,
        fecha_recepcion: null,
        hora_recepcion: null,
        numero_muestras: null,
    });
    const handleSendData = () => {
        formState.post('/orders');
    };
    console.log(props.errors);
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
                                <Row>
                                    <Col :span="11">
                                        <FormItem
                                            label="Folio"
                                            name="folio"
                                            :rules="[{ required: true, message: 'Ingrese el folio' }]">
                                            <Input 
                                                v-model:value="formState.folio"/>
                                        </FormItem>
                                        <template v-if="Object.keys(errors).includes('folio')">
                                            <Alert
                                                type="error"
                                                :message="errors['folio']"
                                                />
                                        </template>
                                    </Col>
                                    <Col :span="11" :offset="1">
                                        <FormItem
                                            label="Numero de muestras"
                                            name="numero_muestras"
                                            :rules="[{ required: true, message: 'Ingrese el numero de muestras' }]">
                                            <InputNumber 
                                                v-model:value="formState.numero_muestras"
                                                :min="0"
                                                :max="30"
                                                class="w-full"/>
                                        </FormItem>
                                        <template v-if="Object.keys(errors).includes('numero_muestras')">
                                            <Alert
                                                type="error"
                                                :message="errors['numero_muestras']"
                                                closable/>
                                        </template>
                                    </Col>
                                </Row>
                                <Row>
                                    <Col :span="11">
                                        <FormItem
                                            label="Fecha de recepcion"
                                            name="fecha_recepcion"
                                            :rules="[{ required: true, message: 'Ingrese la fecha de recepcion'}]">
                                            <Input 
                                                v-model:value="formState.fecha_recepcion"
                                                type="date"/>
                                        </FormItem>
                                        <template v-if="Object.keys(errors).includes('fecha_recepcion')">
                                            <Alert
                                                type="error"
                                                :message="errors['fecha_recepcion']"
                                                closable/>
                                        </template>
                                    </Col>
                                    <Col :span="11" :offset="1">
                                        <FormItem
                                            label="Hora de recepcion"
                                            name="hora_recepcion"
                                            :rules="[]">
                                            <Input 
                                                v-model:value="formState.hora_recepcion"
                                                type="time"/>
                                        </FormItem>
                                            <Alert
                                                v-if="Object.keys(errors).includes('hora_recepcion')"
                                                type="error"
                                                :message="errors['hora_recepcion']"
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