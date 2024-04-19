const getters = {
    // setNamesCondominias:(state)=>(value)=> {
    //     if(state.condominias){
    //         return state.condominias.map(obj => obj.name).includes(value)
    //     }
    //     return false
    // }
    setName:(state) => {
        return state.formData.firstName + state.formData.lastName
    }
};

export default { ...getters };
