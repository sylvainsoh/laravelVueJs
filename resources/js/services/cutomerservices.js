import {ref} from "vue";
import axios from "axios";

export default function useCustomers() {

    const errors = ref('');
    const customer =ref([]);
    const customers = ref([]);
    const getCustomers = async () => {
        let response = await axios.get('/api/customers');
        customers.value = response.data.data;
    };

    const getCustomer = async (id) => {
        let response = await axios.get('/api/customers/'+id);
        customer.value=response.data.data;
    };

    const createCustomer = async (data) => {
        errors.value='';
        try {
            await axios.post('/api/customers', data);
        } catch (error) {
            const createCustomersErrors = error.response.data.errors;

            for (const key in createCustomersErrors) {
                errors.value += createCustomersErrors[key][0] + ' ';
            }
        }
    };
    const updateCustomer = async (id) => {
        errors.value='';
        try {
            await axios.put('/api/customers/'+id,customer.value);
        } catch (error) {
            const createCustomersErrors = error.response.data.errors;

            for (const key in createCustomersErrors) {
                errors.value += createCustomersErrors[key][0] + ' ';
            }
        }
    };


    const destroyCustomer = async (id) => {
        if (!window.confirm('Supprimer ce client ? ')) return;
      await axios.delete('api/customers/'+id);
      await getCustomers();
    };

    return {
        getCustomers,
        customers,
        getCustomer,
        customer,
        createCustomer,
        errors,
        updateCustomer,
        destroyCustomer
    };
}
