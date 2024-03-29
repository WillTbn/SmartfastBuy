const getters = {
    setNamesCondominias:(state)=>(value)=> {
        if(state.condominias){
            return state.condominias.map(obj => obj.name).includes(value)
        }
        return false
    }
};

export default { ...getters };
