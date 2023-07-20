let slideIndex = 1;
// showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
    showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let captionText = document.getElementById("caption");
    if (n > slides.length) { slideIndex = 1 }
    if (n < 1) { slideIndex = slides.length }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }

    slides[slideIndex - 1].style.display = "block";
}



function onToggleChange() {
    const toggleInput = document.querySelector('.checkbox');
    if (toggleInput) {
        localStorage.setItem('toggleState', toggleInput.checked);
    }
}

document.addEventListener("DOMContentLoaded", function (event) {
    const toggleInput = document.querySelector('.checkbox');
    toggleInput.checked = getToggleValue();
});

function getToggleValue() {
    return localStorage.getItem('toggleState') === "true";
}

function getQueryVariable(variable) {
    var query = window.location.search.substring(1);
    var vars = query.split("&");
    for (var i = 0; i < vars.length; i++) {
        var pair = vars[i].split("=");
        if (decodeURIComponent(pair[0]) == variable) {
            return decodeURIComponent(pair[1]);
        }
    }
    return null;
}


const editDiveButton = document.getElementById('editBtn');
const saveDiveButton = document.getElementById('saveBtn');
const cancelDiveButton = document.getElementById('cancelBtn');
const postDiveButton = document.getElementById('postBtn');
const shareDiveButton = document.getElementById('shareBtn');

saveDiveButton.style.display = 'none';
cancelDiveButton.style.display = 'none';

const diveDetails = document.querySelector('.text-section p');
const diveTitle = document.getElementById('dive-object-title');
const diveStatus = document.querySelector('.item-status');
const diveStatusToggle = document.querySelector('.status-toggle');
const editErrorMsg = document.querySelector('.error-msg-box');
editDiveButton.addEventListener('click', () => {
    // hide irrelevant buttons
    postDiveButton.style.display = 'none';
    shareDiveButton.style.display = 'none';
    editDiveButton.style.display = 'none';

    // show relevant buttons
    saveDiveButton.style.display = 'block';
    cancelDiveButton.style.display = 'block';

    // save old content - incase of cancelation
    const prevDetails = diveDetails.innerHTML;
    const prevTitle = diveTitle.innerHTML;
    const prevStatus = diveStatus.innerHTML;

    // make content editable
    diveDetails.contentEditable = true;
    diveDetails.style.backgroundColor = 'white';
    diveTitle.contentEditable = true;
    diveTitle.style.backgroundColor = 'white';
    diveDetails.focus();
    diveStatus.style.display = 'none';
    diveStatusToggle.style.display = 'inline-flex';

    // cancel
    cancelDiveButton.addEventListener('click', () => {
        //show relevant buttons
        postDiveButton.style.display = 'block';
        shareDiveButton.style.display = 'block';
        editDiveButton.style.display = 'block';

        // hide irrelevant buttons
        saveDiveButton.style.display = 'none';
        cancelDiveButton.style.display = 'none';

        // make content uneditable
        diveDetails.contentEditable = false;
        diveDetails.innerHTML = prevDetails;
        diveTitle.contentEditable = false;
        diveTitle.innerHTML = prevTitle
        diveStatus.style.display = 'block';
        diveStatus.innerHTML = prevStatus;
        diveStatusToggle.style.display = 'none';

    })

    // save
    saveDiveButton.addEventListener('click', () => {
        if (!diveTitle.innerHTML) {
            editErrorMsg.innerHTML = "Dive name cannot be empty";
            editErrorMsg.style.display = 'block';
        }
        else {
            // get the edited content
            const editedTitle = diveTitle.innerHTML;
            const editedDesc = diveDetails.innerHTML;

            // get the dive id from the query string
            const diveId = getQueryVariable("dive_id");
            console.log(diveId);
            // send the edited content to the server using ajax
            const xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    diveTitle.innerHTML = this.responseText.dive_name;
                    diveTitle.innerHTML = this.responseText.dive_desc;

                    //show relevant buttons
                    postDiveButton.style.display = 'block';
                    shareDiveButton.style.display = 'block';
                    editDiveButton.style.display = 'block';

                    // hide irrelevant buttons
                    saveDiveButton.style.display = 'none';
                    cancelDiveButton.style.display = 'none';

                    // make content uneditable
                    diveDetails.contentEditable = false;
                    diveTitle.contentEditable = false;
                    diveStatus.style.display = 'block';
                    diveStatusToggle.style.display = 'none';
                }
            };
            xhttp.open("POST", "./php2/edit_dive.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("dive_id=" + encodeURIComponent(diveId) + "&dive_name=" + encodeURIComponent(editedTitle) + "&dive_desc=" + encodeURIComponent(editedDesc));
        }


    })
});



