<?php

	
	
	function dateBetween($date_a , $date_b): string
	{
		
	
		
		
		$diff = abs(strtotime($date_a) - strtotime($date_b));
		
		$years = floor($diff / (365*60*60*24));



		$months = floor(($diff - $years * 365*60*60*24)
			/ (30*60*60*24));


		$days = floor(($diff - $years * 365*60*60*24 -
				$months*30*60*60*24)/ (60*60*24));



		$hours = floor(($diff - $years * 365*60*60*24
				- $months*30*60*60*24 - $days*60*60*24)
			/ (60*60));



		$minutes = floor(($diff - $years * 365*60*60*24
				- $months*30*60*60*24 - $days*60*60*24
				- $hours*60*60)/ 60);



		
		
		if($years > 0){
			return $years .'y';
		}
		else{
			if($months >= 1 && $months<= 12){
				return $months .'m';
			}
			else{
				
				if($days>0 && $days<= 30){
					return $days . 'd';
				}
				else{
					if($hours > 0 && $hours<=24){
						return $hours . 'h';
					}
					else{
						if($minutes >0 && $months<=59){
							return $minutes.'mn';
						}
						else{
							return 'now';
						}
					}
				}
				
			}
			
		}
		
	}