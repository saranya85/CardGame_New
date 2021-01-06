<?php
class Decks
{
    public $stack;
   
    //creating 32 cards using value, deck
    public function __construct(array $value,array $deck) 
    {
        $key=0;
        for($i=0;$i<count($value);$i++)
      {
          foreach($deck as $deck_one)
          {
              $this->stack[$key]["value"]=$value[$i];
              $this->stack[$key]["deck"]=$deck_one;
              $key++;
          }
            
      }
      shuffle($this->stack);
      
    }
    public function getValue() :array
    {
          return $this->stack;
    }
    


    public function distributionCards(array $player_names,int $cards_per_person):array
    {
      $stack = $this->stack;
	  shuffle($stack);
      $players = array();
      $element=0;
       //Getting cards for 4 players
        for($limit=0;$limit<$cards_per_person;$limit++)
        {
			foreach($player_names as $player_name){
				$players[$player_name][$limit] = $stack[$element];
				 $element++;
			}
        }
       
       return $players;
    }
}


