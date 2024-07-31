<script setup>
    import { ref } from 'vue';
    import { Link } from '@inertiajs/vue3';
    import { Alert, Modal, Col, Row } from 'ant-design-vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { createRange } from '@/helpers/general';
    const props = defineProps({
        totalItemsProp: {
            type: Number
        },
        ordersProp: {
            type: Object
        }
    });
    const orders = ref(props.ordersProp);
</script>
<template>
    <AuthenticatedLayout>
        <Row>
            <Col :span="20" :offset="2">
                <h1 class="font-bold text-center flex items-center">
                    Orden
                    <Link href="/orders/create">
                        <i class="fas fa-plus w-6 h-6 rounded-full bg-green-500 text-white py-1 ml-2"></i>
                    </Link>
                </h1>
                <table class="border mt-1">
                    <thead>
                        <tr>
                            <th class="border py-2 px-4 bg-slate-600 text-white">Folio</th>
                            <th class="border py-2 px-4 bg-slate-600 text-white"></th>
                            <th class="border py-2 px-4 bg-slate-600 text-white">Fecha de recepcion</th>
                            <th class="border py-2 px-4 bg-slate-600 text-white">Hora de recepcion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="order in orders">
                            <td class="border py-2 px-4 bg-slate-100">
                                {{ order.folio }}
                            </td>
                            <td class="border py-2 px-4 bg-slate-100">
                                <Link :href="`/orders/${order.id}/edit`">
                                    <i class="fas fa-eye text-blue-400"></i>
                                </Link>
                            </td>
                            <td class="border py-2 px-4 bg-slate-100">
                                {{ order.fecha_recepcion }}
                            </td>
                            <td class="border py-2 px-4 bg-slate-100">
                                {{ order.hora_recepcion }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </Col>
        </Row>
    </AuthenticatedLayout>
</template>