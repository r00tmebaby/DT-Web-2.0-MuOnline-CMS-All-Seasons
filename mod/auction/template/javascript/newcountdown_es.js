function newCountDown(vreme) {
    var hours = Math.floor(vreme / 3600);
    var minutes = Math.floor((vreme - hours * 3600) / 60);
    var seconds = Math.floor(vreme - (hours * 3600 + minutes * 60));

    var sStr, hStr, mStr;
    var fStr = "";

    if (seconds === 1) {
        sStr = seconds + " segundo";
    } else if (seconds > 1) {
        sStr = seconds + " segundos";
    } else {
        sStr = null;
    }
    if (minutes === 1) {
        mStr = minutes + " minuto";
    } else if (minutes > 1) {
        mStr = minutes + " minutos";
    } else {
        mStr = null;
    }

    if (hours === 1) {
        hStr = hours + " hora";
    } else if (hours > 1) {
        hStr = hours + " horas";
    } else {
        hStr = null;
    }

    if (hStr !== null) {
        if (sStr !== null && mStr !== null) {
            fStr = hStr + ", ";
        } else {
            fStr = hStr + " y ";
        }
    }

    if (mStr !== null) {
        if (sStr !== null) {
            fStr = fStr + mStr + " y ";
        } else {
            fStr = fStr + mStr;
        }
    }

    if (sStr !== null) {
        fStr = fStr + sStr;
    }
    $("#countdown").html(fStr + "");
}