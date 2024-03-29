<?php
namespace BerkaPhp\Template;
use \BerkaPhp\Helper;
use BerkaPhp\Helper\Debug;
use Config\Router\Error;

class AppView
{
    private $data;
    public $variables;
    private $flash;
    private $ajax_view;
    private $meta_tags;
    public $autoRender;

    private $actionViewToRender;
    private $prefixViewToRender;
    private $controllerViewToRender;
    private $resource;

    function __construct($variables='') {
        $this->variables = $variables;
        $this->data = null;
        $this->ajax_view = false;
        $this->data['title'] = '';
        $this->autoRender = true;
        $this->resource = array();
    }

    /**
     * @param mixed $actionViewToRender
     */
    public function setActionViewToRender($actionViewToRender)
    {
        $this->actionViewToRender = $actionViewToRender;
    }

    /**
     * @param mixed $controllerViewToRender
     */
    public function setControllerViewToRender($controllerViewToRender)
    {
        $this->controllerViewToRender = $controllerViewToRender;
    }

    /**
     * @param mixed $prefixViewToRender
     */
    public function setPrefixViewToRender($prefixViewToRender)
    {
        $this->prefixViewToRender = $prefixViewToRender;
    }

    /**
     * @param array $resource
     */
    public function setResource($resource)
    {
        $this->resource = $resource;
    }


    /* fetches all data from database
    * @access public
    * @param  [$query] array f parameters
    * @return [array] array of data fetched from DB
    * @author berkaPhp
    */

    //v2
    private function autoViewRender($called_controller, $view_to_render) {

        /* fetches all data from database
        * @access public
        * @param  [$query] array f parameters
        */

        $called_controller = str_replace('Controller','',$called_controller);
        $called_controller = str_replace('controller','',$called_controller);
        $called_controller = str_replace('\\','',$called_controller);
        $called_controller = str_replace(strtolower(PREFIX) ,'',$called_controller);
        $called_controller = trim($called_controller);

        $template_data = $this->data;

        /* fetches all data from database
        * @access public
        * @param  [$query] array f parameters
        */
        if(sizeof($this->data) > 0){
            extract($this->data);
        }

        $this->flash = isset($this->data['flash']) ? $this->data['flash'] : '';

        /* fetches all data from database
        * @access public
        * @param  [$query] array f parameters
        */
        self::user_header_template(PREFIX, $this->meta_tags, $template_data['title'] );

        /* fetches all data from database
        * @access public
        * @param  [$query] array f parameters
        */
        $content = "";

        $view_path = $_SERVER['DOCUMENT_ROOT'] . '/Views/' . PREFIX . '/' . $called_controller . '/' . $view_to_render . '.php';

        if(\BerkaPhp\Helper\FileStream::fileExist($view_path)) {

            ob_start();
            require($view_path);
            $content = ob_get_contents();
            ob_end_clean();

        } else {

            Error::OnViewTemplateNotFound('?path=' . $view_path . '&controller=' . $called_controller . '&view=' . $view_to_render);

        }

        /* fetches all data from database
        * @access public
        * @param  [$query] array f parameters
        */
        ob_start();
        require($_SERVER['DOCUMENT_ROOT'].'/Views/'.PREFIX.'/Layout/layout.php');
        $template = ob_get_contents();
        ob_end_clean();

        /* fetches all data from database
        * @access public
        * @param  [$query] array f parameters
        */
        $file = preg_match('/{.*[a-z0-9A-Z]}/', $template, $match) ;

        if ($file) {
            $match = $match[0];
            $new_template = str_replace('{content}', $content, $template);
            echo $new_template;
        }

        /* fetches all data from database
        * @access public
        * @param  [$query] array f parameters
        */

        $message_box = "";
        $message = "";

        if(isset($this->data['message']['success'])) {

            $message_box = "alert-success";
            $message = $this->data['message']['success'];

        } elseif(isset($this->data['message']['error'])) {

            $message_box = "alert-danger";
            $message = $this->data['message']['error'];

        }

        ?>

        <?php if (DEBUG) : ?>
            <div class="console "  role="alert">
                <div class="heading">
                    <span data-close-message class="glyphicon glyphicon-remove-circle pull-right close-message" aria-hidden="true"></span>
                </div>
            <span id="message">
                <?php
                if(is_array($this->flash)) {
                    echo'<pre>';print_r($this->flash);
                } else {
                    echo $this->flash;
                }
                ?>
            </span>
            </div>
        <?php endif ?>

        <?php if(isset($this->data['message'])) :?>
            <div class="alert <?= $message_box ?> flash hide">
                <strong><?= $message ?></strong>
            </div>
        <?php endif ?>
        <input type="hidden" id="ajaxLoader">
        <input type="hidden" id="notification">

        <?php

        /* fetches all data from database
        * @access public
        * @param  [$query] array f parameters
        */
        require($_SERVER['DOCUMENT_ROOT'].'/Views/'.PREFIX.'/Layout/footer.php');
    }

