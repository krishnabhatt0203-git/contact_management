function validateForm() {

    let name = document.getElementById("name").value.trim();
    let phone = document.getElementById("phone").value.trim();
    let email = document.getElementById("email").value.trim();

    if (name === "") {

        alert("Please enter your name.");
        return false;

    }

    if (phone === "") {

        alert("Please enter your phone number.");
        return false;

    }

    if (!/^[0-9+\-\s]{7,15}$/.test(phone)) {

        alert("Please enter a valid phone number.");
        return false;

    }

    if (email !== "") {

        let emailPattern =
            /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!emailPattern.test(email)) {

            alert("Please enter a valid email address.");
            return false;

        }

    }

    return true;
}


function confirmDelete() {

    return confirm(
        "Are you sure you want to delete this contact?"
    );

}