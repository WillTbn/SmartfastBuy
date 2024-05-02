import {defineRule} from 'vee-validate'
defineRule('required', value => {
    if (!value || !value.length) {
        return 'Esse campo deve ser preenchido!';
    }
    return true;
});
defineRule('email', value => {
    var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    // Check if email
    if (!re.test(value)) {
        return 'Este campo deve ser um e-mail válido';
    }
    return true;
});
defineRule('minPerson', value => {
    if (value.length < 11) {
        return 'Este campo no mínimo dever conter 11 números';
    }
    return true;
});
defineRule('minTelephone', value => {
    if (value.length < 12) {

        return 'Este campo no mínimo dever conter 12 números';
    }
    return true;
});
defineRule('minphone', value =>{
    if(value.length < 13){
        return 'Este campo no mínimo dever conter 13 números';
    }
    return true;
})
defineRule('confirmed', (value, [target]) => {
    if (value === target) {
      return true;
    }
    return 'As senhas não coincidem';
});
defineRule('signature', (value, [target]) => {
    if (!target) {
      return true;
    }
    if(!value){
        return 'Anexa um documento é obrigatório.';
    }
});
