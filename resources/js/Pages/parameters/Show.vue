<script setup>
    import { ref } from 'vue';
    import { Link } from '@inertiajs/vue3';
    import { Alert, Form, FormItem, Input, Col, Row } from 'ant-design-vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    const props = defineProps({
        parameter: {
            type: Object
        }
    });

    const lcp = ref({
        value: null,
        is_numeric: true,
    });

    const handleAddLcp = () => {

    };
</script>
<template>
    <AuthenticatedLayout>
        <Row>
            <Col :span="20" :offset="2">
                <div class="bg-white p-5 rounded-lg mt-2">
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
                                @finished="handleAddLcp">
                                <Row :gutter="[40, 0]">
                                    <Col :span="12">
                                        <a-form-item
                                            label="Lcp"
                                            name="value">
                                            <a-input-number
                                                v-if="lcp.is_numeric" 
                                                v-model:value="lcp.value"
                                                class="w-full"/>
                                            <Input 
                                                v-else
                                                v-model:value="lcp.value"/>
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
                        </Col>
                    </Row>
                </div>
            </Col>
        </Row>
    </AuthenticatedLayout>
</template>