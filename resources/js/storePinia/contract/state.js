const state = () => {
  return {
    formData:{
        firstName:"Nome",
        lastName:"SobreNome",
        role_id:2,
        email:"teste@teste.com.br",
        password:"",
        password_confirmation:"",
        remember:false,
        notifications: 1,
        person: "22233311133",
        telephone: "21 98888-8888",
        genre: 2,
        birthday:"08/07/1998",
        phone:"",
        initial_date:"",
        final_date:"",
        ceo : 0,
        errors:[]
    },

    step:"stepContract"

  };
};

export default state;
