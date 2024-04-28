<?php
class JobDataModel {
    public $title;
    public $company;
    public $location;
    public $workplaceTypes;
    public $applyUrl;
    public $description;
    public $jobType;
    public $experienceLevel;
    public $jobFunctions;
    public $skills;
    public $minSalary;
    public $maxSalary;

    public function __construct() {
        //inicializamos las variables de valores agregados como arrays vacíos
        $this->jobFunctions = array();
        $this->skills = array();

        // iniciamos minSalary con valor muy alto, ya que se sobreescribirá
        // siempre que el valor evaluado sea menor al guardado
        $this->minSalary = 999999999999999999;

        // iniciamos maxSalary con valor 0, ya que se sobreescribirá
        // siempre que el valor evaluado sea mayor al guardado
        $this->maxSalary = 0;
    }
}