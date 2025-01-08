<?php

namespace App\Components\Middleware;

use App\Components\Interfaces\MiddlewareInterface;

class ValidateMiddleware implements MiddlewareInterface
{
    protected array $rules;

    public function __construct(array $rules = [])
    {
        $this->rules = $rules;
    }

    public function handle($request, $next)
    {
        $errors = $this->validate($request, $this->rules);

        if (!empty($errors)) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'errors' => $errors]);
            exit;
        }
        return $next($request);
    }

    private function validate(array $request, array $rules): array
    {
        $errors = [];
        foreach ($rules as $field => $rule) {
            if(str_contains($rule, 'min')) {
                $rule_values = explode(":", $rule );
                if(count(str_split($request[$field])) < $rule_values[1]) {
                    $errors[$field] = 'min length of ' . $field . ' is ' . $rule_values[1];
                }
            }
            if(str_contains($rule, 'max')) {
                $rule_values = explode(":", $rule );
                if(count(str_split($request[$field])) > $rule_values[1]) {
                    $errors[$field] = 'max length of ' . $field . ' is ' . $rule_values[1];
                }
            }
            if ($rule === 'required' && empty($request[$field])) {
                $errors[$field] = "$field is required.";
            }
            if ($rule === 'email' && !filter_var($request[$field], FILTER_VALIDATE_EMAIL)) {
                $errors[$field] = "$field must be a valid email.";
            }
        }
        return $errors;
    }
}
