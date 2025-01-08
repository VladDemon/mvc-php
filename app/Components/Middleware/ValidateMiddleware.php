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
            http_response_code(400);
            echo json_encode(['success' => false, 'errors' => $errors]);
            exit;
        }
        
        return $next($request);
    }

    private function validate(array $request, array $rules): array
    {
        $errors = [];
        foreach ($rules as $field => $rule) {
            if (!isset($request[$field])) {
                $request[$field] = null; 
            }

            $this->checkMinLength($request, $field, $rule, $errors);
            $this->checkMaxLength($request, $field, $rule, $errors);
            $this->checkRequired($request, $field, $rule, $errors);
            $this->checkEmail($request, $field, $rule, $errors);
        }
        return $errors;
    }

    private function checkMinLength(array $request, string $field, string $rule, array &$errors): void
    {
        if (str_contains($rule, 'min')) {
            $ruleValues = explode(":", $rule);
            if (count(str_split($request[$field])) < (int)$ruleValues[1]) {
                $errors[$field] = 'Min length of ' . $field . ' is ' . $ruleValues[1];
            }
        }
    }

    private function checkMaxLength(array $request, string $field, string $rule, array &$errors): void
    {
        if (str_contains($rule, 'max')) {
            $ruleValues = explode(":", $rule);
            if (count(str_split($request[$field])) > (int)$ruleValues[1]) {
                $errors[$field] = 'Max length of ' . $field . ' is ' . $ruleValues[1];
            }
        }
    }

    private function checkRequired(array $request, string $field, string $rule, array &$errors): void
    {
        if ($rule === 'required' && empty($request[$field])) {
            $errors[$field] = "$field is required.";
        }
    }

    private function checkEmail(array $request, string $field, string $rule, array &$errors): void
    {
        if ($rule === 'email' && !empty($request[$field]) && !filter_var($request[$field], FILTER_VALIDATE_EMAIL)) {
            $errors[$field] = "$field must be a valid email.";
        }
    }
}
