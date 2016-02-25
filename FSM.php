<?php
/**
 * Copyright 2015 Nándor Kiss. All rights reserved.
 * Use of this source code is governed by a MIT-style
 * license that can be found in the LICENSE file.
 */

include "FirstState.php";

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
