/*import store from '@/store';
import axios from 'axios';

// any mutation that is commited will be given to us here
store.subscribe((mutation) => {
    // console.log(mutation);
    switch (mutation.type) {
        case 'auth/SET_TOKEN':
            // if we have a token to set
            if (mutation.payload) {
                axios.defaults.headers.common['Authorization'] = `Bearer ${mutation.payload}`
                localStorage.setItem('token', mutation.payload)
            } else {
                axios.defaults.headers.common['Authorization'] = null
                localStorage.removeItem('token')
            }
        break;
    }
})*/
