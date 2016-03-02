<?php
/**
 * Copyright 2015 Nándor Kiss. All rights reserved.
 * Use of this source code is governed by a MIT-style
 * license that can be found in the LICENSE file.
 */

include_once "State.php";

class FirstState implements State
{
	public function toSignature()
	{
		return "first";
	}
}
