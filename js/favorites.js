
import a from "../favorite-dives.json" assert { type: "json" };
console.log(a);
const favorites = a.favorites;

const full = "&#9733;";
const empty = "&#9734;";

const area = document.querySelectorAll(".favorite");
area.forEach(dive => {
    dive.innerHTML = empty;
    const userid = dive.getAttribute('userid');
    const diveid = dive.getAttribute('id');

    favorites.forEach(user => {
        if (user.user_id === userid) {
            user.favorite_dives.forEach(favdiveid => {
                if (favdiveid === diveid)
                    area.innerHTML = full;
            });
        }
    });
});


