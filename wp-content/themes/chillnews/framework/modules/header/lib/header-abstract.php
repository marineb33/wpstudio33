<?php
namespace ChillNewsNamespace\Modules\Header\Lib;

/**
 * Class that acts like interface for all header types
 *
 * Class HeaderType
 */
abstract class HeaderType {
    /**
     * Value of option in database.
     * For example, if your header type has value in select field of 'header-type1'
     * that would be the value of this field
     *
     * @var
     */
    protected $slug;
    /**
     * Name of module so we don't repeat it where we need it
     *
     * @var string
     */
    protected $moduleName = 'header';

    /**
     * Loads template for header type
     *
     * @param array $parameters associative array of variables to pass to template
     */
    public abstract function loadTemplate($parameters = array());

    /**
     * Returns global variables that are used in JS
     * @param $globalVariables
     * @return mixed
     */
    public abstract function getGlobalJSVariables($globalVariables);
}