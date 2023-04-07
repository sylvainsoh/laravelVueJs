import {createRouter, createWebHistory} from "vue-router";
import CustomerIndex from "../components/CustomerIndex.vue";
import CustomerCreate from "../components/CustomerCreate.vue";

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
    }
]

export default createRouter({
    history : createWebHistory(),
    routes
})
