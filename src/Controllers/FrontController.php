<?php


namespace GreenHouse\Controllers;


use GreenHouse\Core\Auth;

class FrontController extends Controller {

    protected $layout = 'master';
    protected $async = false;
    const REQUIRE_AUTH = true;

    public function __construct() {
        parent::__construct();
        if (static::REQUIRE_AUTH === true) {
            if (!$this->async) {
                if(!Auth::getInstance()->isAuth()) $this->redirect(route("login", ["redirect" => get_called_url()]));
            } else $this->error_401();
        }
    }

    /**
     * @param string $view Name of the view.
     * @param array $vars Variables passed into the view.
     */
    protected function render($view, $vars = []) {
        $content = $this->getContent($view, $vars);
        if ($this->async || is_null($this->layout)) {
            echo $content;
            exit();
        }
        extract($vars);
        require(APPLICATION_PATH . '/views/layouts/' . $this->layout . '.htm.php');
    }

    protected function getContent($view, $vars = []) {
        ob_start();
        extract($vars);
        include APPLICATION_PATH . '/views/' . str_replace('.', '/', $view) . '.htm.php';
        return ob_get_clean();
    }

    /**
     * @param string $url
     * @param int $status HTTP code
     */
    public function redirect($url, $status = 302) {
        header('Location: ' . $url, true, $status);
        session_write_close();
        exit();
    }

    public function error_403() {
        parent::error_403();
        if ($this->async) {
            jsonError("Forbidden error 403", 403);
        } else {
            $this->render('generic.403');
        }
    }

    public function error_404() {
        parent::error_404();
        if ($this->async) {
            jsonError("Not found error 404", 404);
        } else {
            $this->render('generic.404');
        }
    }

    public function error_401() {
        parent::error_401();
        if ($this->async) {
            jsonError("Unauthorized error 401", 401);
        } else {
            $this->render('generic.403');
        }
    }

    public function error_405() {
        parent::error_405();
        if ($this->async) {
            jsonError("Method not allowed error 405", 405);
        } else {
            $this->render('generic.404');
        }
    }

}
