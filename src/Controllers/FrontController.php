<?php


namespace GreenHouse\Controllers;


use GreenHouse\Core\Auth;
use GreenHouse\Core\Request;
use GreenHouse\Utils\Dbg;

class FrontController extends Controller {

    protected $layout = 'master';
    protected $async = false;
    const REQUIRE_AUTH = true;
    const SESSION_ALERT = 'alert';

    public function __construct() {
        parent::__construct();
        $this->async = Request::valueRequest("source") == "ajax";
        if (static::REQUIRE_AUTH === true) {
            if (!Auth::getInstance()->isAuth()) {
                if (!$this->async) {
                    $this->redirect(route("login", ["redirect" => get_called_url()]));
                } else $this->error_401();
            }
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
        if (isset($_SESSION[self::SESSION_ALERT])) {
            $vars["alert"] = $_SESSION[self::SESSION_ALERT];
            unset($_SESSION[self::SESSION_ALERT]);
        }
        extract($vars);
        require(APPLICATION_PATH . '/views/layouts/' . $this->layout . '.htm.php');
    }

    /**
     * Récupère le contenu html d'une vue
     *
     * @param $view
     * @param array $vars
     * @return false|string
     */
    protected function getContent($view, $vars = []) {
        ob_start();
        extract($vars);
        include APPLICATION_PATH . '/views/' . str_replace('.', '/', $view) . '.htm.php';
        return ob_get_clean();
    }

    /**
     * Redirige l'utilisateur
     *
     * @param string $url
     * @param array $alert Message à transmettre via la session, format: ["type" => "success|error|unset", "message" => str]
     * @param int $status HTTP code
     */
    public function redirect(string $url, $alert = [], $status = 302) {
        $_SESSION[self::SESSION_ALERT] = $alert;
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
            $this->render('generic.401');
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

    public function emptyRoute() {
        $this->redirect(route("houses"), ["message" => "Vous avez été redirigé vers la liste de vos maisons", "type" => "success"]);
    }

}
