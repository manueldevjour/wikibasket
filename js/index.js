$(document).ready(function () {
    $('.container').fadeIn(2500);

    $(document).on("click", "#tablaequipo tr td .boton-eliminar", function() {
        let fatherId = $(this).parent().closest("tr").attr("id");
        
        $( function() {
            $( "#dialog-confirm" ).dialog({
                show: {
                    effect: "fade",
                    duration: 1000
                },
                    hide: {
                    effect: "explode",
                    duration: 1000
                },                
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Eliminar equipo": function() {
                    $.post({ 
                        url: "borrarequipo.php",
                        data: {
                            id_franquicia: fatherId,
                        },
                        success: function() {
                            $("#"+fatherId).fadeOut("slow", function() {
                                $(this).remove();
                            });
                        }
                    });
                    $( this ).dialog( "close" );
                },
                "Cancelar": function() {
                $( this ).dialog( "close" );
                }
            }
            });
        });
    });

    /* Primera prueba de mapa con Leaflet
    var mymap = L.map('mapid').setView([40.2025313, -97.7588906], 5);

    L.tileLayer('https://api.mapbox.com/styles/v1/manueldevjour/cjg7mztrx6ajm2rqmchyut6af/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFudWVsZGV2am91ciIsImEiOiJjamc3bWY4NjQwcm9rMndsaWdic3BqNm0yIn0.XgRR7jwUU-hA1ERt6cNqnw', {
    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox.streets',
    accessToken: 'pk.eyJ1IjoibWFudWVsZGV2am91ciIsImEiOiJjamc3bWY4NjQwcm9rMndsaWdic3BqNm0yIn0.XgRR7jwUU-hA1ERt6cNqnw'
    }).addTo(mymap);

    var marker = L.marker([51.5, -0.09]).addTo(mymap);
    marker.bindPopup("<b>Hello world!</b><br>I am a popup.");
    var markerNBAHQ = L.marker([40.7591987, -73.9784423]).addTo(mymap);
    markerNBAHQ.bindPopup("<b>NBA HQ in NYC</b>");
    
    var popup = L.popup();

    function onMapClick(e) {
        popup
            .setLatLng(e.latlng)
            .setContent("You clicked the map at " + e.latlng.toString())
            .openOn(mymap);
    }

    mymap.on('click', onMapClick);*/

    /*Segundo mapa con la informaciónd de los Estados

    var mapboxAccessToken = 'pk.eyJ1IjoibWFudWVsZGV2am91ciIsImEiOiJjamc3bWY4NjQwcm9rMndsaWdic3BqNm0yIn0.XgRR7jwUU-hA1ERt6cNqnw';
    var map = L.map('map').setView([37.8, -96], 4);

    L.tileLayer('https://api.mapbox.com/styles/v1/manueldevjour/cjg7mztrx6ajm2rqmchyut6af/tiles/256/{z}/{x}/{y}?access_token=' + mapboxAccessToken, {
        id: 'mapbox.light',
        attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
        maxZoom: 10,
        id: 'mapbox.streets'
    }).addTo(map);

    var geojsonLayer = new L.GeoJSON.AJAX("us-states.js", {style: mystyle});
    geojsonLayer.addTo(map); */


    /*

        Ejemplo de Github en https://gist.github.com/sigdeletras/3888de4540dfc1d47682f1cb78765e18

    

   var map = L.map('map').setView([37.344,-4.548], 8); // Andalucía

var osmLayer = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap<\/a> contributors',
    maxZoom: 10
}).addTo(map);

function popUpInfo(feature, layer) {
    // does this feature have a property named popupContent?
    if (feature.properties && feature.properties.nomb_mus) {
        layer.bindPopup("<b>"+feature.properties.nomb_mus+"</b><br>"+feature.properties.municipio+" ("+feature.properties.provincia+")");
        //layer.bindPopup("<b>"+feature.properties.nomb_mus);
    }
}
L.geoJson(statesData, {
    onEachFeature: popUpInfo
    }).addTo(map);*/


    /* Mapa final con los dos ejemplos anteriores */

    // Declaro dos variables. La primera con el token usado de Mapbox, y la siguiente para mostrar la vista del mapa. En Estados Unidos y con un zoom elegido para que se pudiese visualizar bien.
    var mapboxAccessToken = 'pk.eyJ1IjoibWFudWVsZGV2am91ciIsImEiOiJjamc3bWY4NjQwcm9rMndsaWdic3BqNm0yIn0.XgRR7jwUU-hA1ERt6cNqnw';
    var map = L.map('map').setView([37.8, -96], 4);

    var osmLayer = L.tileLayer('https://api.mapbox.com/styles/v1/manueldevjour/cjg7v7ag85u802ro5yk6l00aj/tiles/256/{z}/{x}/{y}?access_token=' + mapboxAccessToken, {
        attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
        maxZoom: 10,
        minZoom: 4
    }).addTo(map);

    //Declaracion de los colores que tendrán los Estados dependiendo del número de equipos que tenga cada uno.
    function getColor(d) {
        return d > 3  ? '#FC4E2A' :
               d > 2   ? '#FD8D3C' :
               d > 1   ? '#FEB24C' :
               d > 0   ? '#FFEDA0' :
                          '#FFF';
    }

    function style(feature) {
        return {
            fillColor: getColor(feature.properties.numberOfTeams),
            weight: 2,
            opacity: 1,
            color: 'white',
            dashArray: '3',
            fillOpacity: 0.7
        };
    }
    
    //Creamos la función para resaltar, además de añadir la información necesaria al panel de info.
    function highlightFeature(e) {
        var layer = e.target;
    
        layer.setStyle({
            weight: 2,
            color: '#262626',
            dashArray: '',
            fillOpacity: 0.5
        });
    
        if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
            layer.bringToFront();
        }
        
        info.update(layer.feature.properties);
    }

    //Función para resetear los estilos que se le han dado al pasar el ratón por encima.
    function resetHighlight(e) {
        geojson.resetStyle(e.target);
        info.update();
    }

    var geojson;

    function zoomToFeature(e) {
        map.fitBounds(e.target.getBounds());
    }

    function onEachFeature(feature, layer) {
        layer.on({
            mouseover: highlightFeature,
            mouseout: resetHighlight,
            click: zoomToFeature
        });
    }

    geojson = L.geoJson(teamsData, {style: style, onEachFeature: onEachFeature}).addTo(map);

    var info = L.control();

    info.onAdd = function (map) {
        this._div = L.DomUtil.create('div', 'info'); // create a div with a class "info"
        this.update();
        return this._div;
    };

    // method that we will use to update the control based on feature properties passed
    info.update = function (props) {
        this._div.innerHTML = '<h4>Equipos por Estado</h4>' +  (props ?
            '<b>' + props.name + '</b><br>' + props.numberOfTeams + ' equipos' + '<br>' + props.teams
            : 'Pon el cursor sobre un Estado');
    };

    info.addTo(map);

    var legend = L.control({position: 'bottomright'});

    legend.onAdd = function (map) {

    var div = L.DomUtil.create('div', 'info legend'),
        grades = [0, 1, 2, 3, 4];

    // loop through our density intervals and generate a label with a colored square for each interval
    for (var i = 0; i < grades.length; i++) {
        div.innerHTML +=
            '<i style="background:' + getColor(grades[i]) + '"></i> ' +
            grades[i] + (grades[i + 1] ? '<br>' : '');
    }

    return div;
};

legend.addTo(map);

});
