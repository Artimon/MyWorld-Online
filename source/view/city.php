<?php

/**
 * @var string $logoutUrl
 * @var Building_Interface[] $buildings
 */

$logout = i18n('logout');

echo "
Hellooo beautiful!
<p>
	<a href='{$logoutUrl}'>{$logout}</a>
</p>";
foreach ($buildings as $building) {
	echo "<p>{$building->level()}</p>";
}