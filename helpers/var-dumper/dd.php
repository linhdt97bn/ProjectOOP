<?php

require 'Dumper/DataDumperInterface.php';
require 'Cloner/DumperInterface.php';
require 'Cloner/ClonerInterface.php';

require 'Dumper/AbstractDumper.php';
require 'Dumper/CliDumper.php';
require 'Dumper/HtmlDumper.php';

require 'Cloner/AbstractCloner.php';
require 'Cloner/Cursor.php';
require 'Cloner/Data.php';
require 'Cloner/Stub.php';
require 'Cloner/VarCloner.php';

require 'Caster/Caster.php';

function dd(...$args)
{
    foreach ($args as $x) {
        (new Dumper)->dump($x);
    }

    echo '<script>
	    	let open = document.getElementsByClassName("sf-dump-toggle");
			for (let i = 1; i < open.length; i++) {
			    open[i].click();
			}
		 </script>';
    die(1);
}

class Dumper
{
    public function dump($value)
    {
        $dumper = new HtmlDumper;
        $dumper->dump((new VarCloner)->cloneVar($value));
    }
}
