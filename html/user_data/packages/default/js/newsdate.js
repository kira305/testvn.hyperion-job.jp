myDate = new Date(); //現在の日付取得
myYear = myDate.getFullYear();
myRyear = myDate.getFullYear() - 1 + "-"; //最新の年から１を引く
myStartDate = myYear + "/1/1";
myEndDate = myYear + "/1/15";
mySD = new Date(myStartDate);
myED = new Date(myEndDate);
if (myDate.getTime() - mySD.getTime() > 0 && myED.getTime() - myDate.getTime() > 0) {
    document.write(myRyear);
}
document.write(myYear);