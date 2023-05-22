let endingPointMap;
async function initEndingPointMap() {
    // The location of Uluru
    const position = { lat: 29.547698, lng: 34.953550 };
    // Request needed libraries.
    //@ts-ignore
    const { Map } = await google.maps.importLibrary("maps");
    const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

    // The map, centered at Eilat
    endingPointMap = new Map(document.getElementById("map-ending-point"), {
        zoom: 15,
        center: position,
        mapId: "DEMO_MAP_ID",
    });

    // The marker, positioned
    const marker = new AdvancedMarkerElement({
        map: endingPointMap,
        position: position,
        title: "Eilat",
    });
}

initEndingPointMap();

let startingPointMap;
async function initStartingPointMap() {
    // The location of Uluru
    const position = { lat: 29.547698, lng: 34.953550 };
    // Request needed libraries.
    //@ts-ignore
    const { Map } = await google.maps.importLibrary("maps");
    const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

    // The map, centered at Eilat
    startingPointMap = new Map(document.getElementById("map-starting-point"), {
        zoom: 15,
        center: position,
        mapId: "DEMO_MAP_ID",
    });

    // The marker, positioned
    const marker = new AdvancedMarkerElement({
        map: startingPointMap,
        position: position,
        title: "Eilat",
    });
}

initStartingPointMap();