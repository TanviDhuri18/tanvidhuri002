// Special AbleMind Connect

console.log("Welcome to Special AbleMind Connect!");

const loginBtn = document.querySelector(".login-btn");

loginBtn.addEventListener("click", () => {
    alert("Login feature will be added in the next step.");
});

// AI Tutor Chat Function


function sendMessage(){


let message = document.getElementById("user-message").value;


let chatArea = document.getElementById("chat-area");



if(message==""){
    return;
}



let userMessage = document.createElement("p");

userMessage.className="user-message";

userMessage.innerHTML="<b>You:</b> " + message;


chatArea.appendChild(userMessage);



let botReply = document.createElement("p");

botReply.className="bot-message";


botReply.innerHTML=
"<b>AbleMind AI:</b> I understand your question. I will help you learn step by step.";



chatArea.appendChild(botReply);



document.getElementById("user-message").value="";


chatArea.scrollTop = chatArea.scrollHeight;


}

// Accessibility Functions


function increaseText(){

document.body.style.fontSize="20px";

}



function decreaseText(){

document.body.style.fontSize="16px";

}



function highContrast(){

document.body.classList.toggle("high-contrast");

}

// Login Function

function loginUser(){

let email=document.getElementById("login-email").value;

let password=document.getElementById("login-password").value;


if(email=="" || password==""){

alert("Please fill all fields");

return;

}


alert("Login Successful!");

window.location.href="student-dashboard.html";


}

// Signup Function


function signupUser(){


let name=document.getElementById("signup-name").value;

let email=document.getElementById("signup-email").value;

let password=document.getElementById("signup-password").value;

let role=document.getElementById("user-role").value;



if(name=="" || email=="" || password=="" || role=="Select User Type"){


alert("Please complete all details");

return;

}



alert("Account Created Successfully!");


window.location.href="login.html";


}

window.location.href="student-dashboard.html";
function askAI(){

let question=document.getElementById("question").value;


fetch("backend/ai-chat.php",{

method:"POST",

headers:{
"Content-Type":"application/x-www-form-urlencoded"
},


body:"message="+question


})


.then(response=>response.text())


.then(data=>{

document.getElementById("answer").innerHTML=data;

});


}
function loadCourses(){

fetch("backend/courses.php")

.then(response=>response.json())

.then(data=>{


let output="";


data.forEach(course=>{


output += `

<div class="course-card">

<h3>${course.title}</h3>

<p>${course.description}</p>

<span>${course.level}</span>

</div>

`;

});


document.getElementById("course-list").innerHTML=output;


});


}


window.onload=loadCourses;