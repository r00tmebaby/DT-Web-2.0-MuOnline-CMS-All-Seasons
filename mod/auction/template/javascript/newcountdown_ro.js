function newCountDown(vreme) {
    var hours = Math.floor(vreme / 3600);
    var minutes = Math.floor((vreme - hours * 3600) / 60);
    var seconds = Math.floor(vreme - (hours * 3600 + minutes * 60));

    var sStr, hStr, mStr;
    var fStr = "";

    if (seconds === 1) {
        sStr = seconds + "al doilea";
    } else if (seconds > 1) {
        sStr = seconds + " secunde";
    } else {
        sStr = null;
    }
    if (minutes === 1) {
        mStr = minutes + " minut";
    } else if (minutes > 1) {
        mStr = minutes + " minute";
    } else {
        mStr = null;
    }

    if (hours === 1) {
        hStr = hours + " ora";
    } else if (hours > 1) {
        hStr = hours + " ore";
    } else {
        hStr = null;
    }

    if (hStr !== null) {
        if (sStr !== null && mStr !== null) {
            fStr = hStr + ", ";
        } else {
            fStr = hStr + " și ";
        }
    }

    if (mStr !== null) {
        if (sStr !== null) {
            fStr = fStr + mStr + " și ";
        } else {
            fStr = fStr + mStr;
        }
    }

    if (sStr !== null) {
        fStr = fStr + sStr;
    }
    $("#countdown").html(fStr + "");
}