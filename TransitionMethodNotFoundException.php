<?php
/**
 * Copyright 2015 Nándor Kiss. All rights reserved.
 * Use of this source code is governed by a MIT-style
 * license that can be found in the LICENSE file.
 */

class TransitionMethodNotFoundException extends Exception
{
	/**
	 * @param $fsm        FSM
	 * @param $methodName string
	 */
	public static function getInstance($fsm, $methodName)
	{
		return new TransitionMethodNotFoundException(
			"There's no method '$methodName' in class '" . get_class($fsm)  . "'."
		);
	}
}
