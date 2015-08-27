<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>
        <link rel="stylesheet" type="text/css" href="files/dist/semantic.min.css">
        <style>
            body{
                background: #007B75;
                color: white;
            }
            #header{
                margin-top: 25px;
                background: #00B5AD;
                border-radius: 3px;
                padding-top: 30px;
            }
        </style>
        <script type="text/javascript" src="/files/jquery-2.1.4.min.js"></script>
        <script type="text/javascript" src="/files/dist/semantic.min.js"></script>
        <script>
            $(document).ready(function(){
                $( 'button#submitscore' ).click(function(){
                    var url_        = "http://localhost" + $('#scoreform').attr('action');
                    var formData    = new FormData(  $('#scoreform')[0] );

                    $.ajaxSetup({
                        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                        data : formData,
                        processData: false,
                        contentType: false,
                    });
                    $.post( url_ , formData , function(data){
                        
                        $('#insertData').empty();
                        console.log(data);

                        var l = data.length;
                        for( var i = 0; i < l ; i++ ){
                            var obj = data[i];
                            var rank = "<td>"+obj.rank+"</td>";
                            var score = "<td>"+obj.score+"</td>";
                            var name = "<td>"+obj.name+"</td>";
                            $('#insertData').append("<tr>"+rank+name+score+"</tr>");
                        }

                    });
                });
            });
        </script>
    </head>
    <body>
    <div class="ui grid container">
        <div id="header" class="sixteen wide centered column"> 
            <img class="ui center aligned icon header"id="scoreboard" src="files/img/scoreboard.png" />
            <h1 class="ui center aligned icon header" style="color: white;">Score Board Project by Andrew Yee</h1>
        </div>
        <div class="ten wide centered column"> 
            <div style="text-align:center;" class="two fields">
                <div class="field">
                    Score & Name
                </div>
                <div class="field">
                    <form method="POST" action="/" accept-charset="UTF-8" id="scoreform" enctype="multipart/form-data">
                        <input name="_token" value="<?php echo csrf_token(); ?>" type="hidden">    
                        <input style="color:black;" name="score" type="text"></input>
                        <input style="color:black;" name="name" type="text"></input>
                    </form>
                </div>
            </div>
        </div>
        <div class="ten wide centered column"> 
            <div style="text-align:center; color: black; " class="field">
                  <button id="submitscore" class="ui inverted teal button">Submit A New Score</button>
            </div>
        </div>  
        <div class="ten wide centered column"> 
            <table class="ui inverted teal table">
                <thead>
                    <tr>
                        <th>Rank</th>
                        <th>Name</th>
                        <th>Score</th>
                    </tr>
                </thead>
                <tbody id="insertData">
                    <?php if( isset($data) ){           ?>
                    <?php foreach( $data as $val ):     ?>
                        <tr>
                        <td><?php echo($val->rank);   ?></td>
                        <td><?php echo($val->name);   ?></td>
                        <td><?php echo($val->score);  ?></td>
                        </tr>
                    <?php endforeach;                   ?>
                    <?php }                             ?>
                </tbody>
            </table>
        </div>
    </div>
    </body>   
</html>
