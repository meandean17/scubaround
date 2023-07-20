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


const editDiveButton = document.querySelector('.dive-object-options .button');
const diveDetails = document.querySelector('.text-section p');
const diveTitle = document.getElementById('dive-object-title');
const diveStatus = document.querySelector('.item-status');
const diveStatusToggle = document.querySelector('.status-toggle');

editDiveButton.addEventListener('click', () => {
    if (editDiveButton.textContent === 'Edit') {
        editDiveButton.textContent = 'Save';
        diveDetails.contentEditable = true;
        diveDetails.style.backgroundColor = 'white';
        diveTitle.contentEditable = true;
        diveTitle.style.backgroundColor = 'white';
        diveDetails.focus();
        diveStatus.style.display = 'none';
        diveStatusToggle.style.display = 'inline-flex';
    } else if (editDiveButton.textContent === 'Save') {
        editDiveButton.textContent = 'Edit';
        diveDetails.contentEditable = false;
        diveDetails.style.backgroundColor = 'unset';
        diveTitle.contentEditable = false;
        diveTitle.style.backgroundColor = 'unset';
        diveStatus.style.display = 'unset';
        diveStatusToggle.style.display = 'none';
    }
});

