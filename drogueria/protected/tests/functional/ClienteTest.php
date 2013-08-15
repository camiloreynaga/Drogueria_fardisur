<?php

class ClienteTest extends WebTestCase
{
	public $fixtures=array(
		'clientes'=>'Cliente',
	);

	public function testShow()
	{
		$this->open('?r=cliente/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=cliente/create');
	}

	public function testUpdate()
	{
		$this->open('?r=cliente/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=cliente/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=cliente/index');
	}

	public function testAdmin()
	{
		$this->open('?r=cliente/admin');
	}
}
