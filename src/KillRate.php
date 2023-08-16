<?php
namespace src;
require_once __DIR__ . '/../vendor/autoload.php';


class KillRate {
    public $residents =[];

    public function __construct($residents)
    {
        $this->residents = $residents;
    }

    public function getAverage(){
        $peopleContainer = [];
        foreach($this->residents as $resident){
            if($resident['ageOfDeath'] <= 0){
                return -1;
            }
            $yearOfBirth = $resident['yearOfDeath'] - $resident['ageOfDeath'];
            if($yearOfBirth <= 0){
                return -1;
            }
            $people = $this->getYearlyPopulation($yearOfBirth);
            array_push($peopleContainer, $people);
        }
        return array_sum($peopleContainer)/count($this->residents);
    }

    public function getYearlyPopulation($year){
        $tmp = [1];
        for($i = 1;$i < $year;$i++){
            if(count($tmp) >= 2){
                 $sum = $tmp[count($tmp) - 2] + $tmp[count($tmp) - 1];
            }else{
                $sum =1;
            }
            array_push($tmp, $sum);
        }
        return array_sum($tmp);
    }
}



