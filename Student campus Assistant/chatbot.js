function quickReply(text){
document.getElementById("userInput").value=text;
sendMessage();
}

function sendMessage(){

let input=document.getElementById("userInput").value.toLowerCase();

let response="";

if(input.includes("admission")){
response="Admission requires marksheets, ID proof and application form.";
}
else if(input.includes("course")){
response="Available courses: Computer Engineering, AI&DS, IT, Civil and Mechanical.";
}
else if(input.includes("library")){
response="Library timing is 9 AM to 5 PM. Students can borrow 3 books.";
}
else if(input.includes("placement")){
response="Average package is 6 LPA and highest package is 18 LPA.";
}
else if(input.includes("hostel")){
response="Separate hostel facilities are available.";
}
else if(input.includes("fees")){
response="Fees depend on the selected course.";
}
else if(input.includes("event")){
response="Upcoming event: Hackathon 2026.";
}
else if(input.includes("contact")){
response="Contact: +91 9876543210";
}
else{
response="Sorry, I didn't understand. Please ask about Admission, Courses, Library, Hostel, Fees, Placement or Events.";
}

let chatbox=document.getElementById("chatbox");

chatbox.innerHTML += `<p><b>You:</b> ${input}</p>`;
chatbox.innerHTML += `<p><b>Bot:</b> ${response}</p>`;

document.getElementById("userInput").value="";

chatbox.scrollTop=chatbox.scrollHeight;
}