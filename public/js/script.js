function sendMail() {
    let parms = {
        subject: document.getElementById("subject").value,
        name: document.getElementById("name").value,
        email: document.getElementById("email").value,
        message: document.getElementById("message").value,
    };

    emailjs.send("service_y7re0xr", "template_7r3tc2n", parms).then(alert("The email was sent successfully."));
}