<?php

class LaboratorioTest extends WebTestCase
{
	public $fixtures=array(
		'laboratorios'=>'Laboratorio',
	);

	public function testShow()
	{
		$this->open('?r=laboratorio/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=laboratorio/create');
	}

	public function testUpdate()
	{
		$this->open('?r=laboratorio/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=laboratorio/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=laboratorio/index');
	}

	public function testAdmin()
	{
		$this->open('?r=laboratorio/admin');
	}
}
