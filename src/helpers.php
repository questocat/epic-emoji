<?php

/**
 * @param mixed   $value
 * @param Closure $callback
 *
 * @return mixed
 */
function map($value, \Closure $callback)
{
    return $callback($value);
}

/**
 * 将输入数据转为 emoji 格式.
 *
 * @param string $str
 *
 * @return string
 */
function unicode_bytes($str)
{
    $out = '';
    $cps = explode('-', $str);
    foreach ($cps as $cp) {
        $out .= emoji_utf8_bytes(hexdec($cp));
    }

    return $out;
}

/**
 * 格式化数据不进行转义.
 *
 * @param mixed $raw
 *
 * @return string
 */
function format_string($raw)
{
    $out = '';
    for ($i = 0; $i < strlen($raw); ++$i) {
        $c = ord(substr($raw, $i, 1));
        if ($c >= 0x20 && $c < 0x80 && !in_array($c, array(34, 39, 92))) {
            $out .= chr($c);
        } else {
            $out .= sprintf('\\x%02x', $c);
        }
    }

    return '"'.$out.'"';
}

function format_bytes($bytes)
{
    $out = '';
    for ($i = 0; $i < strlen($bytes); ++$i) {
        $out .= '\\x'.sprintf('%02X', ord(substr($bytes, $i, 1)));
    }

    return $out;
}

/**
 * 格式化字符串为码点形式.
 *
 * @param string $raw
 *
 * @return string
 */
function format_codepoints($raw)
{
    if (!$raw) {
        return '"'.'"';
    }
    $out = array();
    foreach (explode('-', $raw) as $u) {
        $out[] = "U+$u";
    }

    return '"'.implode(' ', $out).'"';
}

/**
 * 码点转为 HTML 实体形式.
 *
 * @param string $codepoint
 *
 * @return string
 */
function html_entity($codepoint)
{
    return '&#x'.str_replace('U+', '', $codepoint).';';
}

/**
 * @param number $cp
 *
 * @return string
 */
function emoji_utf8_bytes($cp)
{
    if ($cp > 0x10000) {
        // 4 bytes
        return  chr(0xF0 | (($cp & 0x1C0000) >> 18)).
            chr(0x80 | (($cp & 0x3F000) >> 12)).
            chr(0x80 | (($cp & 0xFC0) >> 6)).
            chr(0x80 | ($cp & 0x3F));
    } elseif ($cp > 0x800) {
        // 3 bytes
        return  chr(0xE0 | (($cp & 0xF000) >> 12)).
            chr(0x80 | (($cp & 0xFC0) >> 6)).
            chr(0x80 | ($cp & 0x3F));
    } elseif ($cp > 0x80) {
        // 2 bytes
        return  chr(0xC0 | (($cp & 0x7C0) >> 6)).
            chr(0x80 | ($cp & 0x3F));
    } else {
        // 1 byte
        return chr($cp);
    }
}