    /**
     *
     */
    public function render() {

        if(true) {

            $called_controller = $this->resource['controller'];

            $template_data = $this->data;

            if (sizeof($this->data) > 0) {
                extract($this->data);
            }

            $this->flash = isset($this->data['flash']) ? $this->data['flash'] : '';


            /* fetches all data from database
            * @access public
            * @param  [$query] array f parameters
            */
            $content = "";

            //Debug::PrintOut($this->resource);
            $view_path = $_SERVER['DOCUMENT_ROOT'] . '/' . $this->resource['resources']['view']['path'] . '.php';

            if (\BerkaPhp\Helper\FileStream::fileExist($view_path)) {

                ob_start();
                require($view_path);
                $content = ob_get_contents();
                ob_end_clean();

            } else {

                Error::OnViewTemplateNotFound('?path=' . $view_path . '&controller=' . $called_controller . '&view=' . $this->resource['action']);

            }

            /* fetches all data from database
            * @access public
            * @param  [$query] array f parameters
            */
            ob_start();
            $metaData = $this->meta_tags;
            $title = $template_data['title'];
            require($_SERVER['DOCUMENT_ROOT'] . '/' .$this->resource['resources']['template']['path'] . '.php');
            $template = ob_get_contents();
            ob_end_clean();

            /* fetches all data from database
            * @access public
            * @param  [$query] array f parameters
            */
            $file = preg_match('/{.*[a-z0-9A-Z]}/', $template, $match);

            if ($file) {
                $match = $match[0];
                $new_template = str_replace('{content}', $content, $template);
                echo $new_template;
            }

            /* fetches all data from database
            * @access public
            * @param  [$query] array f parameters
            */

            $message_box = "";
            $message = "";

            if (isset($this->data['message']['success'])) {

                $message_box = "alert-success";
                $message = $this->data['message']['success'];

            } elseif (isset($this->data['message']['error'])) {

                $message_box = "alert-danger";
                $message = $this->data['message']['error'];

            }

            ?>

            <?php if (DEBUG) : ?>
                <div class="console " role="alert">
                    <div class="heading">
                        <span data-close-message class="glyphicon glyphicon-remove-circle pull-right close-message" aria-hidden="true"></span>
                    </div>
                    <span id="message">
                        <?php
                            Debug::PrintOut($this->flash, false);
                        ?>
                    </span>
                </div>
            <?php endif ?>

            <?php if (isset($this->data['message'])) : ?>
                <div class="alert <?= $message_box ?> flash hide">
                    <strong><?= $message ?></strong>
                </div>
            <?php endif ?>
            <div class="loading hidden">
            </div>
            <div class="alert alert-success info-message hide">
            </div>
            <input type="hidden" id="ajaxLoader">
            <input type="hidden" id="notification">
            <?php
        }
    }

    public function renderAjax($option = array()) {

        $this->autoRender = false;

        $template_data = $this->data;

        if (sizeof($this->data) > 0) {
            extract($this->data);
        }

        $metaData = $this->meta_tags;

        $view_path = $_SERVER['DOCUMENT_ROOT'] . '/' . $this->resource['resources']['view']['path'] . '.php';

        if (\BerkaPhp\Helper\FileStream::fileExist($view_path)) {

            ob_start();
            require($view_path);
            $content = ob_get_contents();
            ob_end_clean();
            echo $content;

        } else {

            Error::OnViewTemplateNotFound('?path=' . $view_path);

        }

    }

    public function renderGetContent($path = '') {

        $this->autoRender = false;

        $template_data = $this->data;

        if (sizeof($this->data) > 0) {
            extract($this->data);
        }

        $metaData = $this->meta_tags;



        if(!empty($path))
            $view_path = $_SERVER['DOCUMENT_ROOT'] . '/'.$path.'.php';
        else
            $view_path = $_SERVER['DOCUMENT_ROOT'] . '/' . $this->resource['resources']['view']['path'].'.php';


        if (\BerkaPhp\Helper\FileStream::fileExist($view_path)) {

            ob_start();
            require($view_path);
            $content = ob_get_contents();
            ob_end_clean();
            return $content;
        } else {

            Error::OnViewTemplateNotFound('?path=' . $view_path);

        }

    }

    /* fetches all data from database
    * @access public
    * @param  [$query] array f parameters
    */
    public function set($name,$data) {
        $this->data[$name]= $data;
    }

    /* fetches all data from database
    * @access public
    * @param  [$query] array f parameters
    */
    public function setMetaTag($meta_tags) {
        $this->meta_tags= $meta_tags;
    }

    /* fetches all data from database
    * @access public
    * @param  [$query] array f parameters
    */
    public function is_ajax($is_it) {
        $this->ajax_view = $is_it;
    }

    public function get_content($path) {
        $content ='';
        ob_start();
        require($path);
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }

    public function run_render($action) {
        $this->autoRender = false;
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);
        $view_to_render =  $action;
        $called_controller =  $trace[count($trace) - 1]['class'];

        $called_controller = str_replace('Controller','',$called_controller);
        $called_controller = str_replace('controller','',$called_controller);
        $called_controller = str_replace('\\','',$called_controller);
        $called_controller = trim($called_controller);

        $title = $called_controller;
        $template_data = $this->data;

        self::user_header_template(PREFIX);

        ob_start();
        require($_SERVER['DOCUMENT_ROOT'].'/Views/'.PREFIX.'/'.$called_controller.'/'.$view_to_render.'.php');
        $content = ob_get_contents();
        ob_end_clean();

        $template = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/Views/'.PREFIX.'/Layout/layout.php');

        $file = preg_match('/{.*[a-z0-9A-Z]}/', $template, $match) ;

        if ($file) {
            $match = $match[0];
            $new_template = str_replace(['{','}'], ['<?php echo $','?>'], $template);
            eval("?> $new_template <?php ");
            echo $new_template;
        }
    }

    /* fetches all data from database
    * @access public
    * @param  [$query] array f parameters
    */
    private static function user_header_template($prefix, $meta = '', $_title = '') {

    }

}
?>