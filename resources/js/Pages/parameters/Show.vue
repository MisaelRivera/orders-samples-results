<script setup>
    import { Link } from '@inertiajs/vue3';
    import { Alert, Form, FormItem, Input, Col, Row } from 'ant-design-vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    const props = defineProps({
        parameter: {
            type: Object
        }
    });


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
                </div>
            </Col>
        </Row>
    </AuthenticatedLayout>
</template>