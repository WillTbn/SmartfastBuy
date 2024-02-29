export function statusView (state) {
    // if(state.user.length === 0){
    //     return 'notAuth'
    // }
    // else if(state.user.type === 'N'){
    //     return 'authClient'
    // }
    // console.log('statusView -> ',state.user.type)
    // return 'auth'
}
export function apartmentsByIdCondominia(state, id){
    return state.condominia.apartments.find(ap =>ap.condominia_id === id )
}
