var panelState=false;
var score=0;
var model='';
var r='';
function addPoint(){
    var XHR = new XMLHttpRequest();
    var fd  = new FormData();
    var p =parseInt(getCookie('points'))+1;
    fd.append('username',getCookie('username'));
    fd.append('userid',getCookie('userid'));
    fd.append('progress',p);
    XHR.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            setCookie('points',p,365);
            try{document.querySelector('#score a-image a-text').setAttribute('value',p);}
            catch(err){};
            getUser();
            showLoader('Adding points', 1);
        }
    }

    XHR.open('POST', '../admin/api.php?f=addPoints');
    XHR.send(fd);
    
}
function changeScore(to){
    score+=parseInt(to);
    document.querySelector('#score a-image a-text').setAttribute('value',score);
}
function resetCam(){
    var cam = document.querySelector('#default_angle');
    cam.setAttribute('animation','property: position; easing: easeInCubic; dur: 1000; to: 0 1.6 0; from:'+cam.getAttribute('animation').to);

}
function getScene(topic){
var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
       // Typical action to be performed when the document is ready:
       // console.log(xhttp.responseText);
       r = JSON.parse(xhttp.responseText);
       createScene(r);
    }
};
xhttp.open("GET", "../admin/api.php?f=getTopic&id="+topic, true);
xhttp.send();

}

function createScene(r){
console.log(r);
var entities=`
    <a-assets>
        <a-asset-item id="main3d" src="../assets/3d/`+r.modecontent['3dfile']+`"></a-asset-item>
    </a-assets>
    <a-camera overlay id="default_angle" camera position="0 1.6 0" look-controls wasd-controls>

        <a-entity id="mouseCursor" cursor="fuse: true; fuseTimeout: 1000"
            raycaster="objects: .clickable"
            position="0 0 -1"
            geometry="primitive: ring; radiusInner: 0.02; radiusOuter: 0.03"
            material="color: white; shader: flat; opacity: 0.8"
            animation__fusing="property: scale; startEvents: fusing; easing: easeInCubic; dur: 1000; from: 1 1 1; to: 0.5 0.5 0.5"
            animation__mouseleave="property: scale; startEvents: mouseleave; easing: easeInCubic; dur: 200; to: 1 1 1"
            animation__click="property: scale; startEvents: click; easing: easeInCubic; dur: 200; to: 1 1 1"
            >
        </a-entity>
    </a-camera>


    <a-entity id="hotspots" rotation="0">
`;

    // var pos = document.querySelector('#hotspot-'+i2).getAttribute('position');

        for(var i2=0;i2<r.modecontent.hotspots.length;i2++){
            var coords = r.modecontent.hotspots[i2].coordinates.split(',');
            var note = r.modecontent.hotspots[i2].description;
            var pos=r.modecontent.hotspots[i2].coordinates;
            
            entities+=`
            <a-sphere class="clickable" id="hotspot-`+i2+`" material="transparent: true; opacity: 0; alphaTest:0.5" position = "`+coords[0]+` `+coords[1]+` `+coords[2]+`" radius = "0.1" color="#ff0000" onclick="hotclick('`+note+`','`+pos+`','`+i2+`')"></a-sphere>`;
        }



entities+=`
    </a-entity>
    <a-entity id="controls" overlay>
        <a-plane width="0.6" height="2" color="#629632" position="-2 1.6 -3" rotation="0 45 0">
            <a-image class="clickable" id="help" src="images/help.png" position="0 0.5 0.1" scale="0.4 0.4 0.4"></a-image>
            <a-image class="clickable" id="exit" src="images/exit.png" position="0 -0.5 0.1" scale="0.4 0.4 0.4"></a-image>
        </a-plane>
        <a-entity id="instructions" position="0 1.6 0" visible="false">
            <a-image src="images/modalbg.png" position="0 0 -1" width="1.5" height="0.8">
                <a-text value="`+r.content+`" wrap-count="60" color="#ffffff" transparent="false" scale="0.25 0.25"
                align="center"></a-text>
            </a-image>
            <a-image src="images/blank.png" class="clickable" id="close_instructions" width="0.1" height="0.1" position="0.62 -0.28 -0.99"></a-image>
        </a-entity>
        <a-entity id="panel" visible="false" position="0 1.2 -1" rotation="-30 0 0">
            <a-image src="images/panel.png" width="1.5" height="0.2">
                <a-text id="description" value="" transparent="false" align="left" position="-0.18 -0.01 0.01" width="0.75" height="0.13" ></a-text>
                <a-text value="You found something!" transparent="false" align="left" position="-0.6 0.01 0.01 " width="0.70" height="0.13" ></a-text>
                <a-text value="(read and close to earn points)" transparent="false" align="left" position="-0.6 -0.05 0.01 " width="0.45" height="0.13" ></a-text>
            </a-image>
            <a-image src="images/blank.png" class="clickable" id="close_panel" width="0.1" height="0.1" position="0.58 0.05 -0.01"></a-image>
        </a-entity>
        <a-entity id="score" position="0.75 2.1 0" visible="true">
            <a-image src="images/points.png" position="0 0 -1" width="0.3" height="0.1">
                <a-text value="0" color="#ffffff" transparent="false" scale="0.25 0.25"></a-text>
            </a-image>
        </a-entity>
    </a-entity>

    <a-sky color="#999999" src="" ></a-sky>
    <a-gltf-model disabled src="#main3d" `+r.modecontent.instructions+`
    </a-gltf-model>

`;
var htmlObject = stringToHTML(entities); 
document.querySelector('#mainScene').innerHTML='';
document.querySelector('#mainScene').appendChild(htmlObject);
//document.querySelector('#mainScene').insertAdjacentHTML('beforeEnd',entities);
if(getCookie('points')=='NaN') setCookie('points',0,365);
score=parseInt(getCookie('points'));
document.querySelector('#score a-image a-text').setAttribute('value',score);


document.querySelector('#help').addEventListener('click',function(e){
    document.querySelector('#instructions').setAttribute('visible','true');
})
document.querySelector('#exit').addEventListener('click',function(e){
    changeScreen('#dashboard');
//    location.reload();
})
document.querySelector('#close_panel').addEventListener('click',function(e){
    document.querySelector('#panel').setAttribute('visible','false');
    //changeScore(10);
    panelState = false;
    addPoint();
    resetCam();
})
document.querySelector('#close_instructions').addEventListener('click',function(e){
    document.querySelector('#instructions').setAttribute('visible','false');
})

// showLoader('Loading VR Scene', 5000);
showLoader(r.content, 5000);


}


// document.querySelector('#mainScene').reload();




function hotclick(note,pos,id){

        if(!panelState){
            document.querySelector('#panel').setAttribute('visible','true');
            document.querySelector('#description').setAttribute('value',note);
            panelState = true;
            var cam = document.querySelector('#default_angle');
            pos = pos.split(',');
            console.log(pos);
            cam.setAttribute('animation','property: position; easing: easeInCubic; dur: 1000; from: 0 1.6 0; to: '+pos[0]+' '+pos[1]+' '+pos[2]);
            var msg = new SpeechSynthesisUtterance();
            msg.text = note;
            // msg.lang = 'en-US';
            msg.rate = 1.2;
            msg.onend = function(){resetCam()};
            document.getElementById('hotspots').removeChild(document.getElementById('hotspot-'+id));

            window.speechSynthesis.speak(msg);
        }
}





