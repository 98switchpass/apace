<?php

class Minify {

    
    public function __construct() {

        if (!defined('MINIFY_STRING')) define('MINIFY_STRING', '"(?:[^"\\\]|\\\.)*"|\'(?:[^\'\\\]|\\\.)*\'');
        if (!defined('MINIFY_COMMENT_CSS')) define('MINIFY_COMMENT_CSS', '/\*[\s\S]*?\*/');
        if (!defined('MINIFY_COMMENT_HTML')) define('MINIFY_COMMENT_HTML', '<!\-{2}[\s\S]*?\-{2}>');
        if (!defined('MINIFY_COMMENT_JS')) define('MINIFY_COMMENT_JS', '//[^\n]*');
        if (!defined('MINIFY_PATTERN_JS')) define('MINIFY_PATTERN_JS', '\b/[^\n]+?/[gimuy]*\b');
        if (!defined('MINIFY_HTML')) define('MINIFY_HTML', '<[!/]?[a-zA-Z\d:.-]+[\s\S]*?>');
        if (!defined('MINIFY_HTML_ENT')) define('MINIFY_HTML_ENT', '(?:[a-zA-Z\d]+|\#\d+|\#x[a-fA-F\d]+);');
        if (!defined('MINIFY_HTML_KEEP')) define('MINIFY_HTML_KEEP', '<pre(?:\s[^<>]*?)?>[\s\S]*?</pre>|<code(?:\s[^<>]*?)?>[\s\S]*?</code>|<script(?:\s[^<>]*?)?>[\s\S]*?</script>|<style(?:\s[^<>]*?)?>[\s\S]*?</style>|<textarea(?:\s[^<>]*?)?>[\s\S]*?</textarea>');

        // escape character
        if (!defined('X')) define('X', "\x1A");
        
    }


    // normalize line–break(s)
    public function n($s) {
        return str_replace(["\r\n", "\r"], "\n", $s);
    }


    // trim once
    public function t($a, $b) {
        if ($a && strpos($a, $b) === 0 && substr($a, -strlen($b)) === $b) {
            return substr(substr($a, strlen($b)), 0, -strlen($b));
        }
        return $a;
    }


    public function fn_minify($pattern, $input) {
        return preg_split('#(' . implode('|', $pattern) . ')#', $input, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
    }


    public function minifyJs($input, $comment = 2, $quote = 2) {
        if (!is_string($input) || !$input = $this->n(trim($input))) return $input;
        $output = $prev = "";
        foreach ($this->fn_minify([MINIFY_COMMENT_CSS, MINIFY_STRING, MINIFY_COMMENT_JS, MINIFY_PATTERN_JS], $input) as $part) {
            if (trim($part) === "") continue;
            if ($comment !== 1 && (
                substr($part, 0, 2) === '//' || // Remove inline comment(s)
                strpos($part, '/*') === 0 && substr($part, -2) === '*/'
            )) {
                if (
                    $comment === 2 && (
                        // Detect special comment(s) from the third character. It should be a `!` or `*` → `/*! keep */` or `/** keep */`
                        strpos('*!', $part[2]) !== false ||
                        // Detect license comment(s) from the content. It should contains character(s) like `@license`
                        stripos($part, '@licence') !== false || // noun
                        stripos($part, '@license') !== false || // verb
                        stripos($part, '@preserve') !== false
                    )
                ) {
                    $output .= $part;
                }
                continue;
            }
            if ($part[0] === '"' && substr($part, -1) === '"' || $part[0] === "'" && substr($part, -1) === "'") {
                // TODO: Remove quote(s) where possible …
                $output .= $part;
            } else {
                $output .= $this->minifyJsUnion($part);
            }
            $prev = $part;
        }
        return $output;
    }


    public function minifyJsUnion($input) {
        return preg_replace([
            // Remove white–space(s) around punctuation(s) [^1]
            '#\s*([!%&*\(\)\-=+\[\]\{\}|;:,.<>?\/])\s*#',
            // Remove the last semi–colon and comma [^2]
            '#[;,]([\]\}])#',
            // Replace `true` with `!0` and `false` with `!1` [^3]
            '#\btrue\b#', '#\bfalse\b#', '#\b(return\s?)\s*\b#',
            // Replace `new Array(x)` with `[x]` … [^4]
            '#\b(?:new\s+)?Array\((.*?)\)#', '#\b(?:new\s+)?Object\((.*?)\)#'
        ], [
            // [^1]
            '$1',
            // [^2]
            '$1',
            // [^3]
            '!0', '!1', '$1',
            // [^4]
            '[$1]', '{$1}'
        ], $input);
    }




    
}
