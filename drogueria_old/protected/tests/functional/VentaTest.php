<?php

class VentaTest extends WebTestCase
{
	public $fixtures=array(
		'ventas'=>'Venta',
	);

	public function testShow()
	{
		$this->open('?r=venta/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=venta/create');
	}

	public function testUpdate()
	{
		$this->open('?r=venta/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=venta/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=venta/index');
	}

	public function testAdmin()
	{
		$this->open('?r=venta/admin');
	}
}
