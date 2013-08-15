<?php

class ProveedorTest extends WebTestCase
{
	public $fixtures=array(
		'proveedors'=>'Proveedor',
	);

	public function testShow()
	{
		$this->open('?r=proveedor/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=proveedor/create');
	}

	public function testUpdate()
	{
		$this->open('?r=proveedor/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=proveedor/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=proveedor/index');
	}

	public function testAdmin()
	{
		$this->open('?r=proveedor/admin');
	}
}
