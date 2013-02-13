<?php

/**
 * This behavior helps to load script files from scripts folder without entering
 * directory prefixes every time.
 * @property CClientScript $owner
 * @method CClientScript getOwner()
 */
class LocalScriptsBehavior extends CBehavior
{
    public $jsDir  = '$/js/';
    public $cssDir = '$/css/';
    
    public $jsPath  = null;
    public $cssPath = null;
    
    public function attach($owner)
    {
        if (YII_DEBUG && !$owner instanceof CClientScript)
            throw new CException(__CLASS__ . ' owner must be an instance of CClientScript.');
        
        parent::attach($owner);
        
        $this->jsDir  = $this->initPrefix($this->jsPath,  $this->jsDir);
        $this->cssDir = $this->initPrefix($this->cssPath, $this->cssDir);
    }

    # Register file #
    
    /**
     * Register script file from your javascripts folder.
     * @param string $name
     * @param integer $position
     * @return CClientScript 
     */
    public function registerLocalScript($name, $position=0)
    {
        return $this->getOwner()->registerScriptFile($this->jsDir . $name, $position);
    }
    
    /**
     * Register css file from your styles folder.
     * @param string $name
     * @param string $media
     * @return CClientScript 
     */
    public function registerLocalCss($name, $media='')
    {
        return $this->getOwner()->registerCssFile($this->cssDir . $name, $media);
    }
    
    # Internal #
    
    /**
     * Initializes prefix value.
     * @param string $path directory path alias.
     * When defined - directory will be published using assetManager.
     * @param string $dir directory url.
     * When path is defined this value is ignored.
     * @return string
     */
    private function initPrefix($path, $dir)
    {
        if ($path !== null) {
            $path = Yii::getPathOfAlias($path);
            return Yii::app()->getComponent('assetManager')->publish($path) . '/';

        } else 
            return $this->replacePlaceholders($dir);
    }
    
    /**
     * Replace prefix placeholders with calculated values.
     * @param string $dir
     * @return string 
     */
    private function replacePlaceholders($dir)
    {
        if ($dir[0] == '$') {
            $dir = Yii::app()->baseUrl . substr($dir, 1);
        }
        
        return $dir;
    }
}