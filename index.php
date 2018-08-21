<html>
    <head>
        <title>jQuery</title>
        <title>jQuery</title>
        <!-- Method 1 -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
        <!-- Method 2 -->
        <!-- <script src="jquery-3.3.1.min.js"></script> -->
  
        
        <style type="text/css">
            #circle{
                height: 100px;
                width: 100px;
                background-color: green;
                border-radius: 50%;
                margin: 20px;
            }

            .square{
                height: 100px;
                width: 100px;
                background-color: red;
                margin: 20px;
            }
        </style>

    </head>
 
    <body>
        <div id="circle"></div>
        <!-- <div class="square"></div>
        <div class="square"></div> -->
        
        <!-- <p id="text">This is some text.</p>
        <p style="display:none" id="hiddenText">This is some hidden text.</p> -->

        <!-- <iframe src="http://www.codestars.com"></iframe> -->

        <script type="text/javascript">
            // if (typeof jQuery != undefined){
            //     alert("jQuery working");
            // } else {
            //     alert("jQuery not working")
            // }
           
           /*     
           $("#circle").click(function(){
               alert("Circle was clicked.");
               $("p").html("This text has changed.");
           });
           $(".square").click(function(){
               alert("Square was clicked.");
           });

           $("div").click(function(){
               alert("div was clicked.");
           });

           */

           /*
           $("#circle").click(function(){
               $("p").html("This text has changed.");
               alert($("p").html());
           });
            */

            //Style
            /*
            $("#circle").click(function(){
                $("#circle").css("width", "300px");
                $("#circle").css("background-color", "red");
                console.log($("body").css("width"));
            });

            $("div").click(function(){
                $(this).css("display", "none");
            });
            */

            //Fading out       
            /*
            var toggle = true;     
            $("div").click(function(){
                if (toggle){
                    $("#text").fadeOut("slow", function(){
                    $("#hiddenText").fadeIn("slow", function(){
                            toggle = false;
                        });
                    });
                } else {
                    $("#hiddenText").fadeOut("slow", function(){
                    $("#text").fadeIn("slow", function(){
                            toggle = true;
                        });
                    });
                }
                
            });
            */


            // Animating content
            
            $("#circle").click(function(){
                $(this).animate({
                    width:"400px",
                    height:"800px",
                }, 2000, function(){
                    $(this).css("background-color", "red");
                });
            });
            


            // Ajax

            
        </script>
    </body>
</html>