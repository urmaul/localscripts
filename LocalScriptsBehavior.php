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


    public function registerLocalScript($name, $position=0)
    {
        return $this->getOwner()->registerScriptFile($this->jsDir . $name, $position);
    }
    
    public function registerLocalCss($name, $media='')
    {
        return $this->getOwner()->registerCssFile($this->cssDir . $name, $media);
    }
    
    
    private function setupPrefix($dir)
    {
        if ($dir[0] == '$') {
            $dir = Yii::app()->baseUrl . substr($dir, 1);
        }
        
        return $dir;
    }
}