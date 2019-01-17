function newCountDown(vreme) {
    var hours = Math.floor(vreme / 3600);
    var minutes = Math.floor((vreme - hours * 3600) / 60);
    var seconds = Math.floor(vreme - (hours * 3600 + minutes * 60));

    var sStr, hStr, mStr;
    var fStr = "";

    if (seconds === 1) {
        sStr = seconds + " секунда";
    } else if (seconds > 1) {
        sStr = seconds + " секунди";
    } else {
        sStr = null;
    }
    if (minutes === 1) {
        mStr = minutes + " минута";
    } else if (minutes > 1) {
        mStr = minutes + " минути";
    } else {
        mStr = null;
    }

    if (hours === 1) {
        hStr = hours + " час";
    } else if (hours > 1) {
        hStr = hours + " часа";
    } else {
        hStr = null;
    }

    if (hStr !== null) {
        if (sStr !== null && mStr !== null) {
            fStr = hStr + ", ";
        } else {
            fStr = hStr + " и ";
        }
    }

    if (mStr !== null) {
        if (sStr !== null) {
            fStr = fStr + mStr + " и ";
        } else {
            fStr = fStr + mStr;
        }
    }

    if (sStr !== null) {
        fStr = fStr + sStr;
    }
    $("#countdown").html(fStr + "");
}