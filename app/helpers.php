<?php

use Illuminate\Support\Facades\DB;

if(!function_exists('is_certif'))
{
    function is_certif($certif)
    {
        return ($certif == 'yes')? 
               '<span class="badge badge-success rounded-pill">Oui</span>': 
               '<span class="badge badge-danger rounded-pill">Non</span>';
    }
}

if(!function_exists('formation_type'))
{
    function formation_type($type)
    {
        return ($type == 'online')? 
               '<span class="badge badge-info rounded">En ligne</span>': 
               '<span class="badge outline-badge-primary rounded">Physique</span>';
    }
}

if(!function_exists('group_dates'))
{
    function group_dates($dates)
    {
        
    }
}

if(!function_exists('generate_number_from_counter'))
{
    function generate_number_from_counter($counter = 0)
    {
        $min_length = 3; //minimal length [caracters number] in the generated number
        $replace = '0'; //prepend this caracter when the length is inferior to min_length
        $new_counter = $counter + 1; //increment the counter
        $generated_number = '';

        if(strlen($new_counter) <= $min_length)
        {
            for($i=1; $i<=($min_length - strlen($new_counter)); $i++)
            {
                $generated_number .= $replace;
            }
            $generated_number .= $new_counter;
        }
        else
        {
            $generated_number = $new_counter;
        }
        
        return $generated_number;
    }
}

if(!function_exists('sqlDate'))
{
    function sqlDate($input_date){
    
        $month = substr($input_date,3,2);
        $day = substr($input_date,0,2);
        $year = substr($input_date,6,4);
        $output_date = $year.'-'.$month.'-'.$day;
        
        return $output_date;
    }
}

if(!function_exists('getMonth'))
{
    function getMonth($date)
    {
        return substr($date,5,2);
    }
}

if(!function_exists('getDay'))
{
    function getDay($date)
    {
        return substr($date,8,2);
    }
}

if(!function_exists('getYear'))
{
    function getYear($date)
    {
        return substr($date,0,4);
    }
}

if(!function_exists('returnDate'))
{
    function returnDate($input_date)
    {
            $month = substr($input_date,5,2);
            $day = substr($input_date,8,2);
            $year = substr($input_date,0,4);
            $time = substr($input_date,10);
            $output_date = $day ."/". $month. "/". $year. $time;
            
            return $output_date;
    }
}

if(!function_exists('maxDate'))
{
    function maxDate($date1, $date2)
    {
        if($date1 > $date2) { return $date1; }
        else { return $date2; }
    }
}

if(!function_exists('minDate'))
{
    function minDate($date1, $date2)
    {
        if($date1 > $date2) { return $date2; }
        else { return $date1; }
    }
}
