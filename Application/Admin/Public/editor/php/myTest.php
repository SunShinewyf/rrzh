<?php
echo '$_SERVER["HTTP_HOST"]:'.$_SERVER['HTTP_HOST'];
echo '<br/>';
echo dirname(__FILE__) . '/';
echo '<br/>';
echo dirname($_SERVER['PHP_SELF']) . '/';
echo '<br/>';
echo dirname(dirname(dirname(dirname(dirname($_SERVER['PHP_SELF'])))));