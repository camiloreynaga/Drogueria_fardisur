<?php

class AlmacenTest extends WebTestCase
{
	public $fixtures=array(
		'almacens'=>'Almacen',
	);

	public function testShow()
	{
		$this->open('?r=almacen/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=almacen/create');
	}

	public function testUpdate()
	{
		$this->open('?r=almacen/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=almacen/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=almacen/index');
	}

	public function testAdmin()
	{
		$this->open('?r=almacen/admin');
	}
}
