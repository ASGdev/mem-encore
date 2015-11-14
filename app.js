var xmlhttp = new XMLHttpRequest();
var ui;
var progress = 0;
var score = 0;
var data;
var passintro = true;

xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        data = JSON.parse(xmlhttp.responseText);
        start();
    }
}

/**/
function init(url){
	xmlhttp.open("GET", url, true);
	xmlhttp.send();
}

function start(){
	ui = document.getElementById('appcontent');
	console.log(data);
	if(passintro){
		ui.innerHTML = "";
		ui.insertAdjacentHTML('afterbegin', "<h2>"+data["infos"]["title"]+"</h2>");
		ui.insertAdjacentHTML('beforeend', "<p>Author : "+data["infos"]["author"]+"</p>");
		ui.insertAdjacentHTML('beforeend', "<p>Created : "+data["infos"]["created"]+"</p>");
		ui.insertAdjacentHTML('beforeend', "<p>Updated : "+data["infos"]["updated"]+"</p>");
		ui.insertAdjacentHTML('beforeend', '<a href="#" class="button" onclick="start()">Start !</a>');
		passintro = false;
	}
	else {
		build_ui(progress);
	}	
}

function build_ui(progress){
	console.log(progress);
	ui.innerHTML = '';
	ui.insertAdjacentHTML('afterbegin', "<h2>"+data["questions"][progress]["question"]+"</h2>");
	if(data["questions"][progress]["answerType"]=="input"){
		
	}
	if(data["questions"][progress]["answerType"]=="button"){
		var length =  data["questions"][progress]["answers"].length;
		for(var i=0;i<length;i++){
			ui.insertAdjacentHTML('beforeend', '<button onclick="validate_answer(this)">'+data["questions"][progress]["answers"][i]+'</button>');
		}
	}
}

function validate_answer(e){
	console.info(progress);
	console.info(data["questions"][progress]["answers"].length);
	var index = data["questions"][progress]["goodAnswer"] - 1;
	if(e.innerHTML == data["questions"][progress]["answers"][index])
	{
		score++;
		alert("Congrats!");
	}
	progress++;
	if(progress < data["questions"].length){
		build_ui(progress);
	}
	else {
		build_end();
	}


}

function build_end(){
	ui.innerHTML = '';
	ui.insertAdjacentHTML('afterbegin', "<h2>End</h2>");
}

function quit_test(){
	location.reload();
}