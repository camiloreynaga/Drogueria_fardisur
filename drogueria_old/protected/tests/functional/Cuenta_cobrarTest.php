<?php

class Cuenta_cobrarTest extends WebTestCase
{
	public $fixtures=array(
		'cuenta_cobrars'=>'Cuenta_cobrar',
	);

	public function testShow()
	{
		$this->open('?r=cuenta_cobrar/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=cuenta_cobrar/create');
	}

	public function testUpdate()
	{
		$this->open('?r=cuenta_cobrar/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=cuenta_cobrar/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=cuenta_cobrar/index');
	}

	public function testAdmin()
	{
		$this->open('?r=cuenta_cobrar/admin');
	}
}
