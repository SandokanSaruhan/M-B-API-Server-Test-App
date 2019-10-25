function getProgress() {
	return document.getElementById("progressbar").getAttribute("aria-valuenow");
	return document.getElementById("progressbar").getAttribute("style","width");
	return document.getElementById("progressbar").innerHTML;
	}

function setProgress(value) {
	document.getElementById("progressbar").setAttribute("aria-valuenow",value);
	document.getElementById("progressbar").setAttribute("style","width: " +value+ "%");	
	document.getElementById("progressbar").innerHTML = (value+ "%"); 
}

function increment() {
	var i = getProgress();
	if(i < 100){
		i++;
		setProgress(i);	
	}else{
		alert("Progress Complete!");
	}
}

function decrement() {
	var d = getProgress();

	setProgress(d - 1);
}

function resetButton() {
	var r = getProgress();
	setProgress(r = 0);
}