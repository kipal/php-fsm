<?php
/**
 * Copyright 2016 Nándor Kiss. All rights reserved.
 * Use of this source code is governed by a MIT-style
 * license that can be found in the LICENSE file.
 */
class EmptyCurrentStateException extends Exception
{
	/**
	 * @param $methodName string
	 * @param $input      Input
	 */
	public static function getInstance($methodName, Input $input)
	{
		return new EmptyCurrentStateException(
			"Method '$methodName' with '$input->toSignature()' parameter returned null as state."
		);
	}
}
