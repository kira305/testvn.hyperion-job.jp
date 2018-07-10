myDate = new Date(); //Œ»Ý‚Ì“ú•tŽæ“¾
myYear = myDate.getFullYear();
myRyear = myDate.getFullYear() - 1 + "-"; //ÅV‚Ì”N‚©‚ç‚P‚ðˆø‚­
myStartDate = myYear + "/1/1";
myEndDate = myYear + "/1/15";
mySD = new Date(myStartDate);
myED = new Date(myEndDate);
if (myDate.getTime() - mySD.getTime() > 0 && myED.getTime() - myDate.getTime() > 0) {
    document.write(myRyear);
}
document.write(myYear);