<?php
/**
 * A View can be outputted or have its output returned (i.e. it's renderable).
 * It can not be executed.
 * $inc = new LvcView('foo.php', array());
 * $inc->output();
 * $output = $inc->getOutput();
 * */
class LvcView
{

    /**
     * Full path to file name to be included.
     * @var string
     * */
    protected $fileName;


    /**
     * Data to be exposed to the view template file.
     * @var array
     * */
    protected $data;


    /**
     * A reference to the parent controller
     * @var LvcPageController
     * */
    protected $controller;


    /**
     * Construct a view to be rendered.
     *
     * @param string $fileName Full path to file name of the view template file.
     * @param array $data an array of [varName] => [value] pairs. Each varName will be made available to the view.
     * */
    public function __construct( $fileName, &$data )
    {
        $this->fileName = $fileName;
        $this->data = $data;
    }


    /**
     * Output the view (aka render).
     * @return void
     * */
    public function output()
    {
        extract( $this->data, EXTR_SKIP );
        include( $this->fileName );
    }


    /**
     * Return the output of the view
     *
     * @return string output of view
     * */
    public function getOutput()
    {
        ob_start();
        $this->output();
        return ob_get_clean();
    }


    /**
     * Render a sub element from within a view.
     * Views are not allowed to have business logic, but they can call upon
     * other generic, shared, views, called elements here.
     *
     * @param string $elementName name of element to render
     * @param array $data optional data to pass to the element.
     * @return void
     * @throws LvcException
     * */
    protected function renderElement( $elementName, $data = array() )
    {
        $view = LvcConfig::getElementView( $elementName, $data );

        if( !is_null( $view ) )
        {
            $view->setController( $this->controller );
            $view->output();
        }
        else
        {
            $elementViewPath = LvcConfig::getElementViewPaths();
            $elementViewSuffix = LvcConfig::getElementViewSuffix();
            $elementViewPath = $elementViewPath[0];

            $msg = sprintf( 'Unable to render element "%s"%s', $elementName,
                PHP_EOL
            );

            $msg .= sprintf('Please create file %s',
                $elementViewPath . $elementName . $elementViewSuffix
            );

            #cannot throw Lvc_ViewException, because it will give an error
            #regarding cannot load layout instead of element due to element
            #reside inside layout
            trigger_error( $msg, E_USER_WARNING );
        }
    }


    /**
     * Set the controller when constructing a view if you want
     * {@link setLayoutVar()} to be callable from a view
     *
     * @param $controller
     * @return void
     */
    public function setController( $controller )
    {
        $this->controller = $controller;
    }


    /**
     * Set a variable for the layout file.You can set the page title from
     * a static page's view file this way.
     *
     * @param $varName
     * @param $value
     */
    public function setLayoutVar( $varName, $value )
    {
        $this->controller->setLayoutVar( $varName, $value );
    }


}

