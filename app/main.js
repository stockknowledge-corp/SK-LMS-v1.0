var activeScreen = '';
var name='Guest';
var currentUrl = window.location.href;
currentUrl=currentUrl.split('/');
if(currentUrl[currentUrl.length-1]=='index.html') currentUrl[currentUrl.length-1] ='';
if(currentUrl[currentUrl.length-1].search('#')>=0) currentUrl[currentUrl.length-1] ='';
currentUrl=currentUrl.join('/');
currentUrl=currentUrl.split('?tab=');
currentUrl=currentUrl[0];
currentUrl=currentUrl.split('?mode=');
currentUrl=currentUrl[0];
var path = getParameterByName('tab');
var modepath = getParameterByName('mode');
var topicpath = getParameterByName('topic');
window.history.pushState({},'Index',currentUrl);



document.addEventListener("DOMContentLoaded", function() {
	window.scrollTo(0,1);
	showLoader('Starting Up',1000);
	// showLoader('Updating app...<br>Please check back later.',1000000000000);

	changeScreen('#start');
	// document.getElementById("game-bg").volume = 0.2;
	// document.getElementById("game-bg").play();




	if(location.hash=='#dashboard' && activeScreen!='dashboard'){
		changeScreen('#dashboard');
		dashTabs('#dash-home'); 
		showLoader('Loading dashboard', 2000);
		getUser();
	}
	if(getCookie('userid')!=''){
		showLoader('Automatically logged in', 2000);
		// getUser();
		changeScreen('#dashboard');
		if(path!=null){
			// alert(path);
			// path = path.split('[');
			path = path.split(']');
			path = path[0].replace('[','');
			path = path.split('/');
			path = path[path.length-1];
			// alert(path);
			dashTabs('#dash-'+path);
		} else {
			if(modepath!=null && topicpath!=null){
				changeScreen('#mode'+modepath); 
				getScene(topicpath);
			} else {
				dashTabs('#dash-home'); 
			}
		}
		getUser();

	}
});
function changeScreen(w){
	var divs = document.querySelectorAll('body>div'), i;
	for (i = 0; i < divs.length; ++i) {
	  divs[i].style.display = "none";
	}
	document.querySelector(w).style.display='block';
	// document.getElementById("game-bg").play();
	window.history.pushState({},'Index',currentUrl);
	activeScreen=w;
	if(w=='#dashboard' && getCookie('fn')!=''){
		getUser();
	}
	if(w.search('mode')>=0){
		var tab = w.replace('#','');
		tab=tab.split('mode')
		tab=tab[1];
		tabTitle=tab.charAt(0).toUpperCase();
		window.history.pushState({},tabTitle,currentUrl+'?mode='+tab);
	}
	window.scrollTo(0,1);
}
function startReset(){
	var divs = document.querySelectorAll('#content>div'), i;
	for (i = 0; i < divs.length; ++i) {
	  divs[i].style.bottom = "-300vh";
	}
}
function startProcess(w){
	startReset();
	if(w!='#content-start' && window.innerWidth<=1024){
		document.querySelector('#hero img').style.opacity=0;
		// document.querySelector('#hero').style.background='url(images/bg001.png)';
	} else {
		document.querySelector('#hero img').style.opacity=1;
		// document.querySelector('#hero').style.background='none';
	}
	setTimeout(() => {document.querySelector(w).style.bottom='0';}, 300);
	
}


function dashTabs(w){
		document.querySelector('#dash-menu').classList.remove("visible");
		document.querySelector('.mobile-menu-container').classList.remove("change");
		var tab = w.replace('#dash-','');
		tabTitle=tab.charAt(0).toUpperCase();
		window.history.pushState({},tabTitle,currentUrl+'?tab='+tab);

	if(document.querySelector(w).style.display!='block'){
		var divs = document.querySelectorAll('#dash-content>div'), i;
		for (i = 0; i < divs.length; ++i) {
			divs[i].style.display = "none";
			// // console.log(divs[i].getAttribute('id'));
			// animateCSS('#'+divs[i].getAttribute('id'), 'bounceOutLeft').then((message) => {
			//   document.querySelector('#'+message).style.display = "none";
			//   // console.log(message);
			// });
		}
		document.querySelector(w).style.display='block';
		animateCSS(w, 'bounceInLeft');
		window.scrollTo(0,0);
		activeTab=w;
		if(w=='#dash-home'){
			showLoader('Getting Latest Topics',2000);
			getUser();
			getTopics();
		}
		if(w=='#dash-leaderboards'){
			showLoader('Getting Top Students',2000);
			getLeaderboard();
		}

	}
}
 


