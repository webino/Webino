<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Service;

use League\CLImate\CLImate;
use League\CLImate\TerminalObject\Dynamic;

/**
 * Class Console
 */
class Console
{
    /**
     * @var CLImate
     */
    protected $engine;

    /**
     * @param CLImate $engine
     */
    public function __construct(CLImate $engine)
    {
        $this->engine = $engine;
    }

    /**
     * Add literal art directory
     *
     * @param string $dir
     * @return $this
     */
    public function addArt($dir)
    {
        $this->engine->addArt($dir);
        return $this;
    }

    /**
     * Clear screen
     *
     * @return $this
     */
    public function clear()
    {
        $this->engine->clear();
        return $this;
    }

    /**
     * Black text color
     *
     * @param string|null $str
     * @return $this
     */
    public function black($str = null)
    {
        $this->engine->black($str);
        return $this;
    }

    /**
     * Red text color
     *
     * @param string|null $str
     * @return $this
     */
    public function red($str = null)
    {
        $this->engine->red($str);
        return $this;
    }

    /**
     * Green text color
     *
     * @param string|null $str
     * @return $this
     */
    public function green($str = null)
    {
        $this->engine->green($str);
        return $this;
    }

    /**
     * Yellow text color
     *
     * @param string|null $str
     * @return $this
     */
    public function yellow($str = null)
    {
        $this->engine->yellow($str);
        return $this;
    }

    /**
     * Blue text color
     *
     * @param string|null $str
     * @return $this
     */
    public function blue($str = null)
    {
        $this->engine->blue($str);
        return $this;
    }

    /**
     * Magenta text color
     *
     * @param string|null $str
     * @return $this
     */
    public function magenta($str = null)
    {
        $this->engine->magenta($str);
        return $this;
    }

    /**
     * Cyan text color
     *
     * @param string|null $str
     * @return $this
     */
    public function cyan($str = null)
    {
        $this->engine->cyan($str);
        return $this;
    }

    /**
     * Light gray text color
     *
     * @param string|null $str
     * @return $this
     */
    public function lightGray($str = null)
    {
        $this->engine->lightGray($str);
        return $this;
    }

    /**
     * Dark gray text color
     *
     * @param string|null $str
     * @return $this
     */
    public function darkGray($str = null)
    {
        $this->engine->darkGray($str);
        return $this;
    }

    /**
     * Light red text color
     *
     * @param string|null $str
     * @return $this
     */
    public function lightRed($str = null)
    {
        $this->engine->lightRed($str);
        return $this;
    }

    /**
     * Light green text color
     *
     * @param string|null $str
     * @return $this
     */
    public function lightGreen($str = null)
    {
        $this->engine->lightGreen($str);
        return $this;
    }

    /**
     * Light yellow text color
     *
     * @param string|null $str
     * @return $this
     */
    public function lightYellow($str = null)
    {
        $this->engine->lightYellow($str);
        return $this;
    }

    /**
     * Light blue text color
     *
     * @param string|null $str
     * @return $this
     */
    public function lightBlue($str = null)
    {
        $this->engine->lightBlue($str);
        return $this;
    }

    /**
     * Light magenta text color
     *
     * @param string|null $str
     * @return $this
     */
    public function lightMagenta($str = null)
    {
        $this->engine->lightMagenta($str);
        return $this;
    }

    /**
     * Light cyan text color
     *
     * @param string|null $str
     * @return $this
     */
    public function lightCyan($str = null)
    {
        $this->engine->lightCyan($str);
        return $this;
    }

    /**
     * White text color
     *
     * @param string|null $str
     * @return $this
     */
    public function white($str = null)
    {
        $this->engine->white($str);
        return $this;
    }

    /**
     * Black background color
     *
     * @param string|null $str
     * @return $this
     */
    public function blackBg($str = null)
    {
        $this->engine->backgroundBlack($str);
        return $this;
    }

    /**
     * Red background color
     *
     * @param string|null $str
     * @return $this
     */
    public function redBg($str = null)
    {
        $this->engine->backgroundRed($str);
        return $this;
    }

    /**
     * Green background color
     *
     * @param string|null $str
     * @return $this
     */
    public function greenBg($str = null)
    {
        $this->engine->backgroundGreen($str);
        return $this;
    }

