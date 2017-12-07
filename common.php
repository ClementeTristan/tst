<?php

/**
 * Escapes HTML for output
 *
 */
error_reporting(0);
function escape($html)
{
	return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}
?>