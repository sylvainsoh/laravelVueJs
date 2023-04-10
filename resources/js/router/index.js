import {createRouter, createWebHistory} from "vue-router";
import CustomerIndex from "../components/CustomerIndex.vue";
import CustomerCreate from "../components/CustomerCreate.vue";
import CustomerEdit from "../components/CustomerEdit.vue";

const routes = [
    {
        path : '/dashboard',
        name : 'customer.index',
        component : CustomerIndex
    },
    {
        path : '/customers/create',
        name : 'customer.create',
        component : CustomerCreate
    },
    {
        path : '/customers/:id/edit',
        name : 'customer.edit',
        component : CustomerEdit,
        props: true
    }
]

export default createRouter({
    history : createWebHistory(),
    routes
})
