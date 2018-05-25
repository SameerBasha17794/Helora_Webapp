var ct_date = new Date(), 
	ctTimeMs = new Date().getTime(),
	ctMouseEventTimerFlag = true, //Reading interval flag
	ctMouseData = [],
	ctMouseDataCounter = 0;

function ctSetCookieSec(c_name, value) {
	document.cookie = c_name + "=" + encodeURIComponent(value) + "; path=/";
}

function apbct_attach_event_handler(elem, event, callback){
	if(typeof window.addEventListener == "function") elem.addEventListener(event, callback);
	else                                             elem.attachEvent(event, callback);
}

function apbct_remove_event_handler(elem, event, callback){
	if(typeof window.removeEventListener == "function") elem.removeEventListener(event, callback);
	else                                                elem.detachEvent(event, callback);
}

ctSetCookieSec("ct_ps_timestamp", Math.floor(new Date().getTime()/1000));
ctSetCookieSec("ct_fkp_timestamp", "0");
ctSetCookieSec("ct_pointer_data", "0");
ctSetCookieSec("ct_timezone", "0");

setTimeout(function(){
	ctSetCookieSec("ct_timezone", ct_date.getTimezoneOffset()/60*(-1));
},1000);

//Writing first key press timestamp
var ctFunctionFirstKey = function output(event){
	var KeyTimestamp = Math.floor(new Date().getTime()/1000);
	ctSetCookieSec("ct_fkp_timestamp", KeyTimestamp);
	ctKeyStopStopListening();
}

//Reading interval
var ctMouseReadInterval = setInterval(function(){
	ctMouseEventTimerFlag = true;
}, 150);
	
//Writting interval
var ctMouseWriteDataInterval = setInterval(function(){
	ctSetCookieSec("ct_pointer_data", JSON.stringify(ctMouseData));
}, 1200);

//Logging mouse position each 150 ms
var ctFunctionMouseMove = function output(event){
	if(ctMouseEventTimerFlag == true){
		
		ctMouseData.push([
			Math.round(event.pageY),
			Math.round(event.pageX),
			Math.round(new Date().getTime() - ctTimeMs)
		]);
		
		ctMouseDataCounter++;
		ctMouseEventTimerFlag = false;
		if(ctMouseDataCounter >= 100){
			ctMouseStopData();
		}
	}
}

//Stop mouse observing function
function ctMouseStopData(){
	apbct_remove_event_handler(window, "mousemove", ctFunctionMouseMove);
	clearInterval(ctMouseReadInterval);
	clearInterval(ctMouseWriteDataInterval);				
}

//Stop key listening function
function ctKeyStopStopListening(){
	apbct_remove_event_handler(window, "mousedown", ctFunctionFirstKey);
	apbct_remove_event_handler(window, "keydown", ctFunctionFirstKey);
}

apbct_attach_event_handler(window, "mousemove", ctFunctionMouseMove);
apbct_attach_event_handler(window, "mousedown", ctFunctionFirstKey);
apbct_attach_event_handler(window, "keydown", ctFunctionFirstKey);

// Ready function
function apbct_ready(){
	ctSetCookieSec("apbct_visible_fields", 0);
	ctSetCookieSec("apbct_visible_fields_count", 0);
	for(var i=0; i < document.forms.length; i++){
		var form = document.forms[i];
		form.onsubmit = function(){
			var apbct_vf = {apbct_visible_fields: ""};
			for(var j=0, elem_count=form.elements.length; j < form.elements.length; j++){
				var elem = form.elements[j];
				if( getComputedStyle(elem).display    == "none" ||
					getComputedStyle(elem).visibility == "hidden" ||
					getComputedStyle(elem).width      == "0" ||
					getComputedStyle(elem).heigth     == "0" ||
					getComputedStyle(elem).opacity    == "0" ||
					elem.getAttribute("type")         == "hidden" ||
					elem.getAttribute("type")         == "submit"
				){
					elem_count--;
				}else{
					apbct_vf.apbct_visible_fields += elem.getAttribute("name") + (j+1 == form.elements.length ? "" : " ");
				}
			}
			ctSetCookieSec("apbct_visible_fields", JSON.stringify(apbct_vf));
			ctSetCookieSec("apbct_visible_fields_count", elem_count);
		}
	}
}
apbct_attach_event_handler(window, "DOMContentLoaded", apbct_ready);