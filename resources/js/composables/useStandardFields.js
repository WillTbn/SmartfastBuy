export default function useStandardFields() {

    const randomCaract = (value) => {
        let stringRandom = "";
        for (let i = 0; i < 2; i++) {
            const randomIndex = Math.floor(Math.random() * value.length);
            stringRandom += value[randomIndex];
        }
        return stringRandom;
    }
    const passwordGenerator = () => {

        const charset = [
            'abcdefghijklmnopqrstuvwxyz',
            '!@#$%¨&*()_+=-',
            'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
            '0123456789',
        ]
        let password = "";
        for (let i = 0; i < charset.length; i++) {
            password += randomCaract(charset[i]);
        }
        return password;
    }

    const getGenre = [
        {id:1, name:"Homem"},
        {id:2, name:"Mulher"},
        {id:3, name:"LGBTQQICAAPF2K+"},
        {id:4, name:"não informar"}
    ]
    const notYes = [
        {id:1, value:"accepted", name:"sim"},
        {id:2, value:"refused", name:"não"}
    ]
    return {
        passwordGenerator,
        getGenre,
        notYes,
    }
}
