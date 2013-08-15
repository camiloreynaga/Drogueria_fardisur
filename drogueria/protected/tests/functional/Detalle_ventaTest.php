<?php

class Detalle_ventaTest extends WebTestCase
{
	public $fixtures=array(
		'detalle_ventas'=>'Detalle_venta',
	);

	public function testShow()
	{
		$this->open('?r=detalle_venta/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=detalle_venta/create');
	}

	public function testUpdate()
	{
		$this->open('?r=detalle_venta/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=detalle_venta/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=detalle_venta/index');
	}

	public function testAdmin()
	{
		$this->open('?r=detalle_venta/admin');
	}
}
