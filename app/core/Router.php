<?php
class Router {
    private $routes = [];

    // Добавление маршрута
    public function add(string $method, string $path, string $handler) {
        $this->routes[$method][$path] = $handler;
    }

    // Обработка запроса
    public function dispatch(string $uri) {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($uri, PHP_URL_PATH);

        // Проверка точного совпадения
        if (isset($this->routes[$method][$path])) {
            return $this->callHandler($this->routes[$method][$path]);
        }

        // Проверка динамических роутов (например, /user/:id)
        foreach ($this->routes[$method] ?? [] as $route => $handler) {
            if ($this->matchDynamicRoute($route, $path)) {
                return $this->callHandler($handler);
            }
        }

        // 404 если маршрут не найден
        http_response_code(404);
        echo "Page not found";
    }

    // Вызов контроллера
    private function callHandler(string $handler) {
        list($controller, $action) = explode('@', $handler);
        require_once "/var/www/app/controllers/$controller.php";
        (new $controller())->$action();
    }

    // Проверка динамических путей
    private function matchDynamicRoute(string $route, string $path): bool {
        $routePattern = preg_replace('/\/:(\w+)/', '/(?P<$1>\w+)', $route);
        $routePattern = "@^" . $routePattern . "$@";

        return (bool)preg_match($routePattern, $path);
    }
}