<?php
/**
 * emptyから0と'0'を範囲外にする
 * @return bool
 * if (my_check_empty())
 * if (function_exists('wp_xxx')) { wp_xxx(); }
 */

function my_check_empty($var = null) {
	if (empty($var) && $var !== 0 && $var !== '0') {// 論理型のfalseを取り扱う場合は、更に「&& false !== $var」を追加する
		return true;
	} else {
		return false;
	}
}
