var currentYear = new Date().getFullYear().toString();
var holidayList = [currentYear.concat('-08-15'),currentYear.concat('-12-25'),currentYear.concat('-12-08'),currentYear.concat('-12-07')]; //set holidays

function updateManDays(){

	var startDate = new Date(document.getElementById('startDate').value);
	var endDate = new Date(document.getElementById('endDate').value);
	// To calculate the time difference of two dates
    var Difference_In_Time = endDate.getTime() - startDate.getTime();

    // To calculate the no. of days between two dates
    var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
	var manDays =  document.getElementById('manDays');
	manDays.value=getWorkingDays(startDate,Difference_In_Days,holidayList);

}

function updateEndDate(){

	var startDate = new Date(document.getElementById('startDate').value);
	var endDate = document.getElementById('endDate');
	var manDays =  document.getElementById('manDays').value;

    // To calculate the no. of days between two dates
	endDate.value=setEndDate(startDate,manDays,holidayList);

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

var getWorkingDays = function(start,endCount,holidays){
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