function showLoader(msg,t){
	document.getElementById('loading-msg').innerHTML=msg;
	setTimeout(() => {document.querySelector('#loader').style.display='block'},10);
	setTimeout(() => {document.querySelector('#loader').style.opacity='1'}, 100);
	setTimeout(() => {document.querySelector('#loader').style.opacity='0'}, t);
	setTimeout(() => {document.querySelector('#loader').style.display='none'},t+500);
	window.scrollTo(0,1);
	// document.getElementById('loading-msg').innerHTML='Loading...';
}


function login(){
	var un=document.getElementById('login-username').value;
	var pw=document.getElementById('login-password').value;
	var XHR = new XMLHttpRequest();
	var fd  = new FormData();
	fd.append('username',un);
	fd.append('password',pw);

	XHR.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	       // console.log(XHR.responseText);
	       var r=JSON.parse(XHR.responseText);
	       // console.log(r.result);
	       showLoader(r.result, 1);
	       document.getElementById("loginerror").innerHTML = r.result;
	       if(r.result=='Success') {
	       	setCookie('username',r.content.username,365);
	       	setCookie('userid',r.content.id,365);
	       	changeScreen('#dashboard');dashTabs('#dash-home');
	       }
	       }
	    }
	XHR.open('POST', '../admin/api.php?f=login');
	XHR.send(fd);
}

function logout(){
	setCookie('username','',-365);
	setCookie('userid','',-365);
	location.href="index.html";
}


function register(){
	var registerusername=document.getElementById('registerusername').value;
	var registerfn=document.getElementById('registerfn').value;
	var registerln=document.getElementById('registerln').value;
	var email=document.getElementById('email').value;
	var mobile=document.getElementById('mobile').value;
	var registerpassword=document.getElementById('registerpassword').value;
	var registerpassword2=document.getElementById('registerpassword2').value;
	var registerschool=document.getElementById('registerschool').value;
	var gradelevel=document.getElementById('gradelevel').value;
	var pwstrength=document.getElementById('pw-strength').value;
	var XHR = new XMLHttpRequest();
	var fd  = new FormData();
	fd.append('username',registerusername);
	fd.append('firstname',registerfn);
	fd.append('lastname',registerln);
	fd.append('email',email);
	fd.append('mobile',mobile);
	fd.append('password',registerpassword);
	fd.append('password2',registerpassword2);
	fd.append('student-schoolname',registerschool);
	fd.append('student-gradelevel',gradelevel);
	fd.append('pw-strength',pwstrength);
	fd.append('usertype',"3");

	XHR.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	       // console.log(XHR.responseText);
	       var r=JSON.parse(XHR.responseText);
	       // console.log(r.result);
	       showLoader(r.result, 1);
	       document.getElementById("registererror").innerHTML = r.content;
	       if(r.result=='Registration successful') {
	       	setCookie('username',r.content.username,365);
	       	setCookie('userid',r.content.id,365);
	       	changeScreen('#dashboard');dashTabs('#dash-home');
	       	getUser();
	       }
	       }
	    }
	XHR.open('POST', '../admin/api.php?f=register');
	XHR.send(fd);
}


