export default function useStopWatch() {
    const getDate = (tempLast) =>{
        var dia, hora, minutos, segundos,temp, status = true
        //

        var nowHours = new Date()
        var current_date = nowHours.getTime()

        // var tempLast = new Date(tempInitial.setMinutes(tempInitial.getMinutes() +2))
        var segundos_f = (tempLast - current_date) / 1000

        dia = parseInt(segundos_f /86400)
        segundos_f = segundos_f % 86400

        hora = parseInt(segundos_f /3600)
        segundos_f = segundos_f % 3600

        minutos = parseInt(segundos_f /60)
        segundos = parseInt(segundos_f %60)

        let hour = hora >= 10 ? hora : '0'+hora
        let minutes = minutos >= 10 ? minutos : '0'+minutos
        let seconds = segundos >= 10 ? segundos : '0'+segundos

        temp = dia+' dias - '+hour+'h:'+minutes+'m:'+seconds+'s'

        status = nowHours >= tempLast
        // if(nowHours >= tempLast){
        //    status = true
        // }

        return {dia, hour, minutes, seconds, status, tempLast}
    }
    const showTime = () => {
        let now = new Date()
        console.log('initial -> ', now)
        var tempLast = new Date(now.setMinutes(now.getMinutes() +1))
        let { dia, hour, minutes, seconds, status,} = getDate(tempLast)
        let timer = setInterval(() => {
            segundos++;
            segundos === 60 ? segundos=0 : segundos++
            minutos === 60 ? minutos=0 : minutos++
            hora === 60 ? hora=0 : hora++

            console.log('segundos-> ', segundos)

            if(segundos >= 5){
                clearInterval(timer)
                console.log('ESTOU AQUI VAI FALSE')
            }
            console.log('AINDA TU', status)

        }, 1000)
        // let timer = setInterval(getDate(), 1000)

        // if(getDate().status){
        //     clearInterval(timer)
        // }

    }
    const incrementSeconds = (value = 5) => {
        let sec = 0;
        let timer = setInterval(() => {
            sec++;
            console.log('Ola ', sec)
            if(sec > value){
                console.log('PAREI')
                clearInterval(timer)
            }
        },1000)
    }

    return{
        getDate,
        showTime
    }
}
