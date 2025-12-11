<?php
class Env{
    private static $loaded = false; 
    public static function load(string $path = __DIR__ . '/.env'): void
    {
        if (self::$loaded) {
            return;
        }

        if (!file_exists($path)) {
            throw new Exception(".env não encontrado em: $path");
        }
        
        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        
        foreach ($lines as $line) {
            
            if (str_starts_with(trim($line), '#')) {
                continue;
            }
            
            $parts = explode('=', $line, 2);
            if (count($parts) !== 2) {
                continue;
            }
            
            $key = trim($parts[0]);
            $value = trim($parts[1]);
            
            if (
                (str_starts_with($value, '"') && str_ends_with($value, '"')) ||
                (str_starts_with($value, "'") && str_ends_with($value, "'"))
                ) {
                    $value = substr($value, 1, -1);
                }
                
                putenv("$key=$value");
                $_ENV[$key] = $value;
                $_SERVER[$key] = $value;
            }
            
            self::$loaded = true;
    }
    public static function get(string $key, $default = null)
    {
        return $_ENV[$key] ?? $_SERVER[$key] ?? getenv($key) ?? $default;
    }
}