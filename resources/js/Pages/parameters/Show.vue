<script setup>
    import { ref } from 'vue';
    import { Link, useForm } from '@inertiajs/vue3';
    import { Alert, Form, FormItem, Input, Col, Row } from 'ant-design-vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    const props = defineProps({
        parameter: {
            type: Object
        },
        errors: Object,
    });

    const lcps = ref(props.parameter.lcps);

    const lcp = useForm({
        value: null,
        is_numeric: true,
        parameter_id_foreign: props.parameter.parameter_id,
    });

    const removeLcp = ref({
        value: null,
        is_numeric: true,
        parameter_id_foreign: null,
    });

    const handleAddLcp = () => {
        console.log(lcp);
        lcp.post(`/lcps`);
    };
</script>
<template>
    <AuthenticatedLayout>
        <Row>
            <Col :span="20" :offset="2">
                <div class="bg-white p-5 rounded-lg mt-2">
                    <a-alert
                        v-if="Object.keys(errors).length > 0"
                        type="error"
                        v-for=" key in Object.keys(errors)"
                        :message="errors[key]"/>
                    <h1 class="text-center text-xl font-semibold">
                        <Link href="/parameters">
                            <i class="fas fa-long-arrow-alt-left"></i>
                        </Link>
                        Detalles del parametro {{ parameter.name }}
                    </h1>
                    <Row>
                        <Col :span="10" :offset="7">
                            <a-form
                                :model="lcp"
                                layout="vertical"
                                @finish="handleAddLcp">
                                <Row :gutter="[40, 0]">
                                    <Col :span="12">
                                        <a-form-item
                                            label="Lcp"
                                            name="value"
                                            :rules="[{ required: true, message: 'Ingrese el valor del lcp' }]">
                                            <a-input-number
                                                v-if="lcp.is_numeric" 
                                                v-model:value="lcp.value"
                                                class="w-full"
                                                />
                                            <Input 
                                                v-else
                                                v-model:value="lcp.value"
                                                />
                                        </a-form-item>
                                    </Col>
                                    <Col :span="6" class="flex justify-center items-center">
                                        <a-checkbox v-model:checked="lcp.is_numeric">Es numerico?</a-checkbox>
                                    </Col>
                                </Row>
                                <button 
                                    class="bg-green-400 text-white rounded py-2 px-4 mt-2">
                                    Agregar
                                </button>
                            </a-form>
                            <table class="border mt-2">
                                <thead>
                                    <tr>
                                        <th class="border py-2 px-4">Lcp</th>
                                        <th class="border py-2 px-4">Es numerico?</th>
                                        <th class="border py-2 px-4"></th>
                                        <th class="border py-2 px-4"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="lcpUnit in lcps">
                                        <td class="border py-2 px-4">{{ lcpUnit.value }}</td>
                                        <td class="border py-2 px-4">{{ lcpUnit.is_numeric ? 'Si':'No' }}</td>
                                        <td class="border py-2 px-4">
                                            <button class="bg-blue-400 text-white rounded py-2 px-4">Editar</button>
                                        </td>
                                        <td class="border py-2 px-4">
                                            <button class="bg-red-400 text-white rounded py-2 px-4">Eliminar</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </Col>
                    </Row>
                </div>
            </Col>
        </Row>
    </AuthenticatedLayout>
</template>