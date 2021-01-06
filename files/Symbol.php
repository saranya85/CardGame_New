<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        //printing symbols 
function Get_symbol($word)
  {
      switch($word)
           {
               case "Spade":
                   $symbol=html_entity_decode("&spades;");
                   return $symbol;
                   break;
               case "Diamond":
                   $symbol=html_entity_decode("&diams;"); 
                   return $symbol;
                   break;
               case "Club":
                    $symbol=html_entity_decode("&clubs;"); 
                   return $symbol;
                   break;
               case "Heart":
                    $symbol=html_entity_decode("&hearts;"); 
                   return $symbol;
                   break;
           }
  }
?>
</body>
</html>

    

     
    
