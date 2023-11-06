import axios from 'axios';
import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useAuthUserStore = defineStore('AuthUserStore', () => {
    const user = ref({
        name: '',
        email: '',
        role: '',
    });

    const getAuthUser = async () => {
        await axios.get('/api/profile')
            .then((response) => {
                user.value = response.data;
            });
    };

    // const isAdmin = async () =>{
    //     await axios.get('/api/profile')
    //         .then((response)=>{
    //             user.value.role == 1;
    //             return true;
    //         });
    // }

    
    return { user, getAuthUser};

});
