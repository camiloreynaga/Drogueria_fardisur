<?php

class PresentacionTest extends WebTestCase
{
	public $fixtures=array(
		'presentacions'=>'Presentacion',
	);

	public function testShow()
	{
		$this->open('?r=presentacion/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=presentacion/create');
	}

	public function testUpdate()
	{
		$this->open('?r=presentacion/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=presentacion/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=presentacion/index');
	}

	public function testAdmin()
	{
		$this->open('?r=presentacion/admin');
	}
}
