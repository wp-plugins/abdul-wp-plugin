var handleEvent = {
	start:function(eventType, args){
	// do something when startEvent fires.
	document.getElementById('abdulanswer').innerHTML = "<center><img src=/wp-content/plugins/abdul-wp-plugin/images/wait.gif></center>";
	},

	complete:function(eventType, args){
	// do something when completeEvent fires.
		document.abdul.q.select();
	},

	success:function(eventType, args){
	// do something when successEvent fires.
		if(args[0].responseText !== undefined){
			document.getElementById('abdulanswer').innerHTML = args[0].responseText;
			document.abdul.q.select();
		}
	},

	failure:function(eventType, args){
	// do something when failureEvent fires.
		alert('answering system error');
	},

	abort:function(eventType, args){
	// do something when abortEvent fires.
	}
};

var callback = {
	customevents:{
		onStart:handleEvent.start,
		onComplete:handleEvent.complete,
		onSuccess:handleEvent.success,
		onFailure:handleEvent.failure,
		onAbort:handleEvent.abort
	},
	scope:handleEvent,
 	argument:["foo","bar","baz"]
};


function makeRequest(){
	var q = encodeURIComponent(document.getElementById("q").value);
	if(q!=""){
		var sUrl = "/wp-content/plugins/abdul-wp-plugin/abdul.php";
		var data = "q="+q;
		var request = YAHOO.util.Connect.asyncRequest('POST', sUrl, callback,data);
	}
}

function myquery(e){
	var n = e.keyCode;
	if(n==13){//key of Enter Key
		makeRequest();
		document.abdul.q.select();
	}
	
}


