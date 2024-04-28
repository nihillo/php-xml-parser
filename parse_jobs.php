<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	// incluimos view.php, que contiene la función printJob relacionada con la vista
	// de la aplicación
	include_once("view.php");

	// requierimos JobDataModel, que proporciona la clase con que se definen los objetos
	// de los modelos de datos de cada oferta de trabajo
	require_once("JobDataModel.php");

	// Variables globales para controlar elementos que se están procesando
	// en cada momento
	$currentJobNode = null;
	$currentProcessingTag = null;

	// Creamos el parse y referenciamos los manejadores de apertura, cierre y datos
	$parser = xml_parser_create();
	xml_set_element_handler($parser, "startTagHandler","endTagHandler");
	xml_set_character_data_handler($parser, "dataHandler");
	
	// Fichero a tratar
	xml_parse($parser,file_get_contents("input.xml"));

	// Una vez analizado el documento XML libero la memoria del analizador	
	xml_parser_free($parser);
	


	function startTagHandler($parser,$element,$attrs){
		global $currentJobNode;
		global $currentProcessingTag;

		$currentProcessingTag = $element;

		switch($element)
   	 	{
			
	    	case "JOB":
				// Al abrir etiqueta job, inicializamos modelo de datos de la oferta, que se irán completando 
				// al procesar los elementos del XML internos a <job>
				$currentJobNode = new JobDataModel();
				break;
			default:
				// resto de etiquetas, no hacer nada
   	 	}
	}

	function dataHandler($parser, $data) {
		global $currentJobNode;
		global $currentProcessingTag;

		switch($currentProcessingTag) {
			// en tipos simples, asignamos directamente $data al atributo del
			// data model que corresponda
			case "TITLE":
				$currentJobNode->title = $data;
				break;
			case "COMPANY":
				$currentJobNode->company = $data;
				break;
			case "LOCATION":
				$currentJobNode->location = $data;
				break;
			case "WORKPLACETYPES":
				$currentJobNode->workplaceTypes = $data;
				break;
			case "APPLYURL":
				$currentJobNode->applyUrl = $data;
				break;
			case "DESCRIPTION":
				$currentJobNode->description = $data;
				break;
			case "JOBTYPE":
				$currentJobNode->jobType = $data;
				break;
			case "EXPERIENCELEVEL":
				$currentJobNode->experienceLevel = $data;
				break;

			// en tipos complejos que sean secuencia de tipos simples iguales,
			// añadimos el valor a la lista
			case "JOBFUNCTION":
				array_push($currentJobNode->jobFunctions, $data);
				break;
			case "SKILL":
				array_push($currentJobNode->skills, $data);
				break;

			// para el caso concreto del rango de salarios, nos quedamos con el valor más bajo
			// y más alto de entre todos los nodos amount que contenga la oferta
			case "AMOUNT":
				if ($data < $currentJobNode->minSalary) {
					$currentJobNode->minSalary = $data;
				}
				if ($data > $currentJobNode->maxSalary) {
					$currentJobNode->maxSalary = $data;
				} 
			default:
				// resto de etiquetas, no hacer nada
		}
	}

	function endTagHandler($parser,$element){
		global $currentJobNode;
		global $currentProcessingTag;

		switch($element) {
	    	case "JOB":
    			// Al cerrar la etiqueta job, imprimimos el elemento html completo, a partir de los datos de la
				// oferta guardados en el modelo de datos - llamamos a printJob, definida en view.php
				printJob($currentJobNode);
				$currentJobNode = null;
    			break;
			default:
				// resto de etiquetas, no hacer nada
   	 	}

		$currentProcessingTag = null;
	}