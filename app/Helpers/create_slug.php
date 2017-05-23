<?php

if (!function_exists('create_slug')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function create_slug($string, $slug = '-', $extra = null)
	{
		$string = \Normalizer::normalize($string, \Normalizer::FORM_KD);
		if (strpos($string = htmlentities($string, ENT_QUOTES, 'UTF-8'), '&') !== false)
		{
			$string = html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|caron|cedil|circ|grave|lig|orn|ring|slash|tilde|uml);~i', '$1', $string), ENT_QUOTES, 'UTF-8');
		}
		return strtolower(trim(preg_replace('~[^0-9a-z' . preg_quote($extra, '~') . ']++~i', $slug, $string), $slug));
	}

}
