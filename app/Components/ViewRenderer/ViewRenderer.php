<?php

namespace App\Components\ViewRenderer;

use App\Components\Interfaces\ViewRendererInterface;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
class ViewRenderer implements ViewRendererInterface
{
    private $twig;

    public function __construct() {
        $userData = $_SESSION['user'] ?? null;
        $loader = new FilesystemLoader(__DIR__ . "/../../View/");
        $this->twig = new Environment(loader: $loader);
        $this->twig->addGlobal('user_data', $userData);
    }

    public function view(string $file, array $data = []): string {
        return $this->twig->render($file, $data);
    }
}
