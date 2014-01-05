<?php

class Cuenta_pagarTest extends WebTestCase
{
	public $fixtures=array(
		'cuenta_pagars'=>'Cuenta_pagar',
	);

	public function testShow()
	{
		$this->open('?r=cuenta_pagar/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=cuenta_pagar/create');
	}

	public function testUpdate()
	{
		$this->open('?r=cuenta_pagar/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=cuenta_pagar/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=cuenta_pagar/index');
	}

	public function testAdmin()
	{
		$this->open('?r=cuenta_pagar/admin');
	}
}
