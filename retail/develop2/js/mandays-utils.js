var currentYear = new Date().getFullYear().toString();
var holidayList = [currentYear.concat('-08-15'),currentYear.concat('-12-24'),currentYear.concat('-01-06'),currentYear.concat('-12-25'),currentYear.concat('-12-08'),currentYear.concat('-12-07')]; //set holidays
var sdctrl = document.getElementById('startDate');
var edctrl = document.getElementById('endDate');
var rfcCtrl = document.getElementById('rfc');
var mdctrl = document.getElementById('manDays');
var actctrl = document.getElementById('action');
var todelete = document.getElementById('toDelete');

// check if weekend
function isWeekEnd(date){
    dateObj = new Date(date);
    if (dateObj.getDay() == 6 || dateObj.getDay() == 0) {
        return true;
    }else{
        if (holidayList.contains(date)) {
            return true;
        }else{
            return false;
        }
    }
}

function setEndDate(start,manDays,holidayList){
    var current = start;

    var i = 0;
	while(i < manDays){
    			if (!isWeekEnd(current)) {
                    i++;
    			}
    			if (i!=manDays){
                    currentObj = new Date(current);
                    current = currentObj.addDays(1).format();
    			}
    		}
    return current;
}

function updateWorkSetup(){
	var rfc = rfcCtrl.value;
	var rfcArray= rfc.split('|');
	if (rfcArray.length>1){
        sdctrl.value=rfcArray[1];
        edctrl.value=rfcArray[2];
        mdctrl.value=rfcArray[3];
        actctrl.value='update';
        todelete.value=rfcArray[0];
	}else{
        sdctrl.value='';
        edctrl.value='';
        mdctrl.value='';
        actctrl.value='insert';
	}
}

function updateEndDate(){

	var startDate = new Date(sdctrl.value);
	var endDate = edctrl;
	var manDays =  mdctrl.value;

    // To calculate the no. of days between two dates
	endDate.value=setEndDate(startDate,manDays,holidayList);

}

function updateManDays(){

	var startDate = new Date(sdctrl.value);
	var endDate = new Date(edctrl.value);
	// To calculate the time difference of two dates
    var Difference_In_Time = endDate.getTime() - startDate.getTime();

    // To calculate the no. of days between two dates
    var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
	mdctrl.value=getWorkingDays(startDate,Difference_In_Days,holidayList);

}

function getWorkingDays(start,endCount,holidays){
    var weekdays = [];
    var current = start;

    var i = 0;
    while(i < endCount){
        if (!isWeekEnd(current)) {
            weekdays.push(current);
        }
        i++;
        currentObj = new Date(current);
        current = currentObj.addDays(1).format();
    }



    return weekdays.length+1;
}


function preFillWorkSetup(id){
    console.log(id);
    $('.selectpicker').selectpicker('val', id);
    updateWorkSetup();
    console.log(rfcCtrl.value);
}




	// check if value exist in array
	Array.prototype.contains = function(obj) {
		var i = this.length;
		while (i--) {
			if (this[i] == obj) {
				return true;
			}
		}
		return false;
	}

	// get next day
	Date.prototype.addDays = function(days) {
		var dat = new Date(this.valueOf())
		dat.setDate(dat.getDate() + days);
		return dat;
	}

	//format date
	Date.prototype.format = function() {
		var mm = this.getMonth() + 1;
		var dd = this.getDate();
		if (mm < 10) {
			mm = '0' + mm;
		}
		if (dd < 10) {
			dd = '0' + dd;
		}
		return this.getFullYear()+'-'+mm+'-'+dd;
	};


  ;