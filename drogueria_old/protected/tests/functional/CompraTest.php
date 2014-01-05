<?php

class CompraTest extends WebTestCase
{
	public $fixtures=array(
		'compras'=>'Compra',
	);

	public function testShow()
	{
		$this->open('?r=compra/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=compra/create');
	}

	public function testUpdate()
	{
		$this->open('?r=compra/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=compra/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=compra/index');
	}

	public function testAdmin()
	{
		$this->open('?r=compra/admin');
	}
}
