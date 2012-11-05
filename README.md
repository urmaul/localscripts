# Yii LocalScripts CClientScript behavior

## How to attach

Add to config/main.php.

```php
'clientScript' => array(
    'class' => 'CClientScript',
    'behaviors' => array(
        array(
            'class' => 'ext.behaviors.localscripts.LocalScriptsBehavior',
        ),
    ),
),
```

### ClientScript phpdoc

You may add these strings to your ClientScript component's phpdoc 

```php
/**
 * @method CClientScript registerLocalScript($name, $position=0) register script file from your javascripts folder.
 * @method CClientScript registerLocalCss($name, $media='') register css file from your styles folder.
 */
```
