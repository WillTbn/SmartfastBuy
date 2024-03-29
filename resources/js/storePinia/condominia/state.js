const state = () => {
  return {
    condominias:null,
    dataCreated:{
        name:"",
        road:"",
        state:"",
        number:"",
        state:0,
        zip_code:"",
        city:"",
        district:"",
        errors:{
            zip_code:""
        }
    }
  };
};

export default state;
