<?php 
class Score{

	public $scores;
	public $default_score;

	public function __construct(array $values){
		$this->default_score = 0;
		for($i=0;$i<count($values);$i++) {
			$this->scores[$i]['value']=$values[$i];
			$this->scores[$i]['deck'] ='Heart';
			$this->scores[$i]['score'] = 1;
		}
		$this->scores[$i]['value']='J';
		$this->scores[$i]['deck'] ='Club';
		$this->scores[$i]['score'] = 2;
		$i++;
		$this->scores[$i]['value']='Q';
		$this->scores[$i]['deck'] ='Spade';
		$this->scores[$i]['score'] = 5;
		
	}

	public function getScore(array $current_value): int{

		//get score for the corresponding deck
		foreach($this->scores as $key => $score){
			
			if(($current_value['deck'] == $score['deck'])&&
				($current_value['value'] == $score['value'])){
				
				return $score['score'];
			}
		}
		return $this->default_score;

	}
}