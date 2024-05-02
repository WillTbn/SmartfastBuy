const actions = {
    // setCondomina (payload){
    //     this.condominias = payload
    // }
    setSamePassword(payload){
        this.formData.password = payload
        this.formData.password_confirmation = payload
    },
    setStep(payload){
        this.step = payload
    },
    setErros(payload){
        this.formData.errors = payload
    }
};

export default { ...actions };
