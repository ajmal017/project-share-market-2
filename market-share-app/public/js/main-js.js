// Global scripts go here

/* Listen to page dimensions to determine menu/content display */
function monitorPageDimensions(){
    window.addEventListener("resize", setDisplayMode);
}

function setDisplayMode(){
    var orientation = getOrientation();
    var content = document.getElementById("sysoContentMaster");
    var menu = document.getElementById("sysoMenuMaster");
    /* Page is in portrait mode */
    if (orientation && menu.style.display == "block"){
        content.style.display = "none";
    }
    /* Page is in landscape mode */
    else{
        content.style.display = "block";
    }
}

/* Menu hide/show */
function menuClick() {
    var menu = document.getElementById("sysoMenuMaster");
    var content = document.getElementById("sysoContentMaster");
    if (menu.style.display == "none") {
        menu.style.display = "block";
        if(getOrientation()){
            content.style.display = "none";
        }
    }
    else {
        menu.style.display = "none";
        content.style.display = "block";
    }
}

/* Determine page orientation and return: true = portrait; false = landscape */
function getOrientation() {
    var x = window.innerWidth;
    var y = window.innerHeight;
    var portrait = true;
    if(x > y){
        portrait = false;
    }
    return portrait;
}

// Function to quickly write document.GetElementById
function GEBI(id) {
    return document.getElementById(id);
}

// Uses regex to check a password field element with id 'password'
function pwStrengthCheck() {
    var pw = GEBI('password').value;
    var pattern = /^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(.{8,})$/; 
    var error = "Password must contain at least:<ul><li>8 characters</li>" + 
    "<li>1 upper case letter</li><li>1 lower case latter</li><li>1 number" +
    "</li></ul>";

    // Error message written to element named 'pw-strength'
    if (!pattern.test(pw)) {
        GEBI('pw-strength').innerHTML = error;
    }

    else {
        GEBI('pw-strength').innerHTML = "";
    }
}

function goBack() {
    window.history.back();
}
