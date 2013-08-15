<?php

class ProductoTest extends WebTestCase
{
	public $fixtures=array(
		'productos'=>'Producto',
	);

	public function testShow()
	{
		$this->open('?r=producto/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=producto/create');
	}

	public function testUpdate()
	{
		$this->open('?r=producto/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=producto/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=producto/index');
	}

	public function testAdmin()
	{
		$this->open('?r=producto/admin');
	}
}
