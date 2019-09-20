function checkIfInside() {
    let x, y, r;
    let textY = document.getElementById("Y").value;
    let radioRadius = document.getElementsByName("radius");
    let checkboxX = document.getElementsByName("coordinateX");
    // get X
    for (let i = 0; i < checkboxX.length; i++) {
        if (checkboxX[i].type == "checkbox" && checkboxX[i].checked) {
            x = checkboxX[i].value;
            break;
        } 
        if (i == checkboxX.length - 1) {
            alert("Choose X coordinate!");
            return false;
        }
    }
    // get Y
    if (isNaN(textY)) {
        alert("Y must be number!");
        return false;
    } 
    if (isEmpty(textY)) {
        alert("Choose Y coordinate!");
        return false;
    }
    y = parseFloat(textY);
    if (y <= -3 || y >= 3) {
        alert("Y must be in (-3, 3)");
        return false;
    }
    // get R
    for (let i = 0; i < radioRadius.length; i++) {
        if (radioRadius[i].type == "radio" && radioRadius[i].checked) {
            r = radioRadius[i].value;
            break;
        } 
        if (i == radioRadius.length - 1) {
            alert("Choose radius!");
            return false;
        }
    }

    // check rectangle area
    if (x <= 0 && x >= -r && y <= r/2 && y >= 0) {
        alert("Dot inside!");
        return true;
    }
    // check triangle area
    if (x >= 0 && x <= r/2 && y <= r/2 && y >= 0 && x <= -y + 2) {
        alert("Dot inside!");
        return true;
    }
    // check circle area
    if (x >= 0 && x <= r/2 && y >= -r/2 && y <= 0 && x*x + y*y <= r*r/4) {
        alert("Dot inside!");
        return true;
    }
    alert("Dot outside!")
    return false;
}

function isEmpty(str) {
    return str.trim() == '';
}