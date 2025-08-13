<?php

namespace Framework;

class Validator
{
    protected $errors = [];

    public function __construct(
        protected array $data,
        protected array $rules = [],
        protected bool $autoRedirect = true,
    ) {
        $this->validate();

        if ($autoRedirect && !$this->passes()) {
            $this->redirectIfFailed();
        }
    }

    public function validate(): void 
    {
        foreach($this->rules as $field => $rules) {
            $rules = explode('|', $rules);//separamos las reglas
            $value = trim($this->data[$field]);//limpieza de espacios al principio y final

                foreach($rules as $rule) {
                    [$name, $param] = array_pad(explode(':', $rule), 2, null); 

                    if ($error = $this ->hasError($name, $param, $field, $value) ) {
                        $this->errors[] = $error;

                        break;
                    }
                }
        }
    }

    protected function hasError(string $name, ?string $param, string $field, mixed $value): ?string
    {
        return match ($name) {
            'required'      =>  $this->validateRequired($field, $value),
            'min'           =>  $this->validateMin($field, $param, $value),
            'max'           =>  $this->validateMax($field, $param, $value),
            'url'           =>  $this->validateURL($field, $value),
            'email'         => filter_var($value, FILTER_VALIDATE_EMAIL) === false ? "$field must be a valid email address." : null,     

            default => throw new \InvalidArgumentException("Validation rule '$name' is not defined."),
        };
    }

    protected function redirectIfFailed(): void
    {
        session()->setFlash('errors', $this->errors);
        
        foreach ($this->data as $key => $value) {
            session()->setFlash('old_' . $key, $value);
        }

        back();
    }

    public static function make(array $data, array $rules, bool $autoRedirect = true): self
    {
        return new self($data, $rules, $autoRedirect);
    }

    protected function validateRequired(string $field, mixed $value): ?string
    {
        return ($value == null || $value === '') ? "$field is required." :null;
    }

        protected function validateMin(string $field, ?string $param, mixed $value): ?string
    {
        return strlen($value) < $param ? "$field must be at least $param characters." :null;
    }

        protected function validateMax(string $field, ?string $param, mixed $value): ?string
    {
        return strlen($value) > $param ? "$field must not exceed $param characters.": null;
    }

        protected function validateURL(string $field, mixed $value): ?string
    {
        return filter_var($value, FILTER_VALIDATE_URL) === false ? "$field must be a valid URL.": null;
    }

    public function passes () 
    {
        return empty($this->errors);
    }

    public function errors () 
    {
        return $this->errors;
    }
}