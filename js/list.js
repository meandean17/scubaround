
document.addEventListener('DOMContentLoaded', function() {
    console.log("DOMContentLoaded event fired!");
    getDiveHistory();
  });


function getDiveHistory() {
    console.log("getDiveHistory function called!");
    fetch('./php/list.php')
        .then(response => {
            console.log("Response received",response);
            return response.json();
        })
        .then(data => {
            console.log("Data received", data);
            const diveList = document.getElementById('diveList');
            data.forEach(dive => {
                const listItem = createDiveListItem(dive);
                diveList.appendChild(listItem);
            });
        })
        .catch(error => {
            console.log('Error:', error);
            console.error(error.message);
        });
}


function createDiveListItem(dive) {
    const listItem = document.createElement('li');
    listItem.innerHTML = `
        <a href="./main.html" class="dive-list-item">
            <div class="dive-name">${dive.dive_name}</div>
            <div class="dive-date">${dive.dive_date}</div>
            <div class="dive-status ${dive.is_public ? 'public' : 'private'}">${dive.is_public ? 'Public' : 'Private'}</div>
            <div class="dive-duration">${dive.dive_duration} minutes</div>
            <div class="dive-description">${dive.dive_description}</div>
        </a>
    `;
    return listItem;
}
