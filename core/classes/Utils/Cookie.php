<?php

namespace Core\Utils;

class Cookie
{

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function delete(): void
    {
        setcookie($this->name, '', time() - 3600);
    }

    public function exists(): bool
    {
        return isset($_COOKIE[$this->name]);
    }

    public function read(): array
    {
        if ($this->exists()) {
            $cookie_array = json_decode($_COOKIE[$this->name], true);
            if ($cookie_array !== null) {
                return $cookie_array;
            }

            trigger_error("Nepavyko decodint cookie", E_WARNING);
        }

        return [];
    }

    public function save(array $data, int $expires_in = 3600)
    {
        setcookie($this->name, json_encode($data), time() + $expires_in);
    }

}