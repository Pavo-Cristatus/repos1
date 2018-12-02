<?

class Reverser
{
    function revertPunctuationMarks($string) {
        $string = mb_convert_encoding($string, "windows-1251", "UTF-8");
        $strChars = array();
        $strChars = str_split($string);

        $nonLets = array();
        foreach ($strChars as $char) {
            $char = mb_convert_encoding ($char, "UTF-8","windows-1251");
            if ( !preg_match("/^[a-zа-я0-9]{1}/i", $char)) {
                $nonLets[]=$char;
            }
        }
/*
        foreach ($nonLets as $let) {
            echo mb_convert_encoding($let, "windows-1251", "UTF-8");
        }
*/
        $nonLets = array_reverse ($nonLets);

        $i=0;
        $j=0;
        foreach ($strChars as $char) {
            $char = mb_convert_encoding ($char, "UTF-8","windows-1251");
            if ( !preg_match("/^[a-zа-я0-9]{1}/i", $char)) {
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

$str = 'Привет! Каг дила?';
echo mb_convert_encoding($str, "windows-1251", "UTF-8");
echo $obj->revertPunctuationMarks($str);

/*------------------test---------------------*/

/*Тестов я не писал и у меня не установлен PHPUnit, но предполагаю что доложно получиться что-то навроде...*/

$x=1;
$y=2;
$y +=$x;
echo $y;

require_once 'PHPUnit/Framework.php';

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
