<?php

/**
 * @property CClientScript $owner
 */
class LocalScriptsBehavior extends CBehavior
{
    public $jsDir  = '$/js/';
    public $cssDir = '$/css/';
    
    public function attach($owner)
    {
        parent::attach($owner);
        
        $this->jsDir  = $this->setupPrefix($this->jsDir);
        $this->cssDir = $this->setupPrefix($this->cssDir);
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
    
    private function setupPrefix($dir)
    {
        if ($dir[0] == '$') {
            $dir = Yii::app()->baseUrl . substr($dir, 1);
        }
        
        return $dir;
    }
}