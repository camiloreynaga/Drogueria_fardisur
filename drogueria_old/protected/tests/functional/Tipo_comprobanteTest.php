<?php

class Tipo_comprobanteTest extends WebTestCase
{
	public $fixtures=array(
		'tipo_comprobantes'=>'Tipo_comprobante',
	);

	public function testShow()
	{
		$this->open('?r=tipo_comprobante/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=tipo_comprobante/create');
	}

	public function testUpdate()
	{
		$this->open('?r=tipo_comprobante/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=tipo_comprobante/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=tipo_comprobante/index');
	}

	public function testAdmin()
	{
		$this->open('?r=tipo_comprobante/admin');
	}
}
