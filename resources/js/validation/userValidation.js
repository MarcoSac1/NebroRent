



/* password validation */
const nameConfirm = document.querySelector('input#name');
const surnameConfirm = document.querySelector('input#surname');
const passwordConfirm = document.querySelector('input#password');
const passwordConfirmTwo = document.querySelector('input#password-confirm');
const emailConfirm = document.querySelector('input#email');
const allertValidationPassword = document.querySelector('div.error_validation_password');
const allertValidationName = document.querySelector('div.error_validation_name');
const allertValidationSurname = document.querySelector('div.error_validation_surname');
const allertValidationEmail = document.querySelector('div.error_validation_email');



document.getElementById('register_form').addEventListener('submit', function(event) {
    event.preventDefault();

    // Reset error messages
    allertValidationName.innerHTML = "";
    allertValidationSurname.innerHTML = "";
    allertValidationPassword.innerHTML = "";
    allertValidationEmail.innerHTML = "";

    let email = emailConfirm.value;
    let hasError = false; // Variable to track errors

    // Name validation
    if (nameConfirm.value.length < 3) {
        const newErrorName = document.createElement("div");
        newErrorName.classList = "alert alert-danger";
        newErrorName.innerText = "The name must be at least 3 characters";
        allertValidationName.appendChild(newErrorName);
        hasError = true;
    }

    // Surname validation
    if (surnameConfirm.value.length < 3) {
        const newErrorSurname = document.createElement("div");
        newErrorSurname.classList = "alert alert-danger";
        newErrorSurname.innerText = "The surname must be at least 3 characters";
        allertValidationSurname.appendChild(newErrorSurname);
        hasError = true;
    }

    // Email validation
    if (!email.includes('@')) {
        const newErrorEmail = document.createElement("div");
        newErrorEmail.classList = "alert alert-danger";
        newErrorEmail.innerText = "The email is not correct";
        allertValidationEmail.appendChild(newErrorEmail);
        hasError = true;
    }

    // Password match validation
    if (passwordConfirm.value !== passwordConfirmTwo.value) {
        const newError = document.createElement('div');
        newError.classList = "alert alert-danger";
        newError.innerText = "The passwords do not match";
        allertValidationPassword.appendChild(newError);
        passwordConfirm.value = "";
        passwordConfirmTwo.value = "";
        hasError = true;
    }

    // Password length validation
    if (passwordConfirm.value.length < 8) {
        const newError = document.createElement('div');
        newError.classList = "alert alert-danger";
        newError.innerText = "The password must be at least 8 characters long";
        allertValidationPassword.appendChild(newError);
        passwordConfirm.value = "";
        passwordConfirmTwo.value = "";
        hasError = true;
    }

    // Submit the form if no errors are detected
    if (!hasError) {
        this.submit();
    }
});
