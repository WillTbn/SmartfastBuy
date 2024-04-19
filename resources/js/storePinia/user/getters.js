const getters = {
    condomiaView:(state)=>(can_seach)=>{
        return state.cans.includes(can_seach)
    },
    userMaster:(state)=>{
        return state.role == 'Master'
    }
};

export default { ...getters };
