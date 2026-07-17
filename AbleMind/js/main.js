// ===============================
// LOAD COURSES
// ===============================
function loadCourses(){

    let courseList = document.getElementById("course-list");

    // Run only if courses page exists
    if(!courseList){
        return;
    }


    fetch("backend/courses.php")

    .then(response => response.json())

    .then(data => {


        let output = "";


        data.forEach(course => {


            output += `

            <div class="course-card">

                <h3>${course.title}</h3>

                <p>${course.description}</p>

                <span>${course.level}</span>

                <br><br>

                <button type="button" 
                onclick="startLearning('${course.title}')">

                Start Learning

                </button>

            </div>

            `;


        });


        courseList.innerHTML = output;


    })

    .catch(error => {

        console.log("Course Error:",error);

    });

}




// ===============================
// START LEARNING BUTTON
// ===============================

function startLearning(course){


    localStorage.setItem(
        "selectedCourse",
        course
    );


    window.location.href="ai-tutor.html";


}





// ===============================
// AI TUTOR MESSAGE
// ===============================

function sendMessage(){

    let input = document.getElementById("user-message");
    let chat = document.getElementById("chat-area");


    if(!input || !chat){
        return;
    }


    let message = input.value.trim();


    if(message === ""){
        return;
    }



    chat.innerHTML += `
        <p class="user-message">
        <b>You:</b> ${message}
        </p>
    `;



fetch("./backend/ai-chat.php",{
        method:"POST",

        headers:{
            "Content-Type":"application/x-www-form-urlencoded"
        },

        body:"message=" + encodeURIComponent(message)

    })

    .then(response => response.text())

    .then(data=>{

    console.log("AI RESPONSE:", data);

        chat.innerHTML += `

        <p class="bot-message">

        <b>AbleMind AI:</b><br>

        ${data}

        </p>

        `;


        input.value="";


        chat.scrollTop = chat.scrollHeight;


    })

    .catch(error=>{

        console.log(error);

        chat.innerHTML += `

        <p>
        Error connecting AI
        </p>

        `;

    });

}
// ===============================
// AUTO START COURSE IN AI TUTOR
// ============================


function autoStartCourse(){

    let input = document.getElementById("user-message");

    if(!input){
        return;
    }


    let params = new URLSearchParams(window.location.search);

    let course = params.get("course");


    if(course){

        let message = "Teach me " + course + " from beginner level.";

        input.value = message;


        setTimeout(function(){

            sendMessage();

        },1500);

    }

}


window.addEventListener("load", autoStartCourse);

window.addEventListener("load", function(){

    let input = document.getElementById("user-message");


    if(!input){
        return;
    }


    let params = new URLSearchParams(window.location.search);

    let course = params.get("course");


    if(course){


        input.value = 
        "Teach me " + course + " from beginner level.";


        setTimeout(function(){

            sendMessage();

        },2000);


    }

});