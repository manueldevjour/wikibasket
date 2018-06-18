$(document).ready(function() {
    $.ajax(
        {
           type: "GET",
           url: "https://stats.nba.com/stats/commonplayerinfo/?PlayerID=" + player_received,
           success: function(data) {
               //Obtengo la fecha de nacimiento del jugador
               $(".birthday").append('<strong>Birthday: </strong>' + data.resultSets[0].rowSet[0][6]);
               $(".school").append('<strong>Last school/team: </strong>' + data.resultSets[0].rowSet[0][7]);
               $(".place-birth").append('<strong>Place of birth: </strong>' + data.resultSets[0].rowSet[0][8]);
               $(".last-affiliation").append('<strong>Last affiliation: </strong>' + data.resultSets[0].rowSet[0][9]);
               $(".height").append('<strong>Height: </strong>' + data.resultSets[0].rowSet[0][10]);
               $(".weight").append('<strong>Weight: </strong>' + data.resultSets[0].rowSet[0][11] + ' lbs');
               $(".position").append('<strong>Position: </strong>' + data.resultSets[0].rowSet[0][14]);
               $(".experience").append('<strong>Experience in the NBA: </strong>' + data.resultSets[0].rowSet[0][12] + ' year(s).');
               $(".jersey").append('<strong>Jersey: #</strong>' + data.resultSets[0].rowSet[0][13]);
               $(".average-points").append(data.resultSets[1].rowSet[0][3]);
               $(".average-rebounds").append(data.resultSets[1].rowSet[0][5]);
               $(".average-assists").append(data.resultSets[1].rowSet[0][4]);
           },
           dataType: "jsonp"
    
        });

    $.ajax(
        {
            type: "GET",
            url: "https://stats.nba.com/stats/playerprofilev2/?PlayerID=" + player_received + "&PerMode=Totals",
            success: function(data) {
            for(var i = 0; i < data.resultSets[0].rowSet.length; i++) {
                //Sacar los datos de temporada disputada por el jugador
                $(".cuerpoTablaDatosJugador").append('<tr><td>' + data.resultSets[0].rowSet[i][1] + '</td>' 
                                                            +  '<td>' + data.resultSets[0].rowSet[i][4] +'</td>'
                                                            +  '<td>' + data.resultSets[0].rowSet[i][6] +'</td>'
                                                            +  '<td>' + data.resultSets[0].rowSet[i][7] + '</td>'
                                                            +  '<td>' + data.resultSets[0].rowSet[i][8] +'</td>'
                                                            +  '<td>' + data.resultSets[0].rowSet[i][9] + ' - ' + data.resultSets[0].rowSet[i][10] + ' - ' + data.resultSets[0].rowSet[i][11] +'</td>' 
                                                            + '<td>' + data.resultSets[0].rowSet[i][12] + ' - ' + data.resultSets[0].rowSet[i][13] + ' - ' + data.resultSets[0].rowSet[i][14] + '</td>' 
                                                            + '<td>' + data.resultSets[0].rowSet[i][20] + '</td>' 
                                                            + '<td>' + data.resultSets[0].rowSet[i][21] + '</td>' 
                                                            + '<td>' + data.resultSets[0].rowSet[i][22] + '</td>' 
                                                            + '<td>' + data.resultSets[0].rowSet[i][23] + '</td>'
                                                            + '<td>' + data.resultSets[0].rowSet[i][26] + '</td>'
                                                + '</tr>');
            }

            for(var i = 0; i < data.resultSets[12].rowSet.length; i++) {
                //Sacar los mejores datos por stat en toda la temporada
                $(".cuerpoTablaSeasonHighs").append('<tr><td>' + data.resultSets[12].rowSet[i][2] + '</td>'
                                                            + '<td>' + data.resultSets[12].rowSet[i][4] + ' ' + data.resultSets[12].rowSet[i][5] +'</td>'
                                                            + '<td>' + data.resultSets[12].rowSet[i][7] + '</td>'
                                                            + '<td>' + data.resultSets[12].rowSet[i][8] + '</td>'
                                                    + '</tr>');
            }

            for(var i = 0; i < data.resultSets[13].rowSet.length; i++) {
                //Sacar los mejores datos por stat de toda su carrera
                $(".cuerpoTablaCareerHighs").append('<tr><td>' + data.resultSets[13].rowSet[i][2] + '</td>'
                                                            + '<td>' + data.resultSets[13].rowSet[i][4] + ' ' + data.resultSets[13].rowSet[i][5] +'</td>'
                                                            + '<td>' + data.resultSets[13].rowSet[i][7] + '</td>'
                                                            + '<td>' + data.resultSets[13].rowSet[i][8] + '</td>'
                                                    + '</tr>');
            }
            },
            dataType: "jsonp"
    
        });

})