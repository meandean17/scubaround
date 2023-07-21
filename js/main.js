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
    const diveStatusLabel = document.getElementById('diveStatus');
    if (toggleInput && diveStatusLabel) {
        const statusText = toggleInput.checked ? 'Private' : 'Public';
        diveStatusLabel.innerHTML = statusText;
        diveStatusLabel.setAttribute('data-status', (toggleInput.checked ? 'Private' : 'Public'));
    }
}

document.addEventListener("DOMContentLoaded", function (event) {
    const toggleInput = document.querySelector('.checkbox');
    const diveStatusLabel = document.getElementById('diveStatus');
    if (toggleInput && diveStatusLabel) {
        const currentStatus = diveStatusLabel.getAttribute('data-status');
        toggleInput.checked = (currentStatus == 'Public' ? false : true);
        diveStatusLabel.innerHTML = currentStatus;
    }
});

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
const postDiveButton = document.getElementById('postBtn');
const shareDiveButton = document.getElementById('shareBtn');
const saveDiveButton = document.getElementById('saveBtn');
const cancelDiveButton = document.getElementById('cancelBtn');
const deleteDiveButton = document.getElementById('deleteBtn');

saveDiveButton.style.display = 'none';
cancelDiveButton.style.display = 'none';
deleteDiveButton.style.display = 'none';

const diveDetails = document.querySelector('.text-section p');
const diveTitle = document.getElementById('dive-object-title');
const diveStatusToggle = document.querySelector('.status-toggle');
const editErrorMsg = document.querySelector('.error-msg-box');
const diveStatus = document.querySelector('#diveStatus');


editDiveButton.addEventListener('click', () => {
    // hide irrelevant buttons
    postDiveButton.style.display = 'none';
    shareDiveButton.style.display = 'none';
    editDiveButton.style.display = 'none';

    // show relevant buttons
    saveDiveButton.style.display = 'block';
    cancelDiveButton.style.display = 'block';
    deleteDiveButton.style.display = 'block';


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
});

saveChanges = () => {
    if (!diveTitle.innerHTML) {
        editErrorMsg.innerHTML = "Dive name cannot be empty";
        editErrorMsg.style.display = 'block';
    }
    else {
        // get the edited content
        const editedTitle = diveTitle.innerHTML;
        const editedDesc = diveDetails.innerHTML;
        const editedStatus = diveStatus.innerHTML;
        const sanitizedDesc = sanitizeHtml(editedDesc);
        const sanitizedTitle = sanitizeHtml(editedTitle);
        // get the dive id from the query string
        const diveId = getQueryVariable("dive_id");
        console.log(diveId);
        // send the edited content to the server using ajax
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                window.location.href = window.location.href
            }
        };
        xhttp.open("POST", "./php/edit_dive.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("dive_id=" + (diveId) + "&dive_name=" + (sanitizedTitle) + "&dive_desc=" + (sanitizedDesc) + "&dive_status=" + (editedStatus));
    }
}

const modal = document.getElementById("myModal");
const closeModal = document.getElementsByClassName("close")[0];

closeModal.onclick = function () {
    modal.style.display = "none";
    return;
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

deleteDive = () => {
    // create modal to verify deletion
    modal.style.display = "block";
}

deleteDive2 = () => {
    // get the dive id from the query string
    const diveId = getQueryVariable("dive_id");

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // On successful deletion, redirect to the dive list page

            window.location.href = "./list.php";
        }
    };
    xhttp.open("POST", "./php/delete_dive.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("deleteDive=" + (diveId));
}

// Function to sanitize the HTML content to remove any potential harmful elements.
function sanitizeHtml(html) {
    // Use DOMParser to parse the HTML content and create a sanitized document fragment.
    var parser = new DOMParser();
    var doc = parser.parseFromString(html, "text/html");
    // Extract the sanitized content from the document fragment.
    return doc.body.textContent;
}

