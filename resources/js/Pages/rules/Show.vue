<script setup>
    import { Link, usePage } from '@inertiajs/vue3';
    import { Alert, Form, FormItem, Input, Col, Row } from 'ant-design-vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    const props = defineProps({
        rule: {
            type: Object
        }
    });
    const page = usePage();

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
                </div>
            </Col>
        </Row>
    </AuthenticatedLayout>
</template>