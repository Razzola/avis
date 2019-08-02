function updateManDays(){

	var startDate = new Date(document.getElementById('startDate').value);
	var endDate = new Date(document.getElementById('endDate').value);
	// To calculate the time difference of two dates
    var Difference_In_Time = endDate.getTime() - startDate.getTime();

    // To calculate the no. of days between two dates
    var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
	var holidayList = ['2019-08-15','2019-12-25']; //example
	var manDays =  document.getElementById('manDays');
	manDays.value=getWorkingDays(startDate,Difference_In_Days,holidayList);

}

function updateEndDate(){

	var startDate = new Date(document.getElementById('startDate').value);
	var endDate = document.getElementById('endDate');
	var manDays =  document.getElementById('manDays').value;
	// To calculate the time difference of two dates

    // To calculate the no. of days between two dates
	var holidayList = ['2019-08-15','2019-12-25']; //example
	endDate.value=setEndDate(startDate,manDays,holidayList);

}

function setEndDate(start,manDays,holidayList){
    var weekEndDays = [];
    var current = start;

    var i = 0;
	while(i < manDays){
    			if (isWeekEnd(current)) {
    				weekEndDays.push(current);
    			}else{
    		        i++;
    		    }
    			currentObj = new Date(current);
    			current = currentObj.addDays(1).format();
    		}

}


// check if weekend
isWeekEnd = function(date){
    date.getDay();
    return (dayOfWeek == 6 || dayOfWeek == 0);
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

		function isWeekEnd(date){
			dateObj = new Date(date);
			if (dateObj.getDay() == 6 || dateObj.getDay() == 0) {
				return true;
			}else{
				if (holidays.contains(date)) {
					return true;
				}else{
					return false;
				}
			}
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