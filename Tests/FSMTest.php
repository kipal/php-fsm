<?php
/**
 * Copyright 2015 Nándor Kiss. All rights reserved.
 * Use of this source code is governed by a MIT-style
 * license that can be found in the LICENSE file.
 */

include_once "Input.php";
include_once "FSM.php";
include_once "TransitionMethodNotFoundException.php";

class TestInput implements Input
{
	protected $value;

	public function __construct($value)
	{
		$this->value = $value;
	}

	public function toSignature()
	{
		return $this->value;
	}
}

class TestFSM extends FSM
{
	protected function transitionByStateFirstInputFirst(Input $i)
	{
		return new TestState("second");
	}

	protected function transitionByStateSecondInputSecond(Input $i)
	{
		return new TestState("third");
	}
}

class TestState implements State
{
	protected $value;

	public function __construct($value)
	{
		$this->value = $value;
	}

	public function toSignature()
	{
		return $this->value;
	}
}

class FSMTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @expectedException TransitionMethodNotFoundException
	 */
	public function testTransitionMethodNotFound()
	{
		$fsm = new TestFSM();

		$fsm->transition(new TestInput("notFound"));
	}

	public function testFirstTransition()
	{
		$fsm = new TestFSM();

		$fsm->transition(new TestInput("first"));
	}

	public function testJumpStateToAnother()
	{
		$fsm = new TestFSM();

		$fsm->transition(new TestInput("first"));
		$fsm->transition(new TestInput("second"));

		$this->assertEquals("third", $fsm->getCurrentState()->toSignature());
	}
}
