<?php
function tokenize($expr) {
    preg_match_all('/\d+|[+\-*\/()]/', $expr, $tokens);
    return $tokens[0];
}
function precedence($op) {
    return match ($op) {
        '+', '-' => 1,
        '*', '/' => 2,
        default  => 0,
    };
}
function toRPN(array $tokens): array {
    $output = [];
    $stack  = [];
    $ops    = ['+', '-', '*', '/'];

    foreach ($tokens as $t) {

        if (is_numeric($t)) {
            $output[] = $t;

        } elseif (in_array($t, $ops, true)) {
            while (!empty($stack)) {
                $top = end($stack);
                if (!in_array($top, $ops, true) || precedence($top) < precedence($t)) {
                    break;
                }
                $output[] = array_pop($stack);
            }
            $stack[] = $t;

        } elseif ($t === '(') {
            $stack[] = $t;

        } elseif ($t === ')') {
            while (!empty($stack) && end($stack) !== '(') {
                $output[] = array_pop($stack);
            }
            array_pop($stack);
        }
    }

    while (!empty($stack)) {
        $output[] = array_pop($stack);
    }

    return $output;
}
function evaluateRPN($rpn) {
    $stack = [];

    foreach ($rpn as $t) {
        if (is_numeric($t)) {
            $stack[] = $t;
        } else {
            $b = array_pop($stack);
            $a = array_pop($stack);
            
            shell_exec('javac Dispatch.java');
            shell_exec('gcc div.c -o div'); // just in case java is shy and won't compile "div.c"
            $cmd = "java Dispatch " . escapeshellarg($a) . " " . escapeshellarg($t) . " " . escapeshellarg($b);
            $res = trim(shell_exec($cmd));

            $stack[] = $res;
        }
    }

    return $stack[0];
}

$input = $_GET['in'] ?? '0';
$tokens = tokenize($input);
$rpn = toRPN($tokens);
$result = evaluateRPN($rpn);

echo json_encode([
    // 'expression' => $input,
    'tokens'     => $tokens,
    // 'rpn'        => $rpn,
    'result'     => $result
]);
?>