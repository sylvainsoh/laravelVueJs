<template>
    <div v-if="errors!=='' ">
        {{errors}}
    </div>
    <form class="space-y-6" @submit.prevent="saveCustomer">
        <div>
            <label for="id" class="block">Non du client</label>
            <input type="text" id="name" v-model="customer.name">
        </div>
        <div>
            <label for="tel"  class="block">Téléphone</label>
            <input type="text" id="tel"  v-model="customer.tel">
        </div>
        <div>
            <label for="is_favourite"  class="block">Favoris ? </label>
            <input type="checkbox" id="is_favouritetel"  v-model="customer.is_favourite">
        </div>
        <router-link :to="{name : 'customer.index'}" class="bg-gray-800 px-2 py-1 text-white rounded">
            Annuler
        </router-link>  &nbsp;
        <button type="submit" class="bg-gray-800 px-2 py-1 text-white rounded">
            Mettre à jour
        </button>
    </form>
</template>


<script>

import {onMounted } from "vue";
import useCustomers from "../services/cutomerservices.js";
import router from "../router";

export default {
    props : {
        id : {
            required : true,
            type : String
        }
    },

     setup(props) {
        const {getCustomer, customer, updateCustomer, errors} = useCustomers();

        onMounted(getCustomer(props.id));

        const saveCustomer = async() => {
            await updateCustomer(props.id);

            if (!errors.value) {
                await router.push({name: 'customer.index'})
            }
        };

        return {
            saveCustomer,
            customer,
            errors
        }
    }
}
</script>