    /**
     * Yellow background color
     *
     * @param string|null $str
     * @return $this
     */
    public function yellowBg($str = null)
    {
        $this->engine->backgroundYellow($str);
        return $this;
    }

    /**
     * Blue background color
     *
     * @param string|null $str
     * @return $this
     */
    public function blueBg($str = null)
    {
        $this->engine->backgroundBlue($str);
        return $this;
    }

    /**
     * Magenta background color
     *
     * @param string|null $str
     * @return $this
     */
    public function magentaBg($str = null)
    {
        $this->engine->backgroundMagenta($str);
        return $this;
    }

    /**
     * Cyan background color
     *
     * @param string|null $str
     * @return $this
     */
    public function cyanBg($str = null)
    {
        $this->engine->backgroundCyan($str);
        return $this;
    }

    /**
     * Light gray background color
     *
     * @param string|null $str
     * @return $this
     */
    public function lightGrayBg($str = null)
    {
        $this->engine->backgroundLightGray($str);
        return $this;
    }

    /**
     * Dark gray background color
     *
     * @param string|null $str
     * @return $this
     */
    public function darkGrayBg($str = null)
    {
        $this->engine->backgroundDarkGray($str);
        return $this;
    }

    /**
     * Light red background color
     *
     * @param string|null $str
     * @return $this
     */
    public function lightRedBg($str = null)
    {
        $this->engine->backgroundLightRed($str);
        return $this;
    }

    /**
     * Light green background color
     *
     * @param string|null $str
     * @return $this
     */
    public function lightGreenBg($str = null)
    {
        $this->engine->backgroundLightGreen($str);
        return $this;
    }

    /**
     * Light yellow background color
     *
     * @param string|null $str
     * @return $this
     */
    public function lightYellowBg($str = null)
    {
        $this->engine->backgroundLightYellow($str);
        return $this;
    }

    /**
     * Light blue background color
     *
     * @param string|null $str
     * @return $this
     */
    public function lightBlueBg($str = null)
    {
        $this->engine->backgroundLightBlue($str);
        return $this;
    }

    /**
     * Light magenta background color
     *
     * @param string|null $str
     * @return $this
     */
    public function lightMagentaBg($str = null)
    {
        $this->engine->backgroundLightMagenta($str);
        return $this;
    }

    /**
     * Light cyan background color
     *
     * @param string|null $str
     * @return $this
     */
    public function lightCyanBg($str = null)
    {
        $this->engine->backgroundLightCyan($str);
        return $this;
    }

    /**
     * White background color
     *
     * @param string|null $str
     * @return $this
     */
    public function whiteBg($str = null)
    {
        $this->engine->backgroundWhite($str);
        return $this;
    }

    /**
     * Bold text
     *
     * @param string|null $str
     * @return $this
     */
    public function bold($str = null)
    {
        $this->engine->bold($str);
        return $this;
    }

    /**
     * Dimmed text
     *
     * @param string|null $str
     * @return $this
     */
    public function dim($str = null)
    {
        $this->engine->dim($str);
        return $this;
    }

    /**
     * Underlined text
     *
     * @param string|null $str
     * @return $this
     */
    public function underline($str = null)
    {
        $this->engine->underline($str);
        return $this;
    }

    /**
     * Blinking text
     *
     * @param string|null $str
     * @return $this
     */
    public function blink($str = null)
    {
        $this->engine->blink($str);
        return $this;
    }

    /**
     * Inverted text
     *
     * @param string|null $str
     * @return $this
     */
    public function invert($str = null)
    {
        $this->engine->invert($str);
        return $this;
    }

    /**
     * Hidden text
     *
     * @param string|null $str
     * @return $this
     */
    public function hidden($str = null)
    {
        $this->engine->hidden($str);
        return $this;
    }

    /**
     * Info text
     *
     * @param string|null $str
     * @return $this
     */
    public function info($str = null)
    {
        $this->engine->info($str);
        return $this;
    }

    /**
     * Comment text
     *
     * @param string|null $str
     * @return $this
     */
    public function comment($str = null)
    {
        $this->engine->comment($str);
        return $this;
    }

    /**
     * Whispered text
     *
     * @param string|null $str
     * @return $this
     */
    public function whisper($str = null)
    {
        $this->engine->whisper($str);
        return $this;
    }

