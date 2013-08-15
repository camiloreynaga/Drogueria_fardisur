<?php

class EmpleadoTest extends WebTestCase
{
	public $fixtures=array(
		'empleados'=>'Empleado',
	);

	public function testShow()
	{
		$this->open('?r=empleado/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=empleado/create');
	}

	public function testUpdate()
	{
		$this->open('?r=empleado/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=empleado/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=empleado/index');
	}

	public function testAdmin()
	{
		$this->open('?r=empleado/admin');
	}
}
