<?php

class Detalle_compraTest extends WebTestCase
{
	public $fixtures=array(
		'detalle_compras'=>'Detalle_compra',
	);

	public function testShow()
	{
		$this->open('?r=detalle_compra/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=detalle_compra/create');
	}

	public function testUpdate()
	{
		$this->open('?r=detalle_compra/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=detalle_compra/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=detalle_compra/index');
	}

	public function testAdmin()
	{
		$this->open('?r=detalle_compra/admin');
	}
}