    /**
     * Shouted text
     *
     * @param string|null $str
     * @return $this
     */
    public function shout($str = null)
    {
        $this->engine->shout($str);
        return $this;
    }

    /**
     * Error text
     *
     * @param string|null $str
     * @return $this
     */
    public function error($str = null)
    {
        $this->engine->error($str);
        return $this;
    }

    /**
     * Data columns
     *
     * @param array $data
     * @param int|null $columnCount
     * @return $this
     */
    public function columns(array $data, $columnCount = null)
    {
        $this->engine->columns($data, $columnCount);
        return $this;
    }

    /**
     * Text output
     *
     * @param string $str
     * @return $this
     */
    public function out($str)
    {
        $this->engine->out($str);
        return $this;
    }

    /**
     * Inline text output
     *
     * @param string $str
     * @return $this
     */
    public function inline($str)
    {
        $this->engine->inline($str);
        return $this;
    }

    /**
     * Data table
     *
     * @param array $data
     * @return $this
     */
    public function table(array $data)
    {
        $this->engine->table($data);
        return $this;
    }

    /**
     * JSON data
     *
     * @param mixed $var
     * @return $this
     */
    public function json($var)
    {
        $this->engine->json($var);
        return $this;
    }

    /**
     * Space
     *
     * @param int $count
     * @return $this
     */
    public function sp($count = 1)
    {
        for ($i=0; $i < $count; $i++) {
            $this->engine->inline(' ');
        }
        return $this;
    }

    /**
     * New line
     *
     * @param int $count
     * @return $this
     */
    public function br($count = 1)
    {
        $this->engine->br($count);
        return $this;
    }

    /**
     * Tabulator
     *
     * @param int $count
     * @return $this
     */
    public function tab($count = 1)
    {
        $this->engine->tab($count);
        return $this;
    }

    /**
     * Draw art
     *
     * @param string $art
     * @return $this
     */
    public function draw($art)
    {
        $this->engine->draw($art);
        return $this;
    }

    /**
     * Literal border
     *
     * @param string|null $char
     * @param int|null $length
     * @return $this
     */
    public function border($char = null, $length = null)
    {
        $this->engine->border($char, $length);
        return $this;
    }

    /**
     * Variable debug
     *
     * @param mixed $var
     * @return $this
     */
    public function dump($var)
    {
        $this->engine->dump($var);
        return $this;
    }

    /**
     * Literal strong text
     *
     * @param string $output
     * @param string|null $char
     * @param int|null $length
     * @return $this
     */
    public function flank($output, $char = null, $length = null)
    {
        $this->engine->flank($output, $char, $length);
        return $this;
    }

    /**
     * Progress bar
     *
     * @param int|null $total
     * @return Dynamic\Progress
     */
    public function progress($total = null)
    {
        return $this->engine->progress($total);
    }

    /**
     * Left literal padding
     *
     * @param int $length
     * @param string $char
     * @return Dynamic\Padding
     */
    public function padding($length = 0, $char = '.')
    {
        return $this->engine->padding($length, $char);
    }

    /**
     * Optional input text
     *
     * @param string $prompt
     * @return Dynamic\Input
     */
    public function input($prompt)
    {
        return $this->engine->input($prompt);
    }

    /**
     * Confirmation input text
     *
     * @param string $prompt
     * @return Dynamic\Confirm
     */
    public function confirm($prompt)
    {
        return $this->engine->confirm($prompt);
    }

    /**
     * Password input text
     *
     * @param string $prompt
     * @return Dynamic\Password
     */
    public function password($prompt)
    {
        return $this->engine->password($prompt);
    }

    /**
     * Multi-option input text
     *
     * @param string $prompt
     * @param array $options
     * @return Dynamic\Checkboxes
     */
    public function checkboxes($prompt, array $options)
    {
        return $this->engine->checkboxes($prompt, $options);
    }

    /**
     * Single-option input text
     *
     * @param string $prompt
     * @param array $options
     * @return Dynamic\Radio
     */
    public function radio($prompt, array $options)
    {
        return $this->engine->radio($prompt, $options);
    }

    /**
     * Play an animation
     *
     * @param string $art
     * @return Dynamic\Animation
     */
    public function animation($art)
    {
        return $this->engine->animation($art);
    }
}
