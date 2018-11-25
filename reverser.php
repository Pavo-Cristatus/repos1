<?

class Reverser
{
    function revertPunctuationMarks($string) {
		$strChars = str_split($string);
		$nonLets = array();
		foreach ($strChars as $char) {
			if ( !preg_match("/^[a-zA-Zа-яА-Я0-9]{1}/i", $char) ) {
				$nonLets[]=$char;
			}
		}
		$nonLets = array_reverse ($nonLets);

		$i=0;
		$j=0;
		foreach ($strChars as $char) {
			if ( !preg_match("/^[a-zA-Zа-яА-Я0-9]{1}/i", $char) ) {
				$strChars[$i]=$nonLets[$j]['char'];
				$j++;
			}
			$i++;
		}
		unset($i, $j);
		$strChars = implode ('', $strChars);
		return $strChars;
    }
}

$obj = new Reverser;

echo $obj->revertPunctuationMarks('Привет! Как твои дела?');

/*------------------test---------------------*/

//require_once 'PHPUnit/Framework.php';

class ReverserTest extends PHPUnit_Framework_TestCase {

    /**
    * @dataProvider providerPower
    */
    public function testRevertPunctuationMarks($a, $b)
    {
        $my = new MyClass();
        $this->assertEquals($b, $my->revertPunctuationMarks($a));
    }

    public function providerRevertPunctuationMarks ()
    {
        return array (
            array ('Привет! Как твои дела?', 'Привет? Как твои дела!'),
            array ('Hello! How are u?', 'Hello? How are u!'),
            array ('111! 2222?', '111? 2222!')
        );
    }
}
