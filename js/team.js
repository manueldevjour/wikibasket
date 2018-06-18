$(document).ready(function(){
    
    //Datos específicos sobre el equipo durante la temporada que hemos seleccionado
    $.ajax(
        {
            type:"GET",
            url: "https://stats.nba.com/stats/teaminfocommon/?TeamID=" + team_received + "&Season=" + season_received + "&SeasonType=Regular&LeagueID=00",
            success: function(data) {
                //Obtengo la temporada en la cuál estoy
                $(".season").append('<strong>Season: </strong>' + data.parameters.Season);

                //Obtengo de la ciudad que es el equipo
                $(".city").append(data.resultSets[0].rowSet[0][2]);

                //Obtengo la conferencia y la división en la que juega el equipo
                $(".conference").append('<strong>Conference: </strong>' + data.resultSets[0].rowSet[0][5]);
                $(".division").append('<strong>Division: </strong>' + data.resultSets[0].rowSet[0][6]);

                //Obtengo el número de victorias, derrotas y el porcentaje de victorias.
                $(".victories").append(data.resultSets[0].rowSet[0][8]);
                $(".defeats").append(data.resultSets[0].rowSet[0][9]);
                $(".percentage").append(data.resultSets[0].rowSet[0][10]);

                //Obtengo el ranking de conferencia y división
                $(".conference-ranking").append('<strong>Conference ranking: </strong>' + data.resultSets[0].rowSet[0][11] + 'º');
                $(".division-ranking").append('<strong>Division ranking: </strong>' + data.resultSets[0].rowSet[0][12] + 'º');

                //Obtengo el primer año en la NBA
                $(".first-year").append( data.resultSets[0].rowSet[0][13]);

                //Season ranking and average stats
                $(".points-ranking").append(data.resultSets[1].rowSet[0][3] + 'º');
                $(".points-average").append(data.resultSets[1].rowSet[0][4]);
                $(".rebounds-ranking").append(data.resultSets[1].rowSet[0][5] + 'º');
                $(".rebounds-average").append(data.resultSets[1].rowSet[0][6]);
                $(".assists-ranking").append(data.resultSets[1].rowSet[0][7] + 'º');
                $(".assists-average").append(data.resultSets[1].rowSet[0][8]);

            },
            dataType: "jsonp"
        }
    );
    
    //Cuerpo técnico y plantilla
    $.ajax(
        {
            type:"GET", 
            url: "https://stats.nba.com/stats/commonteamroster/?TeamID=" + team_received + "&Season=" + season_received, 
            success: function(data) {
                    
                //Consigo los datos del roster del equipo
                for(var i = 0; i < data.resultSets[0].rowSet.length; i++) {
                    $(".cuerpoTablaRoster").append('<tr><td>' + data.resultSets[0].rowSet[i][3] + '</td>'
                                                + '<td>#' + data.resultSets[0].rowSet[i][4] + '</td>'
                                                + '<td>' + data.resultSets[0].rowSet[i][5] + '</td>'
                                                + '<td>' + data.resultSets[0].rowSet[i][6] + '</td>'
                                                + '<td>' + data.resultSets[0].rowSet[i][7] + ' lbs' + '</td>'
                                                + '<td>' + data.resultSets[0].rowSet[i][8] + '</td>'
                                                + '<td>' + data.resultSets[0].rowSet[i][9] + '</td>'
                                                + '<td>' + data.resultSets[0].rowSet[i][10] + '</td>'
                                                + '<td>' + data.resultSets[0].rowSet[i][11] + '</td>'
                                                    + '</tr>')
                }
                
                //Entrenador principal
                $(".entrenador-principal").append('<strong>Head coach: </strong>' + data.resultSets[1].rowSet[0][5]);

                //Consigo los datos de los entrenadores
                for(var i = 0; i < data.resultSets[1].rowSet.length; i++) {
                    $(".cuerpoTablaTrainers").append('<tr><td>' + data.resultSets[1].rowSet[i][8] + '</td>' 
                                            + '<td>' + data.resultSets[1].rowSet[i][5] + '</td>'
                                            + '<td>' + data.resultSets[1].rowSet[i][9] + '</td></tr>' );
                }

                
                    
            },
            dataType: "jsonp"
        }
    );

    $.ajax(
        {
            type:"GET",
            url: "https://stats.nba.com/stats/teamgamelog/?teamID="+ team_received + "&Season=" + season_received + "&SeasonType=Regular%20Season",
            success: function(data) {
                for(var i = 0; i < data.resultSets[0].rowSet.length; i++) {
                    //Sacar los datos de cada partido disputado
                    $(".cuerpoTablaPartidos").append('<tr><td>' + data.resultSets[0].rowSet[i][2] +'</td>' 
                                                                +  '<td>' + data.resultSets[0].rowSet[i][3] +'</td>'
                                                                +  '<td>' + data.resultSets[0].rowSet[i][4] +'</td>'
                                                                +  '<td>' + data.resultSets[0].rowSet[i][5] + '-' + data.resultSets[0].rowSet[i][6] +'</td>'
                                                                +  '<td>' + data.resultSets[0].rowSet[i][7] +'</td>'
                                                                +  '<td>' + data.resultSets[0].rowSet[i][9] + ' - ' + data.resultSets[0].rowSet[i][10] + ' - ' + data.resultSets[0].rowSet[i][11] +'</td>' + '<td>' + data.resultSets[0].rowSet[i][20] + '</td>' + '<td>' + data.resultSets[0].rowSet[i][21] + '</td>' + '<td>' + data.resultSets[0].rowSet[i][22] + '</td>' + '<td>' + data.resultSets[0].rowSet[i][23] + '</td>' + '<td>' + data.resultSets[0].rowSet[i][26] + '</td>'
                                                    + '</tr>')
                }

            },
            dataType: "jsonp"
        }
    );

});

