// import axios from "axios"
// import {localId} from "../../global"
export function getDataAccount(context){
    // if(context.state.account.length <= 0){
    //     console.log('ESTOU NO AQUI modules')
    //     axios.get('account/'+context.state.user.id).then(json => {
    //         context.commit('setAccount', json.data.response.account)

    //         localStorage.setItem(localId+'account', [JSON.stringify( json.data.response.account)])
    //     }).catch(e=>console.log(e))
    // }else{
    //     console.log('ESTOU NO ELSEIF EXISTE modules')
    // }
}
export function Auth(context, data){
    // axios.post('/auth/login', data)
    // .then(json=>{
    //     context.commit('setUser', json.data.response.user)
    //     // context.commit('setToken', json.data.authorisation.token)
    //     console.log('Estou na modules')

    //     localStorage.setItem(localId+'token', JSON.stringify(json.data.response.authorization.token))
    // }).catch(e=>console.log(e))
}
export function logout(context){
    // localStorage.removeItem(`${localId}account`)
    // localStorage.removeItem(`${localId}token`)
    // context.commit('setUser', [])
    // document.location.replace(document.location.origin)

}

