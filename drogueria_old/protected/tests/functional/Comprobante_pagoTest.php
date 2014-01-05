<?php

class Comprobante_pagoTest extends WebTestCase
{
	public $fixtures=array(
		'comprobante_pagos'=>'Comprobante_pago',
	);

	public function testShow()
	{
		$this->open('?r=comprobante_pago/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=comprobante_pago/create');
	}

	public function testUpdate()
	{
		$this->open('?r=comprobante_pago/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=comprobante_pago/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=comprobante_pago/index');
	}

	public function testAdmin()
	{
		$this->open('?r=comprobante_pago/admin');
	}
}
