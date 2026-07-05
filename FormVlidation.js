document
  .getElementById("contactForm")
  .addEventListener("submit", function (event) {
    event.preventDefault();

    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const phone = document.getElementById("phone").value.trim();
    const message = document.getElementById("message").value.trim();

    const nameError = document.getElementById("NameError");
    const emailError = document.getElementById("emailerror");
    const phoneError = document.getElementById("phoneerror");
    const textError = document.getElementById("texterror");

    nameError.textContent = "";
    emailError.textContent = "";
    phoneError.textContent = "";
    textError.textContent = "";

    if (name === "") {
      nameError.textContent = "Please enter your full name.";
    } else if (name.length < 3) {
      nameError.textContent = "Name must be at least 3 characters.";
    } else if (email === "") {
      emailError.textContent = "Please enter your email address.";
    } else if (!email.includes("@") || !email.includes(".")) {
      emailError.textContent =
        "Please enter a valid email (e.g. user@example.com).";
    } else if (phone === "") {
      phoneError.textContent = "Please enter your phone number.";
    } else if (isNaN(phone)) {
      phoneError.textContent = "Phone number must contain digits only.";
    } else if (phone.length < 10 || phone.length > 14) {
      phoneError.textContent = "Phone number must be between 10 and 14 digits.";
    } else if (message === "") {
      textError.textContent = "Please enter your message.";
    } else if (message.length < 10) {
      textError.textContent = "Message must be at least 10 characters.";
    } else {
      alert(" Form Submitted Successfully!");
      document.getElementById("contactForm").reset();
    }
  });
