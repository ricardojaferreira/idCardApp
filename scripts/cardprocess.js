'use strict';

/*Saved Cards*/
let savedCards = document.querySelector('#savedcards');
if(savedCards){
    savedCards.addEventListener('change',cardSelected);
}

/*Card Area*/
let textFields = document.querySelectorAll('.card_area ul >li, .card_area p');
let img = document.querySelector('img');
let cardarea= document.querySelector('.card_area');
let id_name = document.querySelector(".id_name");
let id_job = document.querySelector(".id_job");
let id_company = document.querySelector(".id_company");
let id_email = document.querySelector(".id_email");
let id_description = document.querySelector(".id_description");

/*Drop Area*/
let errorMessage = document.querySelector('form fieldset:nth-child(2) legend');
let dropPhoto = document.querySelector('#drop_photo');
let dropBackground = document.querySelector('#drop_background');
let uploadPhoto = document.querySelector('#profilePhoto');
let backgroundPhoto = document.querySelector('#backgroundImage');
let photoPath = '';
let backgroundPath = '';


/*Inputs Area*/
let formFields = document.querySelector('form');
formFields.reset();
let inputText = document.querySelectorAll('.textinput');
let backgroundSize = document.querySelector('#id_backgroundsize');
let textColor = document.querySelector('#id_textcolor');
let generateJSONbutton = document.querySelector("button[type=button]");
generateJSONbutton.addEventListener('click',generateJSON);

for(let i=0; i<inputText.length; i++){
    inputText[i].addEventListener('input', updatefield);
}

backgroundSize.addEventListener('change', function(){
    cardarea.style.backgroundSize=this.value;
});

textColor.addEventListener('change', function (){
    for(let i=0; i<textFields.length; i++){
        textFields[i].style.color=this.value;
    }
});

/*Output area*/
let cardObj = {
    cardname: 'cardname',
    name: 'name',
    job: 'job',
    company: 'company',
    email: 'email',
    description: 'description',
    photoPath: 'photoPath',
    backgroundPath: 'backgroundPath',
    backgroundSize: 'backgrounSize',
    textColor: 'textColor'
};

let outputJSON = document.querySelector('.JSONoutput');

/* AJAX CALL */
function cardSelected(event){
    let card = event.target;
    if(card.value == 'nocard'){
        id_name.innerHTML = 'Your Name here';
        id_job.innerHTML = 'Your Job Position';
        id_company.innerHTML = 'Your Company Name here';
        id_email.innerHTML = 'Your Email here';
        id_description.innerHTML = 'You can add a description here.';
        img.src= 'images/default_avatar.jpeg';
        cardarea.style.backgroundImage = "none";
        cardarea.style.backgroundSize = "auto";
        for(let i=0; i<textFields.length; i++){
            textFields[i].style.color="black";
        }
    }else{
        let request = new XMLHttpRequest();
        request.addEventListener("load", updateCard);
        request.open("get", "action_updatecard.php?cardname=" + card.value,true);
        request.send();
    }
}

function updateCard(){
    let cardDetails = JSON.parse(this.responseText);
    id_name.innerHTML = cardDetails[0].name;
    id_job.innerHTML = cardDetails[0].job;
    id_company.innerHTML = cardDetails[0].company;
    id_email.innerHTML = cardDetails[0].email;
    id_description.innerHTML = cardDetails[0].description;
    img.src= cardDetails[0].photoPath;
    cardarea.style.backgroundImage = "url('"+cardDetails[0].backgroundPath+"')";
    cardarea.style.backgroundSize = cardDetails[0].backgroundSize;
    for(let i=0; i<textFields.length; i++){
        textFields[i].style.color=cardDetails[0].textColor;
    }
}

/*GENERATE JSON*/
function generateJSON(){
    let cardIdValue = document.querySelectorAll('input[type=text],input[type=email],form select');
    for(let i=0; i<cardIdValue.length;i++){
        cardObj[cardIdValue[i].name]=cardIdValue[i].value;
    }
    cardObj.backgroundPath=backgroundPath;
    cardObj.photoPath=photoPath;
    outputJSON.innerHTML="<PRE>" + JSON.stringify(cardObj,null,'\t') + "</PRE>";
}

function updatefield(event){
    let inputCardText = document.querySelector("."+this.id);
    inputCardText.innerHTML = this.value;
}

function drop_handler(ev, droparea) {
    let mimeTypes = /\.(png|jpe?g)$/i;
    let reader = new FileReader();
    ev.preventDefault();
    let dt = ev.dataTransfer;

    if(dt.files.length<2){
        for (let i=0; i < dt.files.length; i++) {
            if(mimeTypes.test(dt.files[i].name)) {
                reader.readAsDataURL(dt.files[i]);
                if (droparea == 1){
                    reader.addEventListener("load", function () {
                        img.src = reader.result;
                        photoPath = dt.files[i].name;
                        errorMessage.innerHTML = 'Drop Images:';
                        errorMessage.style.color = '#000000';
                        uploadPhoto.value=reader.result;
                    }, false);
                }
                if(droparea == 2){
                    reader.addEventListener("load", function () {
                        cardarea.style.backgroundImage = "url('"+reader.result+"')";
                        cardarea.style.backgroundSize = backgroundSize.value;
                        backgroundPath = dt.files[i].name;
                        errorMessage.innerHTML = 'Drop Images:';
                        errorMessage.style.color = '#000000';
                        backgroundPhoto.value=reader.result;
                    }, false);
                }


            }else{
                let errorMessage = document.querySelector('form fieldset:nth-child(2) legend');
                errorMessage.innerHTML = 'Drop Images: Only Images (jpg, png)';
                errorMessage.style.color = '#dc143c';
            }
        }
    }else{
        errorMessage.innerHTML = 'Drop Images: Only one file allowed';
        errorMessage.style.color = '#dc143c';
    }
}

function dragover_handler(ev) {
    ev.preventDefault();
    ev.dataTransfer.effectAllowed='copy';
    ev.dataTransfer.dropEffect='copy';
}

function dragend_handler(ev) {
    ev.dataTransfer.clearData();
}

window.addEventListener("drop", function(e) {
    if (e.target === dropPhoto) {
        drop_handler(e, 1);
        e.target.style.background = "";
    }else if(e.target === dropBackground){
        drop_handler(e, 2);
        e.target.style.background = "";
    }else{
        e.preventDefault();
    }
}, false);

window.addEventListener("dragover", function(e) {
    if (e.target != dropPhoto && e.target != dropBackground) {
        e.preventDefault();
    }else{
        dragover_handler(e);
    }
}, false);

window.addEventListener("dragend", function(e) {
    if (e.target != dropPhoto && e.target != dropBackground) {
        e.preventDefault();
    }else{
        dragend_handler(e);
    }
}, false);

window.addEventListener("dragenter", function(e) {
    if (e.target != dropPhoto && e.target != dropBackground) {
        e.preventDefault();
    }else{
        e.target.style.backgroundImage = "url('images/drag_and_drop.gif')";
    }
}, false);

window.addEventListener("dragleave", function(e) {
    if (e.target != dropPhoto && e.target != dropBackground) {
        e.preventDefault();
    }else{
        e.target.style.background = "";
    }
}, false);