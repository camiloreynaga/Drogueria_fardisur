<?php

class Tipo_productoTest extends WebTestCase
{
	public $fixtures=array(
		'tipo_productos'=>'Tipo_producto',
	);

	public function testShow()
	{
		$this->open('?r=tipo_producto/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=tipo_producto/create');
	}

	public function testUpdate()
	{
		$this->open('?r=tipo_producto/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=tipo_producto/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=tipo_producto/index');
	}

	public function testAdmin()
	{
		$this->open('?r=tipo_producto/admin');
	}
}
