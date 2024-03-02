import {toast } from 'vue3-toastify'

export default function useNotify() {
    // const $q = useQuasar();

    const successNotify = (message) => {
        // $q.notify({
        //     type: "positive",
        //     message: message || "Tudo certo!",
        // });
        toast(message || "Succeso!", {
            type:'success',
            theme: "colored",
            transition:'slide',
            autoClose:3000
        })
    };

    const errorNotify = (message) => {
        toast(message || "Oops.. erro!", {
            type:'error',
            theme: "colored",
            transition:'slide',
            autoClose:3000
        })
        // $q.notify({
        //     type: "negative",
        //     message: message || "Falha!",
        // });
    };
    const infoNotify = (message) => {
        toast(message || "Dado recebido!", {
            type:'info',
            theme: "colored",
            transition:'slide',
            autoClose:3000
        })
    };

    return {
        errorNotify,
        successNotify,
        infoNotify,
    };
}
