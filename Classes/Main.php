<?php

require 'vendor/autoload.php';

Class Main{
	Protected $players_cards;
	protected $is_game_over;
	protected $game_begin;
	protected $players_name;
	protected $current_value;
	protected $players_score;
	protected $maximum_match_value;
	protected $score_round;
	protected $lost_player;
	protected $deck_object;
	protected $score_object;
	protected $cards_per_person;
	protected $player;
	
	Public function __construct($deck_object,$score_object){
		$this->deck_object = $deck_object;
		$this->score_object = $score_object;
		//$this->players = $deck_object->distributionCards($player_names,$cards_per_person);
		$this->current_value = array();
		$this->is_game_over = FALSE;
		$this->game_begin = TRUE;
	}
	public function set_players_name(array $players_name){
		$this->players_name = $players_name;
	}
	
	public function set_card_per_person($cards_per_person){
		$this->cards_per_person = $cards_per_person;
	}
	//public functi
	
	public function intilalize_score(){
		foreach($this->players_name as $player_name){
			$this->players_score[$player_name] = 0;
		}
		//return $this->players_score;
	}
	
	public function play_game(){
		$this->players_cards = $this->deck_object->distributionCards($this->players_name,$this->cards_per_person);
		 while(!$this->is_game_over){
            $this->score_round = 0;
            if($this->game_begin){
                $start_person = array_rand($this->players_name);
				$this->players_name = change_order($start_person,$this->players_name);
			}
			
            $i = 0;

            $this->current_player = $this->players_name[$i];
            $this->current_value= array_shift($this->players_cards[$this->current_player]);
            $this->maximum_match_value = $this->current_value;
            $this->lost_player = $this->current_player;

            $symbol=Get_symbol($this->current_value["deck"]);
            echo '===============================';      
            echo "$this->current_player  plays {$this->current_value['value']}  $symbol"."<br>";
            $current_score = $this->score_object->getScore($this->current_value);
            $this->score_round = $this->score_round + $current_score;               
                
            for($j=1;$j<count($this->players_name);$j++) {
               $this->player = $this->players_cards[$this->players_name[$j]];
			   $this->compare_cards($this->players_name[$j]);
               $this->players_cards[$this->players_name[$j]] = $this->player;
            }
			
             echo "score ------ $this->score_round <br>";
             echo "lost player $this->lost_player <br>";
            $this->players_score[$this->lost_player] = $this->players_score[$this->lost_player]+$this->score_round;
            $this->game_begin = FALSE;
            if(empty($this->player)){
                  //var_dump($player_scores);
			 if($this->is_game_over()){
				break;
			 }
             $this->players_cards =$this->deck_object->distributionCards($this->players_name,$this->cards_per_person);
                  
            }
            $this->players_name = change_order($i+1,$this->players_name);
             
          }
	}
	
	public function is_game_over(){
		 if(max($this->players_score)>=50){
             $loses_game = array_search(max($this->players_score),$this->players_score);
              echo $loses_game." loses the game! <br>";
              echo "points.<br>";
               foreach($this->players_score as $score_key => $score_value){
                      echo $score_key.": ".$score_value."<br>";
                }
                $this->is_game_over=TRUE;
                return TRUE;

                    
         }
	}
	
	
	protected function compare_cards(string $key){
    
    $playingcard=array();
    $temp = array();
    $score = 0;
    $flag = 0;
         for($k=0;$k<count($this->player);$k++)
         {
              
          if($this->player[$k]['deck'] == $this->current_value['deck'])
          {
            if($this->player[$k]["value"]<=$this->current_value["value"])
            {
                 //var_dump($player[$k]);
                  $playingcard=$this->player[$k];   
                  $this->current_value = $playingcard; 
                  array_splice($this->player,$k,1);  
                  $flag =1;     
                  break;
            }
            else{
                $temp = $this->player[$k];
                $temp_key = $k;
                //var_dump($temp);
                if(count($temp)){
                    if($this->player[$k]['value'] <$temp['value'])
                    {
                      $temp = $this->player[$k];
                      $temp_key = $k;
                    }
                    
                }
            }
          }
          if(($k+1 == count($this->player)) && count($temp)){
               $playingcard=$temp;   
              array_splice($this->player,$temp_key,1);       
        

            }
       
         }
       
       if(empty($playingcard))
       {
          $playingcard=  array_shift($this->player);
        }
          $score = $this->score_object->getScore($playingcard);
          //echo "$score"." "."<br>";
          if(!$flag){
            if(($playingcard['deck'] == $this->maximum_match_value['deck']) &&
              $playingcard['value'] > $this->maximum_match_value['value']){
              $this->maximum_match_value = $playingcard;
              $this->lost_player = $key;
              //print "$lost_player"."=----------= <br>";
            }
            
          }
          $this->score_round = $this->score_round + $score;
          $symbol=Get_symbol($playingcard["deck"]);
           echo "$key  plays {$playingcard['value']}  $symbol"."<br>";
      
}

	

	
	
}