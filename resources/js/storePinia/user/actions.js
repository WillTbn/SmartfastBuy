const actions = {
//   getAccount(payload) {
//     let getJson = [];
//     getJson = {
//       ...this.data.account.filter((a) => {
//         return a.id == payload;
//       }),
//     };
//     const teste = { ...getJson[0] };
//     // console.log("vendpo getJson[0]->", getJson[0]);
//     // console.log("vendpo stor->", teste);
//     this.accountEdit = teste;
//   },

//   setUserData(payload) {
//     this.data = payload;
//     this.loan = payload != "" ? payload.loan : "";
//   },
//   setAvatarUpload(payload) {
//     this.data.avatar = payload;
//   },
//   setLoan(payload) {
//     this.loan = payload;
//   },
    setCan(payload){
        this.cans = payload
    },
    setRole(payload){
        this.role = payload
    }
};

export default { ...actions };
