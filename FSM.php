<?php
/**
 * Copyright 2015 Nándor Kiss. All rights reserved.
 * Use of this source code is governed by a MIT-style
 * license that can be found in the LICENSE file.
 */

include_once "FirstState.php";
include_once "TransitionMethodNotFoundException.php";
include_once "EmptyCurrentStateException.php";

abstract class FSM
{
	/**
	 * @var State
	 */
	protected $currentState = null;

	public function __construct(State $firstState = null)
	{
		if (empty($firstState)) {
			$this->currentState = new FirstState();
		}
	}

	/**
	 * @throw TransitionMethodNotFoundException
	 */
	public function __call($name, $arguments)
	{
		
		throw TransitionMethodNotFoundException::getInstance($this, $name);
	}

	public function transition(Input $i)
	{
		$methodName = "transitionByState" . ucfirst($this->currentState->toSignature()) . "Input" . ucfirst($i->toSignature());

		$this->currentState = $this->$methodName($i);
		
		if (empty($this->currentState)) {
			
			throw EmptyCurrentStateException::getInstance($methodName, $i);
		}
	}

	/**
	 * 
	 * @return State
	 */
	public function getCurrentState()
	{

		return $this->currentState;
	}
}
