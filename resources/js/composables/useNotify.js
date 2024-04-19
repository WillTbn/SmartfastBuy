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

    const errorNotify = (message = "Oops.. Erro!", tempClose =3000) => {
        toast(message, {
            type:'error',
            theme: "colored",
            transition:'slide',
            autoClose:tempClose
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
    const multError = (obj) => {
        let qua = 1
        for(const key in obj){
            qua++
            let formatInt = parseInt(`${qua}000`)
            errorNotify(obj[key], formatInt)
        }
    }

    return {
        errorNotify,
        successNotify,
        infoNotify,
        multError,
    };
}
