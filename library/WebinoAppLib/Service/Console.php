<?php

namespace WebinoAppLib\Service;

use League\CLImate\CLImate;
use League\CLImate\TerminalObject;
use League\CLImate\TerminalObject\Dynamic;
use League\CLImate\Util;

/**
 * Class Console
 *
 * @method $this black(string $str = null)
 * @method $this red(string $str = null)
 * @method $this green(string $str = null)
 * @method $this yellow(string $str = null)
 * @method $this blue(string $str = null)
 * @method $this magenta(string $str = null)
 * @method $this cyan(string $str = null)
 * @method $this lightGray(string $str = null)
 * @method $this darkGray(string $str = null)
 * @method $this lightRed(string $str = null)
 * @method $this lightGreen(string $str = null)
 * @method $this lightYellow(string $str = null)
 * @method $this lightBlue(string $str = null)
 * @method $this lightMagenta(string $str = null)
 * @method $this lightCyan(string $str = null)
 * @method $this white(string $str = null)
 *
 * @method $this backgroundBlack(string $str = null)
 * @method $this backgroundRed(string $str = null)
 * @method $this backgroundGreen(string $str = null)
 * @method $this backgroundYellow(string $str = null)
 * @method $this backgroundBlue(string $str = null)
 * @method $this backgroundMagenta(string $str = null)
 * @method $this backgroundCyan(string $str = null)
 * @method $this backgroundLightGray(string $str = null)
 * @method $this backgroundDarkGray(string $str = null)
 * @method $this backgroundLightRed(string $str = null)
 * @method $this backgroundLightGreen(string $str = null)
 * @method $this backgroundLightYellow(string $str = null)
 * @method $this backgroundLightBlue(string $str = null)
 * @method $this backgroundLightMagenta(string $str = null)
 * @method $this backgroundLightCyan(string $str = null)
 * @method $this backgroundWhite(string $str = null)
 * 
 * @method $this bold(string $str = null)
 * @method $this dim(string $str = null)
 * @method $this underline(string $str = null)
 * @method $this invert(string $str = null)
 *
 * @method $this info(string $str = null)
 * @method $this comment(string $str = null)
 * @method $this whisper(string $str = null)
 * @method $this shout(string $str = null)
 * @method $this error(string $str = null)
 *
 * @method $this columns(array $data, $column_count = null)
 * @method $this out(string $str)
 * @method $this inline(string $str)
 * @method $this table(array $data)
 * @method $this json(mixed $var)
 * @method $this br($count = 1)
 * @method $this tab($count = 1)
 * @method $this View(string $art)
 * @method $this border(string $char = null, integer $length = null)
 * @method $this dump(mixed $var)
 * @method $this flank(string $output, string $char = null, integer $length = null)
 *
 * @method Dynamic\Progress progress(integer $total = null)
 * @method Dynamic\Padding mixed padding(integer $length = 0, string $char = '.')
 * @method Dynamic\Input input(string $prompt, Util\Reader\ReaderInterface $reader = null)
 * @method Dynamic\Confirm confirm(string $prompt, Util\Reader\ReaderInterface $reader = null)
 * @method Dynamic\Password password(string $prompt, Util\Reader\ReaderInterface $reader = null)
 * @method Dynamic\Checkboxes checkboxes(string $prompt, array $options, Util\Reader\ReaderInterface $reader = null)
 * @method Dynamic\Radio radio(string $prompt, array $options, Util\Reader\ReaderInterface $reader = null)
 * @method Dynamic\Animation animation(string $art, TerminalObject\Helper\Sleeper $sleeper = null)
 *
 * @method $this addArt(string $dir)
 * @method $this clear()
 */
final class Console extends CLImate
{

}
