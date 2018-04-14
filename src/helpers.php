<?php

/*
 * This file is part of questocat/epic-emoji package.
 *
 * (c) questocat <zhengchaopu@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

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
