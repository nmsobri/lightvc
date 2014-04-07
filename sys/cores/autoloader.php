<?php

/**
 * Autoloader is a class scanner with caching.
 *
 * @example
 * [code]
 * include_once('autoloader.php');
 * Autoloader::addClassPath('app_path/classes/');
 * Autoloader::addClassPath('shared_path/classes/');
 * Autoloader::setCacheFilePath('app_path/tmp/class_path_cache.txt');
 * Autoloader::excludeFolderNamesMatchingRegex('/^CVS|\..*$/');
 * Autoloader::registerAutoload();
 * [code]
 *
 * @package default
 * @author Anthony Bush, Wayne Wight
 * @copyright 2006-2008 Academic Superstore. This software is open source protected by the FreeBSD License.
 * @version 2008-09-22
 * */
class Autoloader
{

    /**
     * Location of class to search
     * @var array
     */
    protected static $classPaths = array( );


    /**
     * Class prefix
     * @var string
     */
    protected static $classFilePrefix = '';


    /**
     * Class suffix
     * @var string
     */
    protected static $classFileSuffix = '.php';


    /**
     * Cache file
     * @var null
     */
    protected static $cacheFile = null;


    /**
     * Cache content
     * @var null
     */
    protected static $cacheContent = null;


    /**
     * Exclude folder to search
     * @var string
     */
    protected static $excludeFolderNames = '#^CVS|\.{1,2}$#';


    /**
     * @var bool
     */
    protected static $hasSaver = false;



    /**
     * Sets the paths to search in when looking for a class.
     *
     * @param array $paths
     * @return void
     * */
    public static function setClassPaths( $paths )
    {
        self::$classPaths = $paths;
    }



    /**
     * Adds a path to search in when looking for a class.
     *
     * @param string $path
     * @return void
     * */
    public static function addClassPath( $path )
    {
        self::$classPaths[ ] = $path;
    }



    /**
     * Set the full file path to the cache file to use.
     * Set to null to disable cahing the files
     * @example
     *
     * [code]
     * Autoloader::setCacheFilePath('/tmp/class_path_cache.txt');
     * [code]
     *
     * @param string $path
     * @return void
     * */
    public static function setCacheFile( $path )
    {
        self::$cacheFile = $path;
    }



    /**
     * Sets the prefix to prepend to a class name in order to get a file
     * name to look for
     *
     * @param string $prefix
     * @return void
     * */
    public static function setClassFilePrefix( $prefix )
    {
        self::$classFilePrefix = $prefix;
    }



    /**
     * Sets the suffix to append to a class name in order to get a
     * file name to look for
     *
     * @param string $suffix
     * @return void
     * */
    public static function setClassFileSuffix( $suffix )
    {
        self::$classFileSuffix = $suffix;
    }



    /**
     * When searching the {@link $classPaths} recursively for a matching class
     * file, folder names matching $regex will not be searched.
     *
     * Example:
     *
     *     <code>
     *     Autoloader::excludeFolderNamesMatchingRegex('/^CVS|\.{1,2}$/');
     *     </code>
     *
     * @param string $regex
     * @return void
     * */
    public static function excludeFolderNamesMatchingRegex( $regex )
    {
        self::$excludeFolderNames = $regex;
    }


    /**
     * Register autoload
     */
    public static function registerAutoload()
    {
        spl_autoload_register( array( __CLASS__, 'loadClass' ) );
    }



    /**
     * Returns true if the class file was found and included, false if not.
     * @param string $className
     * @return bool
     */
    public static function loadClass( $className )
    {
        $cacheFile = self::getCachedContent( $className );

        if ( $cacheFile && file_exists( $cacheFile ) )
        {
            include( $cacheFile );
            return true;
        }
        else
        {
            foreach ( self::$classPaths as $path )
            {
                if ( $classFile = self::searchForClassFile( $className, $path ) )
                {
                    self::$cacheContent[ $className ] = $classFile;
                    if ( !self::$hasSaver && ( !is_null( self::$cacheFile ) ) )
                    {
                        register_shutdown_function( array( __CLASS__, 'saveCachedContent' ) );
                        self::$hasSaver = true;
                    }
                    include( $classFile );
                    return true;
                }
            }
        }
        return false;
    }


    /**
     * Get cache file
     *
     * @param $className
     * @return bool
     */
    protected static function getCachedContent( $className )
    {
        self::loadCachedFile();

        if ( isset( self::$cacheContent[ $className ] ) )
        {
            return self::$cacheContent[ $className ];
        }

        return false;
    }


    /**
     * Load cache file
     *
     * @return void
     */
    protected static function loadCachedFile()
    {
        if ( is_null( self::$cacheContent ) )
        {
            if ( self::$cacheFile && is_file( self::$cacheFile ) )
            {
                self::$cacheContent = unserialize( file_get_contents( self::$cacheFile ) );
            }
        }
    }



    /**
     * Write cached paths to file
     *
     * @return void
     * */
    public static function saveCachedContent()
    {
        if ( !file_exists( self::$cacheFile ) || is_writable( self::$cacheFile ) )
        {
            $fileContents = serialize( self::$cacheContent );
            $bytes = file_put_contents( self::$cacheFile, $fileContents );
            if ( $bytes === false )
            {
                trigger_error( 'Autoloader could not write the cache file: ' . self::$cacheFile, E_USER_ERROR );
            }
        }
        else
        {
            trigger_error( 'Autoload cache file not writable: ' . self::$cacheFile, E_USER_ERROR );
        }
    }


    /**
     * Serach for class file
     *
     * @param $className
     * @param $directory
     * @return bool|string
     */
    protected static function searchForClassFile( $className, $directory )
    {
        if ( is_dir( $directory ) && is_readable( $directory ) )
        {
            $d = dir( $directory );
            while ( $file = $d->read() )
            {
                $subPath = $directory . $file;
                if ( is_dir( $subPath ) )
                {
                    if ( !preg_match( self::$excludeFolderNames, $file ) )
                    {
                        if ( $filePath = self::searchForClassFile( $className, $subPath . '/' ) )
                        {
                            return $filePath;
                        }
                    }
                }
                else
                {
                    if ( $file == trim( self::$classFilePrefix . self::camelToDot( $className ) . self::$classFileSuffix ) )
                    {
                        return $subPath;
                    }
                }
            }
        }
        return false;
    }


    /**
     * Covert camel case class name to dot(.)
     *
     * @param $class
     * @return string
     */
    protected static function camelToDot( $class )
    {
        return strtolower( preg_replace( '/([a-zA-Z])(?=[A-Z])/', '$1.', $class ) );
    }



}