function getUser(){
	var XHR = new XMLHttpRequest();
	var fd  = new FormData();
	fd.append('username',getCookie('username'));
	fd.append('userid',getCookie('userid'));

	XHR.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	       // console.log(XHR.responseText);
	       var r=JSON.parse(XHR.responseText);
	       // console.log(r.result);
	       showLoader('Getting user details', 1);
	       if(r.result=='Fail') logout();
	       if(r.result=='success') {
	        setCookie('fn',r.content.firstname,365);
	        setCookie('ln',r.content.lastname,365);
	        setCookie('gradelevel',r.content.gradelevel,365);
	        setCookie('schoolname',r.content.schoolname,365);
	        setCookie('points',r.content.points,365);
			document.getElementById('mini-name-name').innerHTML=getCookie('fn');
			document.getElementById('mini-name-stars').innerHTML='<i class="fa fa-star" aria-hidden="true"></i> '+getCookie('points');		
	       	// changeScreen('#dashboard');dashTabs('#dash-home');
	       	if(getCookie('points')=='NaN') setCookie('points',0,365);
	       }
	       }
	    }
	XHR.open('POST', '../admin/api.php?f=getStudent&id='+getCookie('userid'));
	XHR.send(fd);
}





function getLeaderboard(){
	var XHR = new XMLHttpRequest();
	var fd  = new FormData();

	XHR.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	       // console.log(XHR.responseText);
	       var r=JSON.parse(XHR.responseText);
	       // console.log(r.result);
	       if(r.result=='success') {
	       	console.log(r.content);
	       	var html='';
	       	html='<button onclick="showLoader(\'Refreshing Top Students\',2000);			getLeaderboard();">Refresh</button><br>';
	       	for(var i=0; i<r.content.length; i++){
	       		html+='Rank: '+(i+1)+'<br>Name: '+r.content[i].firstname+' '+r.content[i].lastname+'<br>Points: '+r.content[i].points+'<br><br>';
	       	}
	       	document.getElementById('Leaderboard-content').innerHTML=html;
	       }
	       }
	    }
	XHR.open('POST', '../admin/api.php?f=leaderboard');
	XHR.send(fd);
}

function getTopics(){
	var XHR = new XMLHttpRequest();
	var fd  = new FormData();

	XHR.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	       // console.log(XHR.responseText);
	       var r=JSON.parse(XHR.responseText);
	       // console.log(r.result);
	       if(r.result=='success') {
	       	console.log(r.content);
	       	var html='';
	       	html='';
	       	for(var i=0; i<r.content.length; i++){
	       		// html+=r.content[i].id+'<br>';
	       		// html+=r.content[i].topic+'<br>';
	       		// html+=r.content[i].description+'<br>';
	       		// html+=r.content[i].background+'<br><br>';
	       		modeText = 'Mode 1 - Interactive Lecture';
	       		if(r.content[i].mode==2) modeText = 'Mode 2 - Activities and Experiments';
	       		html+=`
				<div class="topic" id="`+r.content[i].id+`" onclick="changeScreen('#mode`+r.content[i].mode+`'); getScene(`+r.content[i].id+`)"
				style="background-image: url('../assets/background/`+r.content[i].background+`')">
					<div class="topic-card">
						<h2 class="topic-title">`+r.content[i].topic+`</h2>
						<div class="topic-subject">`+r.content[i].subject+`</div>
						<div class="topic-subtitle">`+r.content[i].description+`</div>
						<div class="topic-subtitle">`+modeText+`</div>
						<!-- <div class="topic-progress"><i class="fa fa-star" aria-hidden="true"></i> 1/3</div>-->
					</div>
					<div class="clear"></div>
				</div>`;
	       	}
	       	document.getElementById('latestTopics-content').innerHTML=html;
	       }
	       }
	    }
	XHR.open('POST', '../admin/api.php?f=getTopics');
	XHR.send(fd);
}

function getScene(topic){
var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
  //  		var tab = w.replace('#dash-','');
		// tabTitle=tab.charAt(0).toUpperCase();
		// window.history.pushState({},tabTitle,currentUrl+tab);
		r = JSON.parse(xhttp.responseText);
		createScene(r);
		var currentUrl2 = window.location.href;
		currentUrl2=currentUrl2.split('?');
		currentUrl2[1]=currentUrl2[1].split('&');
		currentUrl2[1]=currentUrl2[1][0];
		currentUrl2=currentUrl2[0]+'?'+currentUrl2[1];
		window.history.pushState({},tabTitle,currentUrl2+'&topic='+topic);
    }
};
xhttp.open("GET", "../admin/api.php?f=getTopic&id="+topic, true);
xhttp.send();

}

window.onpopstate = () => {
	// location.href=location.pathname
}




