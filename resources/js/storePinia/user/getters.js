const getters = {
  // doubleCount: (state) => state.counter * 2,
//   getInvestiment: (state) => {
//     return state.data.investment.initial;
//   },
//   currentInvestimentSeries: (state) => (arraySeries) => {
//     console.log("Estou aqui", arraySeries);
//     let investmentInitial = state.data.investment.initial;
//     const arrayReturn = [];
//     for (let i = 0; i < arraySeries.length; i++) {
//       let valueNew;
//       let addValue;
//       addValue = investmentInitial * (arraySeries[i] / 100);
//       valueNew = investmentInitial + addValue;
//       arrayReturn.push(valueNew);
//     }
//     console.log("array return -> ", arrayReturn);
//     return arrayReturn;
//   },

//   expiration: (state) => {
//     const dataLocal = JSON.parse(localStorage.getItem("SA_user"));
//     console.log("ESTOU NO GETTERS", dataLocal);
//     if (dataLocal) {
//       return dataLocal.expiration_date != null ? true : false;
//     }
//   },
    condomiaView:(state)=>(can_seach)=>{
        return state.cans.includes(can_seach)
    },
    userMaster:(state)=>{
        return state.role == 'Master'
    }
};

export default { ...getters };
