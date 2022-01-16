<?php

/*
 * Author: doug@neverfear.org
 */

require("Dijkstra.php");

class run{
	

	public $first;
	public $second;
	public $data;
	function __construct($arr,$a,$b)
	{
		$this->first = $a;
		$this->second = $b;
		$this->data = $arr;
	}


function runTest() {

	// $maps = array(
	// 	array("a", "b", 2),
	// 	array("a", "d", 5),
	// 	array("a", "c", 1),
	// 	array("b", "c", 4),
	// 	array("c", "d", 3)
	// );

	$g = new Graph();

	foreach($this->data as $map)
	{
		$g->addedge($map[0],$map[1],$map[2]);
	}

	// $g->addedge("a", "b", 2);
	// $g->addedge("a", "d", 5);

	// $g->addedge("a", "c", 11);
	// $g->addedge("b", "c", 4);
	// $g->addedge("c", "d", 3);



	// $g->addedge("a", "b", 403);
	// $g->addedge("a", "d", 1);

	// $g->addedge("b", "a", 74);
	// $g->addedge("b", "c", 22);
	// $g->addedge("b", "e", 12);

	// $g->addedge("c", "b", 12);
	// $g->addedge("c", "j", 12);
	// $g->addedge("c", "f", 74);

	// $g->addedge("d", "g", 22);
	// $g->addedge("d", "e", 32);

	// $g->addedge("e", "h", 33);
	// $g->addedge("e", "d", 66);
	// $g->addedge("e", "f", 76);

	// $g->addedge("f", "j", 21);
	// $g->addedge("f", "i", 11);

	// $g->addedge("g", "c", 12);
	// $g->addedge("g", "h", 10);

	// $g->addedge("h", "g", 2);
	// $g->addedge("h", "i", 72);

	// $g->addedge("i", "j", 7);
	// $g->addedge("i", "f", 31);
	// $g->addedge("i", "h", 18);

	// $g->addedge("j", "f", 8);


	list($distances, $prev) = $g->paths_from($this->first);
	
	$path = $g->paths_to($prev,$this->second);

	//print_r($path);

	return $path;
	
}

}
//runTest();

