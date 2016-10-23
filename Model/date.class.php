<?php
	class  FormatedDate{
		public function __construct(){}
		public function getDate() {
				date_default_timezone_set("America/Sao_Paulo");
					$date = array(
								'd'=>null,
								'm'=>null,
								'y'=>null,
								'h'=>null,
								'm'=>null
					);
					switch(date('D')){
						case 'Fri':$date['d'] = 'Sexta';
						break;
						case 'Mon':$date['d'] = 'Segunda';
						break;
						case 'Tue':$date['d'] = 'Terça';
						break;
						case 'Wed':$date['d'] = 'Quarta';
						break;			
						case 'Thu':$date['d'] = 'Quinta';
						break;			
						case 'Fri':$date['d'] = 'Sexta';
						break;			
						case 'Sat':$date['d'] = 'Sábado';
						break;			
						case 'Sun':$date['d'] = 'Domingo';
						break;
						default:exit(0);
					}
					switch(date('M')){
						case 'Jan':$date['m'] = 'Janeiro';
						break;			
						case 'Feb':$date['m'] = 'Fevereiro';
						break;			
						case 'Mar':$date['m'] = 'Março';
						break;			
						case 'Apr':$date['m'] = 'Abril';
						break;			
						case 'May':$date['m'] = 'Maio';
						break;			
						case 'Jun':$date['m'] = 'Junho';
						break;			
						case 'Aug':$date['m'] = 'Agosto';
						break;			
						case 'Sep':$date['m'] = 'Setembro';
						break;			
						case 'Oct':$date['m'] = 'Outubro';
						break;			
						case 'Nov':$date['m'] = 'Novembro';
						break;			
						case 'Dec':$date['m'] = 'Dezembro';
						break;
						default:exit(0);
					}
					return utf8_encode($date['d'].", ".date('d')." de ".$date['m']." de ".date('Y'). ' as '.date('H:i')); 
			}
		}
?>